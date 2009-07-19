<?php

require_once('../../wpi.php');
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
}






function fetch_tree()
{
    global $xml, $res_array, $ontology_id, $concept_id;
    $xml = simplexml_load_file(url($ontology_id ,$concept_id));
    fetch_terms();
    //sort($res_array);
    $res_arr["ResultSet"]["Result"]=$res_array;
    $res_json = json_encode($res_arr);
    echo $res_json ;
    //print_r($res_array);
}


function fetch_terms()
{
    global $ontology_id ;
    global $xml;
	global $res_array;


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
            $total_match = " (" . ( $path_match + $exact_match ) . ")";
            }
            
            $temp_var = $sub_concepts->label . $total_match ." - " . $sub_concepts->id;
            if($sub_concepts->relations->entry->int == "0")
            $temp_var .="||";
            $res_array[] = $temp_var;

        }

//case 'no_childs':
//    {
//foreach($xml->data->classBean->relations->entry as $entry )
//{
//    if($entry->string == "ChildCount")
//    {
//         echo $entry->int . "<br/>";
//    }
//
//}
//break;
//}

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
    //sort($res_array);
}

function url($ontology_id ,$concept_id)
    {
        $mail = "chetan1@gmail.com";
        $uri = "http://rest.bioontology.org/bioportal/virtual";
        return $url = $uri . "/" . $ontology_id . "/" . $concept_id . "?" . $mail ;
    }

function fetch_pathway_name($title)
{
    $p = Pathway::newFromTitle($title);
    return "<b><a href='{$p->getFullUrl()}'>{$p->name()}</a></b>";
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