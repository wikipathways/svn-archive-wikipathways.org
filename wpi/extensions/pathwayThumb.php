<?php
require_once('extensions/PathwayViewer/PathwayViewer.php');
$wgExtensionFunctions[] = 'wfPathwayThumb';
$wgHooks['LanguageGetMagic'][]  = 'wfPathwayThumb_Magic';

function wfPathwayThumb() {
	global $wgParser;
	$wgParser->setFunctionHook( "pwImage", "renderPathwayImage" );
}

function wfPathwayThumb_Magic( &$magicWords, $langCode ) {
		$magicWords['pwImage'] = array( 0, 'pwImage' );
		return true;
}

function renderPathwayImage( &$parser, $pwTitleEncoded, $width = 0, $align = '', $caption = '', $href = '', $tooltip = '', $id='pwthumb') {
	global $wgUser, $wgRequest;
	$pwTitle = urldecode ($pwTitleEncoded);
	$parser->disableCache();
	$latestRevision = 0;
	try {
		$pathway = Pathway::newFromTitle($pwTitle);
		$revision = $wgRequest->getVal('oldid');
		if($revision) {
			$pathway->setActiveRevision($revision);
		}
		$img = new LocalFile($pathway->getFileTitle(FILETYPE_IMG), RepoGroup::singleton()->getLocalRepo());
		switch($href) {
			case 'svg':
				$href = wfLocalFile($pathway->getFileTitle(FILETYPE_IMG)->getPartialURL())->getURL();
				break;
			case 'pathway':
				$href = $pathway->getFullURL();
				break;
			default:
				if(!$href) $href = $pathway->getFullURL();
		}

		switch($caption) {
			case 'edit':
				$caption = createEditCaption($pathway);
				break;
			case 'view':
				$caption = $pathway->name() . " (" . $pathway->species() . ")";
				break;
			default:
				$caption = html_entity_decode($caption);        //This can be quite dangerous (injection),
																//we would rather parse wikitext, let me know if
																//you know a way to do that (TK)
		}
		
		if (preg_match("/Pathway\:WP\d+/", $href)){
			$output = makeThumbLinkObj($pathway, $caption, $href, $tooltip, $align, $id, $width);
		} else {
			$output = makePvjsObj($pathway, '0', $caption, $href, $tooltip, $align, $id, $width);
		}

	} catch(Exception $e) {
		return "invalid pathway title: $e";
	}
	return array($output, 'isHTML'=>1, 'noparse'=>1);
}

function createEditCaption($pathway) {
	global $wgUser;

	//Create edit button
	$pathwayURL = $pathway->getTitleObject()->getPrefixedURL();
	//AP20070918
	$editButton = '';
	if ($wgUser->isLoggedIn() && $pathway->getTitleObject()->userCan('edit')) {
		$identifier = $pathway->getIdentifier();
		$version = $pathway->getLatestRevision(); 
		$editButton = '<div style="float:left;">' . 
			  // see http://www.ericmmartin.com/projects/simplemodal/
			  '<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/simplemodal/1.4.4/jquery.simplemodal.min.js"></script>' .
			  // this should just be a button, but the button class only works for "a" elements with text inside.
			  '<a id="download-from-page" href="#" onclick="return false;" class="button"><span>Launch Editor</span></a>' .
			  '<script type="text/javascript">' .
				" $('#download-from-page').click(function() { " .
					" $.modal('<div id=\"jnlp-instructions\" style=\"width: 610px; height:616px; cursor:pointer;\" onClick=\"$.modal.close()\"><img id=\"jnlp-instructions-diagram\" src=\"/skins/wikipathways/jnlp-instructions.png\" alt=\"The JNLP will download to your default folder. Right-click the JNLP file and select Open.\"> </div>', {overlayClose:true, overlayCss: {backgroundColor: \"gray\"}, opacity: 50}); " .
					// We need the kludge below, because the image doesn't display in FF otherwise.
					" window.setTimeout(function() { " .
						" $('#jnlp-instructions-diagram').attr('src', '/skins/wikipathways/jnlp-instructions.png'); " .
					"}, 10);" .
					// server must set Content-Disposition: attachment
					// TODO why do the ampersand symbols below get parsed as HTML entities? Disabling this line and using the minimal line below for now, but we shouldn't have to do this..
					//" window.location = '" . SITE_URL . "/wpi/extensions/PathwayViewer/pathway-jnlp.php?identifier=" . $identifier . "&version=" . $version . "&filename=WikiPathwaysEditor'; " .
					" window.location = '" . SITE_URL . "/wpi/extensions/PathwayViewer/pathway-jnlp.php?identifier=" . $identifier . "'; " .
				" }); " .
			  '</script>' .
		 '</div>';
	} else {
		if(!$wgUser->isLoggedIn()) {
			$hrefbtn = SITE_URL . "/index.php?title=Special:Userlogin&returnto=$pathwayURL";
			$label = "Log in to edit pathway";
		} else if(wfReadOnly()) {
			$hrefbtn = "";
			$label = "Database locked";
		} else if(!$pathway->getTitleObject()->userCan('edit')) {
			$hrefbtn = "";
			$label = "Editing is disabled";
		}

		$editButton = "<a href='$hrefbtn' title='$label' id='edit' " .
			"class='button'><span>$label</span></a>";
	}

	$helpUrl = Title::newFromText("Help:Known_problems")->getFullUrl();
	$helpLink = "<div style='float:left;'><a href='$helpUrl'> not working?</a></div>";

	//Create dropdown action menu
	$pwTitle = $pathway->getTitleObject()->getFullText();
	//disable dropdown for now
	$drop = PathwayPage::editDropDown($pathway);
	$drop = '<div style="float:right;">' . $drop . '</div>';

	return $editButton . $helpLink . $drop;
}


