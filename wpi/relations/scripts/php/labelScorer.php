<?php

if(php_sapi_name() != 'cli')
{
    echo "This script must be run from the command line\n";
    exit();
}

$currentDir = getcwd();
require_once('../../../wpi.php');
chdir($currentDir);
require_once('labelMapper.php');

$argsMsg = "Available options: \na)Initiate/Update => method=update\n\n";

if($argv[0] == 'labelScorer.php')
{
    if($argc == 2)
    {
        parse_str($argv[1], $args);
        switch($args['method'])
        {
            case 'update':
                LabelScorer::execute();
            break;
            default:
                echo $argsMsg;
        }

    }
    else
    {
        echo $argsMsg;
    }
}
/*
 * Calculates relations/scores between pairs of pathways based on the common labels.
 *
 * Usage : a) Call the static function execute() b) Execute from command line by executing "php LabelScorer.php method=update"
 */

class LabelScorer
{
    private $_db;
    private $_labelMappingTable;
    private $_labelMappings = array();
    private $_pathwayMappings = array();
    private $_relations = array();
    public $_scoresFile = "label-relations-scores.txt";

    public function __construct()
    {
        $this->_db =& wfGetDB(DB_SLAVE);
        $mapper = new LabelMapper();
        $this->_labelMappingTable = $mapper->_labelMappingTable;
    }

    public static function execute()
    {
        $scorer = new LabelScorer();
        $scorer->init();
    }

    public function init()
    {
        // Refresh the scores file
        if(is_file($this->_scoresFile))
        {
            unlink($this->_scoresFile);
        }
        $fh = fopen($this->_scoresFile, 'w');
        if(!$fh)
        {
            echo "Please set proper permissions for Score file.\n";
            exit();
        }
        $fileHeaders = "PW1\tPW2\tNr Common Labels\n";
        fwrite($fh, $fileHeaders);
        fclose($fh);

        $pathways = $this->getMappedPathways();
        if(count($pathways) > 0)
        {
            foreach($pathways as $pwId => $pwSpecies)
            {
                $relations = $this->findRelations($pwId);
                foreach($relations as $pwTo => $score)
                {
                    // Get relations between pathways of same species
                    if($pwSpecies == $pathways[$pwTo])
                    {
                        $this->logScore($pwId, $pwTo, $score);
                    }
                }
                $this->_relations[$pwId] = 1;
            }
        }
    }

    public function getMappedPathways()
    {
        $pathways = array();
        $res = $this->_db->query("Select pwId,species from labelmappings Group by pwId");

        while($row = $this->_db->fetchObject($res))
            $pathways[$row->pwId] = $row->species;

        return $pathways;
    }

    private function findRelations($pwId)
    {
        $labels = $this->getLabelsbyPathway($pwId);
        $relation = array();
        foreach($labels as $label)
        {
            $pathways = $this->getPathwaysbyLabel($label);
            foreach($pathways as $pwTo)
            {
               if(!array_key_exists($pwTo, $this->_relations) && $pwId != $pwTo)
               {
                   $relation[$pwTo]++;
               }
            }
        }
        return $relation;
    }

    private function getLabelsbyPathway($pwId)
    {
        $labels = array();
        if(array_key_exists($pwId, $this->_pathwayMappings))
        {
            $labels = $this->_pathwayMappings[$pwId];
        }
        else
        {
            $res = $this->_db->select("labelmappings",array('label') , array('pwId' => $pwId));
            while($row = $this->_db->fetchObject($res))
            {
                $labels[] = $row->label;
            }
            $this->_db->freeResult($res);
            $this->_pathwayMappings[$pwId] = $labels;
        }
        return $labels;
    }

    private function getPathwaysbyLabel($label)
    {
        $pathways = array();
        if(array_key_exists($label, $this->_labelMappings))
        {
            $pathways = $this->_labelMappings[$label];
        }
        else
        {
            $db =& wfGetDB(DB_SLAVE);
            $res = $db->select("labelmappings",array('pwId','species') , array('label' => $label));
            while($row = $db->fetchObject($res))
            {
                $pathways[] = $row->pwId;
            }
            $db->freeResult($res);
            $this->_labelMappings[$label] = $pathways;
        }
        return $pathways;
    }

    private function logScore($pw1, $pw2, $score)
    {
        $fh = fopen($this->_scoresFile, 'a');
        $log = "$pw1\t$pw2\t$score\n";
        fwrite($fh, $log);
        fclose($fh);
    }

}