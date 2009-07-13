<?php

include "config.php";

if(isset($_GET['ontology_id']))
$ontology_id = $_GET['ontology_id'];
else
$ontology_id = 1035;
if(isset($_GET['concept_id']))
$concept_id = $_GET['concept_id'];
else
$concept_id = "GO:0008150";


$xml = simplexml_load_file(url($ontology_id ,$concept_id));


$res_array;
data('childs');
sort($res_array);
$res_arr["ResultSet"]["Result"]=$res_array;
$res_json = json_encode($res_arr);
echo $res_json ;
//print_r($res_array);


function data($req)
{
    global $ontology_id ;
    global $xml;
	global $res_array;


$arr = $xml->data;
//print_r($xml->data->classBean->id->relations);


switch($req)
{
case 'childs':
{
foreach($xml->data->classBean->relations->entry as $entry )
{
    if($entry->string == "SubClass")
    {

       foreach($entry->list->classBean as $sub_concepts)
        {
   			$exact_match = no_paths("exact",$ontology_id,$sub_concepts->id);
            $path_match = no_paths("any",$ontology_id,$sub_concepts->id);
            $total_match = $exact_match . "/" . ( $path_match + $exact_match );
            $temp_var = $sub_concepts->label ." (" . $total_match .") - " . $sub_concepts->id;
            if($sub_concepts->relations->entry->int == "0")
            $temp_var .="||";
            $res_array[] = $temp_var;

        }

    }
}
break;
}
case 'no_childs':
    {
foreach($xml->data->classBean->relations->entry as $entry )
{
    if($entry->string == "ChildCount")
    {
         echo $entry->int . "<br/>";
    }

}
break;
}

}
}

function no_paths($match,$ontology_id,$concept_id)
{
$count = 0;
if($match == "exact")
$sql =  mysql_query("SELECT * FROM ontology where `term_id` = '$concept_id'") or die(mysql_error());
else
$sql =  mysql_query("SELECT * FROM ontology where `term_path` LIKE '%$concept_id.%' OR `term_path` LIKE '%$concept_id'") or die(mysql_error());
while($row=mysql_fetch_array($sql))
		{
            $count++;
        }
       //$path = $entry->string[1];   
return $count;
}

function url($ontology_id ,$concept_id)
    {
   $mail = "chetan1@gmail.com";
   $uri = "http://rest.bioontology.org/bioportal/virtual";
   return $url = $uri . "/" . $ontology_id . "/" . $concept_id . "?" . $mail ;

    }

?> 