/** MODIFIED FROM Linker.php
 * Make HTML for a thumbnail including image, border and caption
 * $img is an Image object
 */
function makeThumbLinkObj( $pathway, $label = '', $href = '', $alt, $align = 'right', $id = 'thumb', $boxwidth = 180, $boxheight=false, $framed=false ) {
        global $wgStylePath, $wgContLang;

        $img = $pathway->getImage();
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


/* Modified from makeThumbLinkObj() above to handle pathway rendering on Pathway Pages */
function makePvjsObj( $pathway, $latestRevision=0, $label = '', $href = '', $alt, $align = 'right', $id = 'thumb', $boxwidth = 180, $boxheight=false, $framed=false ) {
	global $wgStylePath, $wgContLang, $wgUser;

	$editorState = 'disabled';
	if ($wgUser->isLoggedIn() && $wgUser->isEmailConfirmed()){
		$editorState = 'closed';
	}

	$gpml = $pathway->getFileURL(FILETYPE_GPML); 
	$img = $pathway->getImage();
	$imgURL = $img->getURL();

	$identifier = $pathway->getIdentifier();
	$version = $pathway->getLatestRevision(); 
	$resource = 'http://identifiers.org/wikipathways/WP4';

	$textalign = $wgContLang->isRTL() ? ' style="text-align:right"' : '';

	$s = '<script type="text/javascript">';
	$s .= 'window.wikipathwaysUsername = "' . $wgUser->mName . '";';
	$s .= '</script>';
	
	$s .= "<div id=\"{$id}\" class=\"thumb t{$align}\"><div class=\"thumbinner\" style=\"width: 900px; padding: 3px 6px 30px 3px; height: 635px; min-width: 700px; max-width: 100%;\">";
	$thumbUrl = $img->getViewURL();
//style="min-width:'.$boxwidth.'px; min-height:'.$boxheight.'px; height:'.$boxheight.'px; ">
	$s .= '<div class="internal" style="width: 900px; min-width: 700px; max-width: 100%; height: 600px; margin: auto; align: center;">
				<wikipathways-pvjs id="pvjs-container"
				    class="wikipathways-pvjs"
				    resource="http://identifiers.org/wikipathways/'.$identifier.'"
				    version='.$version.'"
				    src="'.$gpml.'"                                                                                                                                               
				    resource="'.$resource.'"                                                                                                                                               
				    version="'.$latestRevision.'"                                                                                                                                               
				    display-errors="true"
				    display-warnings="true"
				    manual-render="true"
				    editor="'.$editorState.'"
				    fit-to-container="true">
					  <img style="height:600px; max-width:100%"
						alt="'.$alt.'"
					    	src="'.$imgUrl.'">
				</wikipathways-pvjs>
			</div>';
	$s .= '  <div class="thumbcaption"'.$textalign.'>'.$label."</div></div></div>";
	return str_replace("\n", ' ', $s);
}
