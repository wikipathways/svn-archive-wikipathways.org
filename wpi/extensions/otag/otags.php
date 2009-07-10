<?php
require_once('../../wpi.php');
$title = $_POST['title'];
if($_POST['action']=="fetch")
{
    fetch();
}
else
{
    add();
}
function add()
{
    global $title;
    $pathway = get_pw();
    $gpml = $pathway->getGpml();
    $otag = $_POST['tag'];
    $comment = mysql_real_escape_string($_POST['comment']);
    $xml = simplexml_load_string($gpml);
    $dbw =& wfGetDB( DB_MASTER );

    if(!isset($xml->Biopax[0]))
    $xml->addChild("Biopax");
    else
    {
    $entry = $xml->Biopax[0]; 
    $namespaces = $entry->getNameSpaces(true);
//  print_r($namespaces);
    $bp = $entry->children($namespaces['bp']);
    unset($bp->openControlledVocabulary);
    }
  //  echo $otag;

    if($otag != "NULL")
        {
            $json_obj = json_decode($otag);
            foreach ($json_obj as $tag )
            {
                $id = mysql_real_escape_string($tag[1]);
                $path_arr[$id] = get_path($id) ;
            }

            $dbw->delete( 'ontology', array( 'pw_id' => $title ), $fname );
            foreach ($json_obj as $tag )
            {
               $tag[0] = mysql_real_escape_string($tag[0]);
               $tag[1] = mysql_real_escape_string($tag[1]);
               $tag[2] = mysql_real_escape_string($tag[2]);
               $path = $path_arr[$tag[1]];
               $n = $xml->Biopax->addChild("bp:openControlledVocabulary","","http://www.biopax.org/release/biopax-level2.owl#");
                $n->addChild("TERM",$tag[0]);
                $n->addChild("ID",$tag[1]);
                $n->addChild("Ontology",$tag[2]);
                $dbw->insert( 'ontology',
                  array(
                           'term_id' => $tag[1],
                           'term'    => $tag[0],
                           'ontology'=> $tag[2],
                           'pw_id'   => $title,
                           'term_path'  => $path ),
                  $fname,
                  'IGNORE' );

            }
        
        }
        else
        {
            $dbw->delete( 'ontology', array( 'pw_id' => $title ), $fname );
        }

    $gpml = $xml->asXML();
    $pathway->updatePathway($gpml,$comment);
    //throw new Exception("sdsd");
    echo "Success";
}

function fetch()
{
    global $title;
    $dbr =& wfGetDB(DB_SLAVE);
    $pathway = get_pw();
    $gpml = $pathway->getGpml();
    $xml = simplexml_load_string($gpml);
    $entry = $xml->Biopax ;

$query = "SELECT * FROM `ontology` " . "WHERE `pw_id` = '$title' ORDER BY `ontology`";
$res = $dbr->query($query);
//$res = $dbr->select( 'ontology', array('term','term_id','ontology'), array( 'pw_id' => $title ), $fname = 'Database::select', $options = array('Group by' => 'ontology' ));
$result_arr;
while($row = $dbr->fetchObject($res))
{
    $temp_arr['term_id'] = $row->term_id;
    $temp_arr['term'] = $row->term;
    $temp_arr['ontology'] = $row->ontology;
    $result_arr['Resultset'][]=$temp_arr;
    $count++;
}
   $dbr->freeResult( $res );

    $result_json = json_encode($result_arr);


    if($count > 0)
    echo $result_json;
    else
    echo "No Tags";
}

function get_path($id)
{

//$path = "check";

switch ( substr($id,0,2) )
{
    case "PW":
        $ontology_id = 1035;
        break;
    case "GO":
        $ontology_id = 1070;
        break;
    case "DO":
        $ontology_id = 1009;
        break;
}

$dbr =& wfGetDB(DB_SLAVE);
$res = $dbr->select( 'ontology', array('term_path'), array( 'term_id' => $id  ) );
while($row = $dbr->fetchObject($res))
{
    $path = $row->term_path;
}

if($path == null)
{
$xml = simplexml_load_file("http://rest.bioontology.org/bioportal/virtual/rootpath/$ontology_id/$id?email=chetan1@gmail.com");
if($xml->data->list->classBean->relations->entry)
{
foreach($xml->data->list->classBean->relations->entry as $entry )
{
    if($entry->string == "Path")
    {
       $path = $entry->string[1];
    }
}
}
}
return $path;
}

function get_pw()
{
global $title;
$pathway = Pathway::newFromTitle($title);
return $pathway;
}



?>