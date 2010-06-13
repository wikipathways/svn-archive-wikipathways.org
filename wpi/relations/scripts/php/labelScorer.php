<?php

$currentDir = getcwd();
require_once('../../../wpi.php');
chdir($currentDir);
require_once('labelMapper.php');


$scorer = new LabelScorer();
$scorer->init();

class LabelScorer
{
    private $_db;
    private $_labelMappingTable;
    private $_labelMappings = array();
    private $_pathwayMappings = array();
    private $_relations = array();
    public $_scoresFile = "label-mapper-scores.txt";

    public function __construct()
    {
        $this->_db =& wfGetDB(DB_SLAVE);
        $mapper = new LabelMapper();
        $this->_labelMappingTable = $mapper->_labelMappingTable;
    }

    public function init()
    {
        // Refresh the scores file
        if(is_file($this->_scoresFile))
        {
            unlink($this->_scoresFile);
        }
        $fh = fopen($this->_scoresFile, 'w');
        $fileHeaders = "PW1\tPW2\tNr Common Labels\n";
        fwrite($fh, $fileHeaders);
        fclose($fh);

        $pathways = $this->getMappedPathways();
        if(count($pathways) > 0)
        {
            foreach($pathways as $pwId)
            {
                $relations = $this->findRelations($pwId);
                foreach($relations as $pw => $score)
                {
                    $this->logScore($pwId, $pw, $score);
                }
                $this->_relations[$pwId] = 1;
            }
        }
    }

    public function getMappedPathways()
    {
        $pathways = array();
        $res = $this->_db->query("Select Distinct pwId from labelmappings");

        while($row = $this->_db->fetchObject($res))
            $pathways[] = $row->pwId;

        return $pathways;
    }

    private function findRelations($pwId)
    {
        $labels = $this->getLabelsbyPathway($pwId);
        $relation = array();
        foreach($labels as $label)
        {
            $pathways = $this->getPathwaysbyLabel($label);
            foreach($pathways as $pw)
            {
               if(!array_key_exists($pw, $this->_relations) && $pwId != $pw)
               {
                   $relation[$pw]++;
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