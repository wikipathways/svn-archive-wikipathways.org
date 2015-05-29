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

		// TODO there must be a better way to get the most recent revision number.
		// FIX: replaced $latestRevision with '0' in (or nearL line 61, $output..). I think this should be sufficient.
		//$history = getHistory($pathway);
		//$doc = new DOMDocument();
		//$doc->loadHTML($history);
		//$targetElement = $doc->getElementsByTagName('form')->item(0)->getElementsByTagName('td')->item(1);
		//$latestRevision = $targetElement->nodeValue;

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

		$output = makeThumbLinkObj($pathway, '0', $caption, $href, $tooltip, $align, $id, $width);

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
	if (!$wgUser->isLoggedIn()){
		$hrefbtn = SITE_URL . "/index.php?title=Special:Userlogin&returnto=$pathwayURL";
		$label = "Log in to edit pathway";
	} else {
		if(wfReadOnly()) {
			$hrefbtn = "";
			$label = "Database locked";
		} else if(!$pathway->getTitleObject()->userCan('edit')) {
			$hrefbtn = "";
			$label = "Editing is disabled";
		} else {
			$hrefbtn = "javascript:;";
			$label = "Edit pathway";
		}
	}
	$helpUrl = Title::newFromText("Help:Known_problems")->getFullUrl();
	$caption = "<a href='$hrefbtn' title='$label' id='edit' ".
		"class='button'><span>$label</span></a>" .
		"<div style='float:left;'><a href='$helpUrl'> not working?</a></div>";

	//Create dropdown action menu
	$pwTitle = $pathway->getTitleObject()->getFullText();
	//disable dropdown for now
	$drop = PathwayPage::editDropDown($pathway);
	$drop = '<div style="float:right;">' . $drop . '</div>';
	return $caption . $drop;
}


/** MODIFIED FROM Linker.php
 * Make HTML for a thumbnail including image, border and caption
 * $img is an Image object
 */
function makeThumbLinkObj( $pathway, $latestRevision=0, $label = '', $href = '', $alt, $align = 'right', $id = 'thumb', $boxwidth = 180, $boxheight=false, $framed=false ) {
	global $wgStylePath, $wgContLang;

	// TODO this is a brittle kludge. How should we get the user's logged in status
	// so we can set the editor state?
	$editorState = 'disabled';
	if (preg_match("/Edit\ pathway/", $label, $output_array)) {
		$editorState = 'closed';
	}

	$gpml = $pathway->getFileURL(FILETYPE_GPML); 
	$img = $pathway->getImage();
	$imgURL = $img->getURL();

	$identifier = $pathway->getIdentifier(); 
	$resource = 'http://identifiers.org/wikipathways/WP4';

	$textalign = $wgContLang->isRTL() ? ' style="text-align:right"' : '';

	$s = "<div id=\"{$id}\" class=\"thumb t{$align}\"><div class=\"thumbinner\" style=\"width: 900px; padding: 3px 6px 30px 3px; height: 635px; min-width: 700px; max-width: 100%;\">";
	$thumbUrl = $img->getViewURL();
//style="min-width:'.$boxwidth.'px; min-height:'.$boxheight.'px; height:'.$boxheight.'px; ">
	$s .= '<div class="internal" style="width: 900px; min-width: 700px; max-width: 100%; height: 600px; margin: auto; align: center;">
				<wikipathways-pvjs id="pvjs-container"
				    class="wikipathways-pvjs"
				    alt="'.$alt.'"
				    src="'.$gpml.'"                                                                                                                                               
				    resource="'.$resource.'"                                                                                                                                               
				    version="'.$latestRevision.'"                                                                                                                                               
				    display-errors="true"
				    display-warnings="true"
				    manual-render="true"
				    editor="'.$editorState.'"
				    fit-to-container="true">
					  <img alt="'.$alt.'"
					    src="'.$thumbUrl.'">
				</wikipathways-pvjs>
			</div>';
	$s .= '  <div class="thumbcaption"'.$textalign.'>'.$label."</div></div></div>";
	return str_replace("\n", ' ', $s);
}
