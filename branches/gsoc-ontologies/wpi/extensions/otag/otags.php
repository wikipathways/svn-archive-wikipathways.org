<?php
require_once('ontologyfunctions.php');
switch($_REQUEST['action'])
{
    case 'remove' :
        echo ontologyfunctions::removeOntologyTag($_POST['tagId'],$_POST['title']);
        break;

    case 'add' :
        echo ontologyfunctions::addOntologyTag($_POST['tagId'],$_POST['tag'],$_POST['title']);
        break;

    case 'search' :
        echo ontologyfunctions::getBioPortalSearchResults($_GET['search_term']);
        break;
    
    case 'fetch' :
        {
            $title = $_POST['title'];
            $dbr =& wfGetDB(DB_SLAVE);
            $query = "SELECT * FROM `ontology` " . "WHERE `pw_id` = '$title' ORDER BY `ontology`";
            $res = $dbr->query($query);
            while($row = $dbr->fetchObject($res))
            {
                $term['term_id'] = $row->term_id;
                $term['term'] = $row->term;
                $term['ontology'] = $row->ontology;
                $resultArray['Resultset'][]=$term;
                $count++;
            }
           $dbr->freeResult( $res );
           $resultJSON = json_encode($resultArray);
            if($count > 0)
                 echo $resultJSON ;
            else
                echo "No Tags";
        }
        break;
}