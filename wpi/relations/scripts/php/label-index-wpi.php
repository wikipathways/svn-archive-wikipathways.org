<?php

$currentDir = getcwd();
include('../../../wpi.php');
chdir($currentDir);


LabelMapper::execute();

class LabelMapper
{
    private $_client;
    private $_db;
    private $_logFileName = "label-cache.log";
    private $_initialized = 0;
    private $_logCount = 0;
    private $_labelMappingTable = 'labelmappings';

    public function __construct()
    {
        // 0 -> Not Initialzed 1 -> Initialzed
        $this->_initialized = 0;
        $this->_client = new SoapClient('http://relations.wikipathways.org/wpi/webservice/webservice.php?wsdl');
        $this->_db =& wfGetDB(DB_SLAVE);
    }

    public static function execute()
    {
        $cache = new LabelMapper();

        echo count($labels) . "<br /><br /><br /><br />";
        print_r($labels);

    }

    private function init()
    {
        $labelCount = 0;

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
            $labelCount = $this->updateCache($pathways);
        }
        $this->addLog("finished", $labelCount, count($pathways));
    }

    private function updateCache($pathways)
    {
        $labelCount = 0;
        $labels = array();
        foreach($pathways as $pwId)
        {
            if($this->_initialized)
                $this->_db->delete( $this->_labelMappingTable, array( 'pwId' => $pwId ));

            $pwLabels = $this->getLabels($pathways);
            if(count($pwLabels) > 0)
            {
                foreach($pwLabels as $label)
                {
                        $this->addLabel($label);
                        $labelsCached[] = $label;
                        $labelCount++;
                }
            }
        }

        return $labelCount;
    }


    private function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `labelmappings` (
                  `id` int(8) unsigned NOT NULL auto_increment,
                  `label` varchar(100) NOT NULL,
                  `pwId` varchar(8) NOT NULL,
                  `search_score` double NOT NULL,
                  `species` varchar(50) NOT NULL,
                  PRIMARY KEY  (`id`)
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
        $pathway = Pathway::newFromTitle($pwId);
        $pwGPML = $pathway->getGpml();
        $gpml = simplexml_load_string($pwGPML);

        foreach($gpml->Label as $label )
        {
            $attributes = $label->attributes();
            $labels[] = trim((string)$attributes->TextLabel);
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
        $res = $this->_db->select( $this->_labelMappingTable, array('id','label_name'));
        while($row = $this->_db->fetchObject($res))
        {
            $labels[] = $row->label_name;
        }
        $this->_db->freeResult($res);
        return $labels;
    }

    private function getPathways($lastUpdated = 0, $species = '')
    {
        $pwList = array();

        if($lastUpdated == 0)
        {
            $results = (array)Pathway::getAllPathways($species);
            foreach($results as $pwId => $pwObject)
                $pwList[] = $pwId;
            return $pwList;
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

    private function addLabel($label)
    {
        $this->_db->insert( $this->_labelMappingTable, array(
                                        'label_name' => $label,
                                        'time_added'=> time()));
    }
    private function createLogFile()
    {
        $this->_logCount = 0;
        $logHeaders = "id\tlabel-count\tpathway-count\tmappings\tstatus\ttimestamp\tcomments\n";
        $logHandle = fopen($this->_logFileName, 'a');
        fwrite($logHandle, $logHeaders);
        fclose($logHandle);
    }

    private function addLog($status, $labelCount = 0, $pathwayCount = 0, $mappings = 0, $comments = '')
    {
        $timeStamp = date("YmdiHs");
        $this->_logCount++;

        $log = "$this->_logCount\t$labelCount\t$pathwayCount\t$mappings\t$status\t$timeStamp\t$comments\t\n";
        $logHandle = fopen($this->_logFileName, 'a');
        fwrite($logHandle, $log);
        fclose($logHandle);
    }

}