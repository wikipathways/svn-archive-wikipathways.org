<?php

$currentDir = getcwd();
require_once('wpi.php');
chdir($currentDir);

if(php_sapi_name() == 'cli')
{
    $argsMsg = "Available options :

Note: Parameters are Case sensitive
a)Update => method=update
Params: [type]=[path to score file], Seperate multiple entries by space
Example: php relations.php method=update xref=xref.txt label=label.txt

b)Get Relations => method=relation
Params: [param-name]=[param-value], Seperate multiple entries by &
Available Params: pwId_1, pwId_2, minScore, type(xref/label)
Example: php relations.php method=relation pwId_1=WP500 pwId_2=WP520 minscore=5 type=xref
";
    if($argv[0] == 'relations.php')
    {
        if($argc >= 2)
        {
            parse_str($argv[1], $args);
            switch($args['method'])
            {
                case 'update':

                    $relationType = array();

                    for($i = 2; $i < count($argv); $i++)
                    {
                        parse_str($argv[$i], $params);

                        if(count($params) == 0)
                        {
                            echo "Error: Please enter proper parameters\n\n";
                            echo $argsMsg;
                        }
                        else
                        {
                            foreach($params as $type => $file)
                            {
                                if($type == '' || $file == '')
                                {
                                    echo "Error in parameters";
                                    exit();
                                }
                                $relationType[] = array('type' => $type, 'file' => $file);
                            }                            
                        }
                    }

                    Relations::updateDb($relationType);
                break;

                case 'relation':
                    
                    $type = "";
                    $pwId_1 = "";
                    $pwId_2 = "";
                    $minscore = "";

                    for($i = 2; $i < count($argv); $i++)
                    {
                        parse_str($argv[$i]);
                    }

//                    echo $type . " " . $pwId_1 . " " . $pwId_2 . " " . $minscore;
                    
                    $results = Relations::fetchRelations($type, $pwId_1, $pwId_2, $minscore);

                    echo "Pathway Id 1\tPathway Id 2\tScore\tRelation type\n";
                    if(count($results) > 0)
                    {
                        foreach($results as $relation)
                        {
                            echo "{$relation->pwId_1}\t{$relation->pwId_2}\t{$relation->score}\t{$relation->type}\n";
                        }
                    }
                break;

                default:
                    echo "Error in parameters\n\n";
                    echo $argsMsg;
                    exit();
            }

        }
        else
        {
            echo $argsMsg;
            exit();
        }
    }
}
    
class Relations
{
    public static $_relationsTable = "relations";

    public static function lastUpdated()
    {
        $result['xref'] =  date("F d, Y H:i:s", filemtime(self::$_xrefScoreFile));
        $result['label'] =  date("F d, Y H:i:s", filemtime(self::$_labelScoreFile));
        return $result;
    }

    public static function checkFile($file)
    {
        if(!is_file($file))
            return false;
        else
            return true;
    }

    private static function refreshTable()
    {
        $dbw =& wfGetDB( DB_MASTER );
        $sql = "CREATE TABLE IF NOT EXISTS `" . self::$_relationsTable . "` (
                    `pwId_1` VARCHAR( 10 ) NOT NULL ,
                    `pwId_2` VARCHAR( 10 ) NOT NULL ,
                    `type` VARCHAR( 10 ) NOT NULL ,
                    `score` FLOAT UNSIGNED NOT NULL
                );";
        $create = $dbw->query($sql);
        $sql = "Truncate table "  . self::$_relationsTable ;
        $truncate = $dbw->query($sql);
    }

    public static function updateDb($relationType)
    {
        self::refreshTable();
        $dbw =& wfGetDB( DB_MASTER );

        foreach($relationType as $method)
        {
            if(!self::checkFile($method['file']))
            {
                echo "Error: File not found! {$method['file']}\n";
                exit();
            }
            
            $relations = self::readScoreFile($method['file']);
            foreach($relations as $relation)
            {
                 $dbw->insert( self::$_relationsTable , array(
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
        $query = "SELECT * FROM " . self::$_relationsTable ;
        $conditions = array();
        
        if($type != '')
            $conditions[] = "type = '$type'";

        if($pwId_1 != '' && $pwId_2 != '')
        {
            $conditions[] = "((pwId_1 = '$pwId_1' AND pwId_2 = '$pwId_2') OR (pwId_1 = '$pwId_2' AND pwId_2 = '$pwId_1'))";
        }
        elseif($pwId_1 != '' && $pwId_2 == '' || $pwId_1 == '' && $pwId_2 != '')
        {
            $pwId = ($pwId_1 == "")?$pwId_2:$pwId_1;
            $conditions[] = "(pwId_1 = '$pwId' OR pwId_2 = '$pwId')";
        }

        if($minScore > 0)
            $conditions[] = "score > '$minScore'";

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