<?php

$currentDir = getcwd();
require_once('../../../wpi.php');
chdir($currentDir);

relations::updateDb();

class relations
{

    public static $xrefScoreFile = "../java/xref-relations-scores.txt";
    public static $labelScoreFile = "label-relations-scores.txt";
    public static $relationsTable = "relations";

    public static function lastUpdated()
    {
        $result['xref'] =  date("F d, Y H:i:s", filemtime(self::$xrefScoreFile));
        $result['label'] =  date("F d, Y H:i:s", filemtime(self::$labelScoreFile));
        return $result;
    }

    private static function refreshTable()
    {
        $dbw =& wfGetDB( DB_MASTER );
        $sql = "CREATE TABLE IF NOT EXISTS `" . self::$relationsTable . "` (
                    `pwId_1` VARCHAR( 10 ) NOT NULL ,
                    `pwId_2` VARCHAR( 10 ) NOT NULL ,
                    `type` VARCHAR( 10 ) NOT NULL ,
                    `score` FLOAT UNSIGNED NOT NULL
                );";
        $create = $dbw->query($sql);
        $sql = "Truncate table "  . self::$relationsTable ;
        $truncate = $dbw->query($sql);
    }

    public static function updateDb()
    {
        self::refreshTable();
        $dbw =& wfGetDB( DB_MASTER );

        $relationType = array(
                            array('file' => self::$xrefScoreFile, 'type' => 'xref' ),
                            array('file' => self::$labelScoreFile, 'type' => 'label')
                        );
        
        foreach($relationType as $method)
        {
            $relations = self::readScoreFile($method['file']);
            foreach($relations as $relation)
            {
                 $dbw->insert( self::$relationsTable , array(
                                                'pwId_1' => $relation['pwId_1'],
                                                'pwId_2' => $relation['pwId_2'],
                                                'type' => $method['type'],
                                                'score' => $relation['score']
                                                )
                                            );
            }
        }

    }

    public static function fetchRelations($type = '', $pwId_1 = '', $pwId_2 = '', $minScore = 0)
    {
        $dbr =& wfGetDB(DB_SLAVE);
        $query = "SELECT * FROM " . self::$relationsTable ;
        $conditions = array();
        
        if($type != '')
            $conditions[] = "type = '$type'";
        if($pwId_1 != '')
            $conditions[] = "pwId_1 = '$pwId_1'";
        if($pwId_2 != '')
            $conditions[] = "pwId_2 = '$pwId_2'";
        if($minScore > 0)
            $conditions[] = "score > '$score'";

        if(count($conditions) > 0)
        {
            $cons = implode (" AND ", $conditions);
            $query .= " Where $cons";
        }

        $res = $dbr->query($query);
        while($row = $dbr->fetchObject($res))
        {
            $result[] = $row;
        }
        $dbr->freeResult( $res );

        return $result;
    }
    
    private static function readScoreFile($scoreFile)
    {
        $file = file($scoreFile);
        $relations = array();

        for($i = 1; $i < count($file); $i++)
        {
            $relation = explode("\t",trim($file[$i]));
            $relation = array(
                            'pwId_1' => $relation[0],
                            'pwId_2' => $relation[1],
                            'score' => $relation[2],
                            );
            if($relation['score'] > 0)
            {
                $relations[] = $relation;
            }
        }
        return $relations;
    }
}
?>