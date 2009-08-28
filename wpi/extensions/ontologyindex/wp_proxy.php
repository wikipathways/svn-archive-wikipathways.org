<?php

include('../../wpi.php');
$ontology_id = $_GET['ontology_id'];
$concept_id = $_GET['concept_id'];

$xml;
$res_array;

switch($_GET['action'])
{
    case 'tree':
        fetch_tree();
        break;
    case 'pathways':
        fetch_pathways();
        break;
    case 'species':
        fetch_species();
        break;
    case 'list':
        fetch_pw_list();
        break;
}


function fetch_pw_list()
{
    $term = $_GET['term'];
    switch($_GET['filter'])
        {
            case 'All' :
                {
                    $pathways = Pathway::getAllPathways();

                    foreach($pathways as $p) {
                        if($p->species() != $_GET['species']  && $_GET['species'] != "All Species")
                        continue;
                        if($term!="")
                        {
                            $title = $p->getTitleObject()->getDbKey();
                            $count = 0;
                            $dbr =& wfGetDB(DB_SLAVE);
                            $sql = "SELECT * FROM ontology where (`term_id` = '$term' OR `term_path` LIKE '%$term.%' OR `term_path` LIKE '%$term') AND (`pw_id` = '$title')";
                            $res = $dbr->query($sql);
                            while($row = $dbr->fetchObject($res))
                            {
                                $count++;
                            }
                            if($count == 0)
                            continue;
                        }
                        $pwName = $p->name();
                        $pwArray[$p->getFullUrl()] = strtoupper(substr($pwName,0,1)) . substr($pwName,1) ;
                    }
                    if(count($pwArray)>0)
                    {
                        asort($pwArray,SORT_STRING);
                        echo '<table><tbody>';
                        foreach($pwArray as $url=>$pwTitle)
                        {

                            if($count%2 == 0)
                                echo "<tr><td><ul><li><a href='$url'>$pwTitle</a></li></ul></td>";
                            else
                                echo "<td><ul><li><a href='$url'>$pwTitle</a></li></ul></td></tr>";
                            $count++;
                        }
                        echo "</tbody></table>";
                    }
                    break;
                }
            case 'Edited' :
                {
                    $dbr =& wfGetDB( DB_SLAVE );
                    $sql = "SELECT
                                    'Mostrevisions' as type,
                                    page_namespace as namespace,
                                    page_id as id,
                                    page_title as title,
                                    COUNT(*) as value
                                FROM `revision`
                                JOIN `page` ON page_id = rev_page
                                WHERE page_namespace = 102" . "
                                AND page_is_redirect = 0
                                GROUP BY 1,2,3
                                HAVING COUNT(*) > 1
                                ";
                    $res = $dbr->query($sql);
                    while($row = $dbr->fetchObject($res))
                    {
                        $pathwayArray[$row->title] = $row->value;
                    }
                    arsort($pathwayArray);
                    echo '<table><tbody>';
                    foreach($pathwayArray as $title=>$value )
                    {
                        $p = Pathway::newFromTitle($title);
                        if($p->species() != $_GET['species']  && $_GET['species'] != "All Species")
                        continue;
                        if($term!="")
                        {
                            $title = $p->getTitleObject()->getDbKey();
                            $count = 0;
                            $sql = "SELECT * FROM ontology where (`term_id` = '$term' OR `term_path` LIKE '%$term.%' OR `term_path` LIKE '%$term') AND (`pw_id` = '$title')";
                            $res = $dbr->query($sql);
                            while($result = $dbr->fetchObject($res))
                            {
                                $count++;
                            }
                            if($count == 0)
                            continue;
                        }
                        if($count%2 == 0)
                            echo "<tr><td><li align='left'><a href='{$p->getFullUrl()}'>{$p->name()}</a> (" . $value ." Revisions) </li></td>";
                        else
                            echo "<td><li align='right'><a href='{$p->getFullUrl()}'>{$p->name()}</a> (" . $value ." Revisions) </li></td></tr>";
                        $count++;
                    }
                    echo "</tbody></table>";
                    break;
               }
            case 'Popular':
               {
                    $dbr =& wfGetDB( DB_SLAVE );
            		$page = $dbr->tableName( 'page' );
                    $sql =  "SELECT 'Popularpages' as type,
                            page_namespace as namespace,
                            page_title as title,
                            page_id as id,
                            page_counter as value
                            FROM $page
                            WHERE page_namespace=".NS_PATHWAY."
                            AND page_is_redirect=0";
                            $res = $dbr->query($sql);
                            while($row = $dbr->fetchObject($res))
                            {
                                $pathwayArray[$row->title] = $row->value;
                                arsort($pathwayArray);
                            }
                            foreach($pathwayArray as $title=>$value )
                            {
                                $p = Pathway::newFromTitle($title);
                                if($p->species() != $_GET['species']  && $_GET['species'] != "All Species")
                                continue;
                                if($term!="")
                                {
                                    $title = $p->getTitleObject()->getDbKey();
                                    $count = 0;
                                    $sql = "SELECT * FROM ontology where (`term_id` = '$term' OR `term_path` LIKE '%$term.%' OR `term_path` LIKE '%$term') AND (`pw_id` = '$title')";
                                    $res = $dbr->query($sql);
                                    while($result = $dbr->fetchObject($res))
                                    {
                                        $count++;
                                    }
                                    if($count == 0)
                                    continue;
                                }
                                echo "<li><a href='{$p->getFullUrl()}'>{$p->name()}</a> (" . $value ." Views) </li>";
                            }
                            break;
                }
            case 'last_edited':
               {
                    $dbr =& wfGetDB( DB_SLAVE );
            		$page = $dbr->tableName( 'page' );
                    $sql1 = "SELECT page_title as title, page_touched as timestamp  FROM $page WHERE page_namespace=".NS_PATHWAY." AND page_is_redirect=0 ORDER BY `page_touched` DESC";

                    $sql =  "SELECT 'Popularpages' as type,
                            page_namespace as namespace,
                            page_title as title,
                            page_id as id,
                            page_counter as value
                            FROM $page
                            WHERE page_namespace=".NS_PATHWAY."
                            AND page_is_redirect=0 ORDER BY `page_touched` DESC";
                            $res = $dbr->query($sql1);

                            while($row = $dbr->fetchObject($res))
                            {
                                $timestamp = $row->timestamp;
                                $year = substr($timestamp, 0, 4);
                                $month = substr($timestamp, 4, 2);
                                $day = substr($timestamp, 6, 2);
                                $date = date('M d, Y', mktime(0,0,0,$month, $day, $year));
                                $pathwayArray[$row->title] = $date;
                            }
                            foreach($pathwayArray as $title=>$value )
                            {
                                $p = Pathway::newFromTitle($title);
                                if($p->species() != $_GET['species']  && $_GET['species'] != "All Species")
                                continue;
                                if($term!="")
                                {
                                    $title = $p->getTitleObject()->getDbKey();
                                    $count = 0;
                                    $sql = "SELECT * FROM ontology where (`term_id` = '$term' OR `term_path` LIKE '%$term.%' OR `term_path` LIKE '%$term') AND (`pw_id` = '$title')";
                                    $res = $dbr->query($sql);
                                    while($result = $dbr->fetchObject($res))
                                    {
                                        $count++;
                                    }
                                    if($count == 0)
                                    continue;
                                } 
                                echo "<li><a href='{$p->getFullUrl()}'>{$p->name()}</a> (Edited on <b>" . $pathwayArray[$title] . "</b>) </li>";
                            }
                            break;
                }

         }
}

