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
        fetch_pw_list(false);
        break;
    case 'image':
        fetch_pw_list(true);
        break;
}


function fetch_pw_list($imageMode)
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
                        $pwUrl = "<a href='" . $p->getFullUrl() . "' >" . $pwName . "</a>";
                        $display = ($imageMode)?process($p->getTitleObject()->getDbKey(), $pwUrl):$pwUrl;
                        $pwArray[$p->getFullUrl()] = strtoupper(substr($pwName,0,1)) . substr($pwName,1) . " |-| " . $display;
                    }
                    if(count($pwArray)>0)
                    {
                        asort($pwArray,SORT_STRING);
                        echo '<table><tbody>';
                        foreach($pwArray as $url=>$pwTitle)
                        {
                            $pwTitle = substr($pwTitle, strpos($pwTitle,"|-|")+ 3);
                            if($count%2 == 0)
                                echo "<tr><td><span id='pathway_list_left'><ul><li>$pwTitle</li></ul></span></td>";
                            else
                                echo "<td align='left'><span id='pathway_list_right'><ul><li>$pwTitle</li></ul></span></td></tr>";
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
                        $pwUrl = "<a href='{$p->getFullUrl()}'>{$p->name()}</a><br /> (" . $value ." Revisions)";
                        $display = ($imageMode)?process($title, $pwUrl):$pwUrl;
                        if($count%2 == 0)
                        {
                            echo "<tr><td><span id='pathway_list_left'><ul><li>$display</li></ul></span></td>";;
                        }
                        else
                        {
                            echo "<td><span id='pathway_list_right'><ul><li>$display</li></ul></span></td></tr>";;
                        }
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
                            echo "<table><tbody>";
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
                                $pwUrl = "<a href='{$p->getFullUrl()}'>{$p->name()}</a><br /> (" . $value ." Views)";
                                $display = ($imageMode)?process($title, $pwUrl):$pwUrl;
                                if($count%2 == 0)
                                {
                                    echo "<tr><td><span id='pathway_list_left'><ul><li>$display</li></ul></span></td>";;
                                }
                                else
                                {
                                    echo "<td><span id='pathway_list_right'><ul><li>$display</li></ul></span></td></tr>";;
                                }
                                $count++;

                            }
                            echo "</tbody></table>";
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
                            echo "<table><tbody>";                            
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
                                $pwUrl = "<a href='{$p->getFullUrl()}'>{$p->name()}</a><br /> (Edited on <b>" . $pathwayArray[$title] . "</b>) </li>";
                                $display = ($imageMode)?process($title, $pwUrl):$pwUrl;
                                if($count%2 == 0)
                                {
                                    echo "<tr><td><span id='pathway_list_left'><ul><li>$display</li></ul></span></td>";;
                                }
                                else
                                {
                                    echo "<td><span id='pathway_list_right'><ul><li>$display</li></ul></span></td></tr>";;
                                }
                                $count++;

                            }
                            echo "</tbody></table>";
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
function makeThumbLinkObj1( $pathway, $label = '', $href = '', $alt, $align = 'right', $id = 'thumb', $boxwidth = 180, $boxheight=false, $framed=false ) {
            global $wgStylePath, $wgContLang;

			$pathway->updateCache(FILETYPE_IMG);
            $img = new Image($pathway->getFileTitle(FILETYPE_IMG));

            $img->loadFromFile();

            $imgURL = $img->getURL();

            $thumbUrl = '';
            $error = '';

            $width = $height = 0;
            if ( $img->exists() ) {
                    $width  = $img->getWidth();
                    $height = $img->getHeight();
            }
            if ( 0 == $width || 0 == $height ) {
                    $width = $height = 180;
            }
            if ( $boxwidth == 0 ) {
                    $boxwidth = 180;
            }
            if ( $framed ) {
                    // Use image dimensions, don't scale
                    $boxwidth  = $width;
                    $boxheight = $height;
                    $thumbUrl  = $img->getViewURL();
            } else {
                    if ( $boxheight === false ) $boxheight = -1;
                    $thumb = $img->getThumbnail( $boxwidth, $boxheight );
                    if ( $thumb ) {
                            $thumbUrl = $thumb->getUrl();
                            $boxwidth = $thumb->width;
                            $boxheight = $thumb->height;
                    } else {
                            $error = $img->getLastError();
                    }
            }
            $oboxwidth = $boxwidth + 2;

            $more = htmlspecialchars( wfMsg( 'thumbnail-more' ) );
            $magnifyalign = $wgContLang->isRTL() ? 'left' : 'right';
            $textalign = $wgContLang->isRTL() ? ' style="text-align:right"' : '';

            $s = "<div id=\"{$id}\" class=\"thumb t{$align}\"><div class=\"thumbinner\" style=\"width:{$oboxwidth}px;\">";
            if( $thumbUrl == '' ) {
                    // Couldn't generate thumbnail? Scale the image client-side.
                    $thumbUrl = $img->getViewURL();
                    if( $boxheight == -1 ) {
                            // Approximate...
                            $boxheight = intval( $height * $boxwidth / $width );
                    }
            }
            if ( $error ) {
                    $s .= htmlspecialchars( $error );
            } elseif( !$img->exists() ) {
                    $s .= "Image does not exist";
            } else {
                    $s .= '<a href="'.$href.'" class="internal" title="'.$alt.'">'.
                            '<img src="'.$thumbUrl.'" alt="'.$alt.'" ' .
                            'width="'.$boxwidth.'" height="'.$boxheight.'" ' .
                            'longdesc="'.$href.'" class="thumbimage" /></a>';
            }
            $s .= '  <div class="thumbcaption"'.$textalign.'>'.$label."</div></div></div>";
            return str_replace("\n", ' ', $s);
            //return $s;
    }
function process($title,$caption)
    {
    $pathway = Pathway::newFromTitle($title);
    $img = new Image($pathway->getFileTitle(FILETYPE_IMG));
    $href = $pathway->getFullUrl();
    if($caption == "")
    {
        $caption = "<a href=\"$href\">" . $pathway->name() . "</a>";
        $caption = html_entity_decode($caption);         //This can be quite dangerous (injection),
                                                            //we would rather parse wikitext, let me know if
                                                            //you know a way to do that (TK)
    }
    $output = makeThumbLinkObj1($pathway, $caption, $href, $tooltip, $align, $id, 100);
    return $output;
    }
?> 