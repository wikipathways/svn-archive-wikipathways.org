<?php

include('../../../wpi.php');
chdir("../../relations/scripts/php");


LabelCache::execute();

class LabelCache
{
    private $_client;
    private $_db;
    private $_logFileName = "label-cache.log";
    private $_initialized;
    private $_logCount;
    private $_labelCacheTable = 'labelcache';

    public function __construct()
    {
        // 0 -> Not Initialzed 1 -> Initialzed
        $this->_initialized = 0;
        $this->_client = new SoapClient('http://www.wikipathways.org/wpi/webservice/webservice.php?wsdl');
        $this->_db =& wfGetDB(DB_SLAVE);
    }

    public static function execute()
    {
        $cache = new LabelCache();
        $cache->init();
    }

    private function init()
    {
        if(file_exists($this->_logFileName))
        {
            $logs = file($this->_logFileName);
            $this->_logCount = count($logs) - 1;
            
            $lastUpdated = 0;
            if(count($logs > 1))
            {
                for($i = count($logs); $i > 0; $i--)
                {
                    $log = explode("\t", trim($logs[$i]));
                    $timeStamp = $log[4];
                    $logStatus = $log[3];
                    if($logStatus == 'finished')
                    {
                        $lastUpdated = $timeStamp;
                        break;
                    }
                }
                if($lastUpdated != 0)
                {
                    $this->_initialized = 1;
                }
            }
        }
        else
            $this->createLogFile($this->_logFileName);

        $this->addLog("started");

        if($this->_initialized == 0)
        {
            $this->createTable();
            $pathways = $this->getPathways();
        }
        else
        {
            $pathways = $this->getPathways($lastUpdated);
        }
        if(count($pathways) > 0)
        {
            $this->updateCache($pathways);
        }
        $this->addLog("finished", 0, count($pathways));
    }

    private function updateCache($pathways)
    {
        $labelsCached = $this->getCachedLabels();
        foreach($pathways as $pwId)
        {
            $labels = $this->getLabels($pwId);
            foreach($labels as $label)
            {
                if(!in_array($label, $labelsCached))
                {
                    $this->addLabel($label);
                    $labelCount++;
                }
            }
        }


    }


    private function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `{$this->_labelCacheTable}` (
                    `id` INT( 5 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
                    `label_name` VARCHAR( 50 ) NOT NULL ,
                    `last_updated` INT( 15 ) UNSIGNED,
                     PRIMARY KEY ( `id` )
                );";
        $res = $this->_db->query($sql);
    }

    public function findPathwaysByLabels($label, $species = '')
    {
        $result = $this->_client->findPathwaysByText(array('query' => $label, 'species' => $species));
        print_r($result);
    }

    private function getLabels($pwId)
    {
        $pwGPML = $this->_client->getPathway(array("pwId" => $pwId , "revision" => 0))->pathway->gpml;
        $gpml = simplexml_load_string($pwGPML);

        foreach($gpml->Label as $label )
        {
            $attributes = $label->attributes();
            $labels[] = (string)$attributes->TextLabel;
        }
        return $labels;

//   $labels = getLabels($pathway->id);
//            echo $labels[0];
//            $result = findPathwaysByLabels("TCA AND CYcle");
//            print_r($result);
//            endScript();

    }

    private function getCachedLabels()
    {
        $res = $this->_db->select( $this->_labelCacheTable, array('id','label_name','time_stamp'));
        while($row = $dbr->fetchObject($res))
        {
            $labels[] = $row['label_name'];
        }
        $this->_db->freeResult($res );
        return $labels;
    }

    private function getPathways($lastUpdated = 0, $species = '')
    {
        $pwList = array();

        if($lastUpdated == 0)
        {
            $results = (array)$this->_client->listPathways(array("organism" => $species));
            $pathways = $results['pathways'];
            foreach($pathways as $pathway)
            {
                $pwList[] = $pathway->id;
            }
        }
        else
        {
            $results = (array)$this->_client->getRecentChanges(array('timestamp' =>  $lastUpdated))->pathways;
            foreach($results as $result)
            {
                if($species == '' || $result->species == $species)
                    $pwList[] =  $result->id;
            }
        }

        return $pwList;

    }

    private function addLabel()
    {

    }
    private function createLogFile()
    {
        $this->_logCount = 0;
        $logHeaders = "id\tlabel-count\tpathway-count\tstatus\ttimestamp\tcomments\n";
        $logHandle = fopen($this->_logFileName, 'a');
        fwrite($logHandle, $logHeaders);
        fclose($logHandle);
    }

    private function addLog($status, $labelCount = 0, $pathwayCount = 0, $comments = '')
    {
        $timeStamp = date("YmdiHs");
        $this->_logCount++;

        $log = "$this->_logCount\t$labelCount\t$pathwayCount\t$status\t$timeStamp\t$comments\t\n";
        $logHandle = fopen($this->_logFileName, 'a');
        fwrite($logHandle, $log);
        fclose($logHandle);
    }

}