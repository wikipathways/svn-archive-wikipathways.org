<?php

require_once("graphml.php");
require_once("../../../relations.php");


if($_GET['action'] == "")
{
    echo("Please enter the required parameters.");
}
else
{
    switch($_GET['action'])
    {
        case "relations":
            $relations = Relations::fetchRelations($_GET['type'], "", "", $_GET['minscore'], $_GET['species']);

            $graphMLConv = new GraphMLConverter($relations);
            echo $graphMLConv->getGraphML();

            break;

        case "species":
            $species = Pathway::getAvailableSpecies();
            echo json_encode($species);
            break;

        case "info":
            $pw = new Pathway($_GET['pwId']);
            echo getPathwayImageUrl($pw);
            break;
    }
}

function getPathwayImageUrl($pathway, $type = "png")
{
    echo $pathway->getFileURL($type);
    echo $pathway->getFileTitle($type);
}

function makeThumbNail( $pathway, $id = 'thumb'  ) {

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
                $width = $height = 220;
        }
        if ( $boxwidth == 0 ) {
                $boxwidth = 230;
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
}


?>