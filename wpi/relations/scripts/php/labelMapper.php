<?php

$currentDir = getcwd();
require_once('../../../search.php');
require_once('wpi.php');
chdir($currentDir);

class LabelMapper
{
    private $_client;
    private $_db;
    // 0 -> Not Initialzed 1 -> Initialzed
    private $_initialized = 0;
    private $_logCount = 0;
    public $_labelMappingTable = 'labelmappings';
    public $_logFileName = "label-mapper.log";
    public $_errorFileName = "label-mapper-error.log";
    
    public function __construct()
    {
        $this->_client = new SoapClient('http://relations.wikipathways.org/wpi/webservice/webservice.php?wsdl');
        $this->_db =& wfGetDB(DB_SLAVE);
    }

    public static function execute()
    {
        $mapper = new LabelMapper();
        $mapper->init();
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
                    $timeStamp = $log[5];
                    $logStatus = $log[4];
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
        {
            $this->createFiles();
        }

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
        else
        {
            $this->addLog("finished");
        }
    }

    private function updateCache($pathways)
    {
        $labelCount = 0;

        foreach($pathways as $pwId)
        {
            if($this->_initialized)
                $this->_db->delete( $this->_labelMappingTable, array( 'pwId' => $pwId ));
        }

        $mappingCount = 0;
        $labels = array();
        $labels = $this->getLabels($pathways);
        $labelCount = count($labels);

        if($labelCount > 0)
        {
            foreach($labels as $label)
            {
                if($this->_initialized)
                    $this->_db->delete( $this->_labelMappingTable, array('label' => $label));

                $mappings = $this->findPathwaysByLabel($label);
                $mappingCount += count($mappings);

                if(count($mappings) > 0)
                {
                    foreach($mappings as $mapping)
                    {
                        $this->_db->insert( $this->_labelMappingTable, array('label' => $label, 'pwId' => $mapping['pwId'], 'search_score' => $mapping['score'], 'species' =>  $mapping['species']));
                    }
                }
            }
        }
        $this->addLog("finished", $labelCount, count($pathways), $mappingCount, "test run");
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

    public function findPathwaysByLabel($label, $species = '')
    {
        $query = str_replace(" ", " AND ", $label);
        try
        {
            $results = PathwayIndex::searchByText($query, $species);
        }
        catch(Exception $e)
        {
            $this->addError("Exception thrown for label: $label");
            return(array());
        }

        $mappings = array();
        if(count($results) > 0)
        {
            foreach($results as $result)
            {
                $mapping = array();
                $mapping['species'] = $result->getFieldValue("organism");
                $indexerId = $result->getFieldValue("indexerId");
                $mapping['pwId'] = substr($indexerId, strripos($indexerId, ":")+1);
                $mapping['score'] = (string)$result->getScore();
                $mappings[] = $mapping;
            }
        }
        return $mappings;
    }

    private function getLabels($pathways)
    {
        $labels = array();
        if(!is_array($pathways))
            $pathways = array($pathways);

        foreach($pathways as $pwId)
        {
            $pathway = Pathway::newFromTitle($pwId);
            $pwGPML = $pathway->getGpml();
            $gpml = simplexml_load_string($pwGPML);

            foreach($gpml->Label as $label )
            {
                $attributes = $label->attributes();
                $labels[] = strtolower(trim((string)$attributes->TextLabel));
            }

        }

        $uniqueLabels = array_unique($labels);
        return $uniqueLabels;
//   $labels = getLabels($pathway->id);
//            echo $labels[0];
//            $result = findPathwaysByLabels("TCA AND CYcle");
//            print_r($result);
//            endScript();

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

    private function createFiles()
    {
        $this->_logCount = 0;
        $logHeaders = "id\tlabel-count\tpathway-count\tmappings\tstatus\ttimestamp\tcomments\n";
        $logHandle = fopen($this->_logFileName, 'a');
        fwrite($logHandle, $logHeaders);
        fclose($logHandle);
        $errorHandle = fopen($this->_errorFileName, 'a');
        fwrite($errorHandle, "error\ttimestamp");
        fclose($errorHandle);
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

    private function addError($error)
    {
        $timeStamp = date("YmdiHs");
        $errorHandle = fopen($this->_errorFileName, 'a');
        $error = "$error\t$timeStamp";
        fwrite($errorHandle, $error);
        fclose($errorHandle);
    }

}