function fetch_tree()
{
    global $xml, $res_array, $ontology_id, $concept_id;

    $xml = simplexml_load_file(url($ontology_id ,$concept_id));
//    $ch = curl_init(url($ontology_id ,$concept_id));
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_HEADER, 0);
//    curl_setopt($ch, CURLOPT_PROXY, "http://10.3.1.61");
//    curl_setopt($ch, CURLOPT_PROXYPORT, 2525);
//
//    $xml = curl_exec($ch);
//    curl_close($ch);
//
//    $xml = simplexml_load_string($xml);

    fetch_terms();

    $res_arr["ResultSet"]["Result"]=$res_array;
    $res_json = json_encode($res_arr);
    echo $res_json ;

}


function fetch_terms()
{
    global $ontology_id ;
    global $concept_id ;
    global $xml;
	global $res_array;

    if($_GET['tree_pw'] == "yes")
    {
    $dbr =& wfGetDB(DB_SLAVE);
    $sql = "SELECT * FROM ontology where `term_id` = '$concept_id'";
    $res = $dbr->query($sql);
    while($row = $dbr->fetchObject($res))
        {
            if($_GET['species'] != "All Species")
            {
            if(fetch_pathway_species($row->pw_id) == $_GET['species'])
            {
                $p = Pathway::newFromTitle($row->pw_id);
                $p_id = $row->pw_id;
//              $pw = "<font face='Verdana'><i><b><a href='{$p->getFullUrl()}'>{$p->name()}</a></b></i></font>";
                $pw = $p->name();
                $res_array[] =  ">> " . $pw . " - " . $p_id . "0000a||";
                //$pw .=  $row->pw_id . ", ";
            }
            }
            else
            {
                $p = Pathway::newFromTitle($row->pw_id);
//              $pw = "<font face='Verdana'><i><b>{$p->name()}</b></i></font>";
                $p_id = $row->pw_id;
//              $pw = "<font face='Verdana'><i><b><a href='{$p->getFullUrl()}'>{$p->name()}</a></b></i></font>";
                $pw = $p->name();
                $res_array[] =  ">> <b><font face='Verdana' color='blue'>" . $pw . "</font></b> - " . $p_id . "0000a||";
                
                }
        }

    }
$arr = $xml->data;
//print_r($xml->data->classBean->id->relations);

foreach($xml->data->classBean->relations->entry as $entry )
{
    if($entry->string == "SubClass")
    {

       foreach($entry->list->classBean as $sub_concepts)
        {
   			$exact_match = no_paths("exact",$ontology_id,$sub_concepts->id);
            $path_match = no_paths("any",$ontology_id,$sub_concepts->id);

            if($_GET['mode'] != "")
            {
            if($_GET['mode'] == "tree")
            $total_match = " (" . $exact_match . "/" . ( $path_match + $exact_match ) . ")";
            else
            if($_GET['mode'] == "sidebar")
            $total_match = " (" . ( $path_match + $exact_match ) . ")";
            }
            
            $temp_var = $sub_concepts->label . $total_match ." - " . $sub_concepts->id;
            if($sub_concepts->relations->entry->int == "0" && $exact_match ==0 )
            $temp_var .="||";
            $res_array[] = $temp_var;

        }

    }
}

}
function no_paths($match,$ontology_id,$concept_id)
{
    $count = 0;
    $dbr =& wfGetDB(DB_SLAVE);
    if($match == "exact")
    $sql = "SELECT * FROM ontology where `term_id` = '$concept_id'";
    else
    $sql = "SELECT * FROM ontology where `term_path` LIKE '%$concept_id.%' OR `term_path` LIKE '%$concept_id'";

    $res = $dbr->query($sql);
    while($row = $dbr->fetchObject($res))
    {
        if($_GET['species'] != "All Species")
        {
            if(fetch_pathway_species($row->pw_id) == $_GET['species'])
            $count++;
        }
        else
        $count++;
    }
       $dbr->freeResult( $res );

    return $count;
}

