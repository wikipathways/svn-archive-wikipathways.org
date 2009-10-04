<?php

include('../../wpi.php');
include('../ontologyindex/ontologycache.php');

if(isset($_GET['ontology_id']))
$ontology_id = $_GET['ontology_id'];
else
$ontology_id = 1035;
if(isset($_GET['concept_id']))
$concept_id = $_GET['concept_id'];
else
$concept_id = "GO:0008150";


//$ch = curl_init(url($ontology_id ,$concept_id));
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_setopt($ch, CURLOPT_PROXY, "http://169.254.64.162");
//curl_setopt($ch, CURLOPT_PROXYPORT, 808);
//
//$xml = curl_exec($ch);
//curl_close($ch);
//
//$xml = simplexml_load_string($xml);


$xml = $xml = simplexml_load_string(ontologycache::fetchCache("tree",url($ontology_id ,$concept_id)));
$res_array;
data('childs');
sort($res_array);
$res_arr["ResultSet"]["Result"]=$res_array;
$res_json = json_encode($res_arr);
echo $res_json ;
//print_r($res_array);
//echo $res_json=($res_json == '{"ResultSet":{"Result":[')? $res_json . "]}}" : substr($res_json,0,-1) . "]}}";

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
   			$temp_var = $sub_concepts->label . " - " . $sub_concepts->id;
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


function url($ontology_id ,$concept_id)
    {
   $mail = BIOPORTAL_ADMIN_MAIL;
   $uri = "http://rest.bioontology.org/bioportal/virtual/ontology";
   return $url = $uri . "/" . $ontology_id . "/" . $concept_id . "?email=" . $mail ;

    }

?> 