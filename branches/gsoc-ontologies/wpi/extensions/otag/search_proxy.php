<?php

if(isset($_GET['ontology_id']))
$ontology_id = $_GET['ontology_id'];
else
$ontology_id = "1070,1035,1009";

if(isset($_GET['search_term']))
$search_term = $_GET['search_term'];
else
$search_term = "gene" ;

if(isset($_GET['max_hits']))
$max_hits = $_GET['max_hits'];
else
$max_hits = 12 ;

//$ch = curl_init(url($ontology_id ,$search_term,$max_hits));
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HEADER, 0);
////curl_setopt($ch, CURLOPT_PROXY, "http://169.254.64.162");
////curl_setopt($ch, CURLOPT_PROXYPORT, 808);
//
//$xml = curl_exec($ch);
//curl_close($ch);
//
//$xml = simplexml_load_string($xml);
//

$xml = simplexml_load_file(url($ontology_id ,$search_term,$max_hits));
//echo url(40021,"GO:0008150")."<br>";

$res_array;


//echo $xml;
//print_r($xml);
$count = 0;
data('childs');
//print_r($res_array);
//sort($res_array);
$res_arr["ResultSet"]["Result"]=$res_array;
$res_json = json_encode($res_arr);
echo $res_json ;



function data($req)
{
    global $ontology_id ;
    global $xml;
	global $res_array;
    global $count;

$arr = $xml->data;



switch($req)
{
case 'childs':
{
foreach($xml->data->page->contents->searchResultList->searchBean as $search_result )
{
            //print_r((string)$search_result->contents);
            $res_array[$count]->label = str_replace('"','',(string)$search_result->contents);
        	$res_array[$count]->id = str_replace('"','',(string)$search_result->conceptId);
            $res_array[$count]->ontology = (string)$search_result->ontologyDisplayLabel;
            //echo '<a href="' . proxy_url($ontology_id ,$sub_concepts->id ).'">'.$sub_concepts->label . "</a>";
            //echo " " . $sub_concepts->relations->entry->int . "<br/>";
            $count++;
}
if ($count == 0)
{
    $res_array[$count]->label = "No results !";
    $res_array[$count]->id = "No results !";
}
break;
}

}
}




function url($ontology_id ,$search_term,$max_hits)
    {
   $mail = "chetan1@gmail.com";
   $uri = "http://rest.bioontology.org/bioportal/search";
   return $url = $uri . "/" . $search_term . "/?ontologyids=" . $ontology_id . "&maxnumhits=" . $max_hits . "&email=" . $mail ;

    }

?> 