function fetch_pathways()
{
    global $concept_id;
    global $xml, $res_array, $ontology_id, $concept_id;
    $dbr =& wfGetDB(DB_SLAVE);

    echo "<b>" . $_GET['ontology_term'] . "</b><br>";
    $sql = "SELECT * FROM ontology where `term_id` = '$concept_id'";
    $res = $dbr->query($sql);
    while($row = $dbr->fetchObject($res))
        {
            if($_GET['species'] != "All Species")
            {
            if(fetch_pathway_species($row->pw_id) == $_GET['species'])
            echo  fetch_pathway_name($row->pw_id) . "<br>";
            }
            else
            echo  fetch_pathway_name($row->pw_id) . "<br>";
        }
    $xml = simplexml_load_file(url($ontology_id ,$concept_id));
    fetch_terms();
    $res_arr["ResultSet"]["Result"]=$res_array;
    if($res_array != null)
    {
    foreach($res_array as $term)
    {
    $id = str_replace("||", "", substr($term, strpos($term," - ")+3));
    echo $term = "&nbsp;&nbsp;&nbsp;" . substr($term, 0, strpos($term," - ")) . " <br>";
    $sql = "SELECT * FROM ontology where `term_id` = '$id'";
    $res = $dbr->query($sql);
    while($row = $dbr->fetchObject($res))
        {
            if($_GET['species'] != "All Species")
            {
            if(fetch_pathway_species($row->pw_id) == $_GET['species'])
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . fetch_pathway_name($row->pw_id) . "<br>";
            }
            else
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . fetch_pathway_name($row->pw_id) . "<br>";
        }
    }
    }
    //sort($res_array);
}

function url($ontology_id ,$concept_id)
    {
        $mail = BIOPORTAL_ADMIN_MAIL;
        $uri = "http://rest.bioontology.org/bioportal/virtual";
        return $url = $uri . "/" . $ontology_id . "/" . $concept_id . "?" . $mail ;
    }

function fetch_pathway_name($title)
{
    $p = Pathway::newFromTitle($title);
    return "<font face='Verdana'><i><b><a href='{$p->getFullUrl()}'>{$p->name()}</a></b></i></font>";
}
function fetch_pathway_species($title)
{
    $p = Pathway::newFromTitle($title);
    $specie = $p->species();
    return $specie;
}

function fetch_species()
{
    $result = Pathway::getAvailableSpecies();
    $result = json_encode($result);
    echo($result);
}
?> 