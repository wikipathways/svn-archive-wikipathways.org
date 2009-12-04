<?php

if ( !defined( 'MEDIAWIKI' ) ) {
    echo "This file is part of MediaWiki, it is not a valid entry point.\n";
    exit( 1 );
}
$opath = WPI_URL . "/extensions/otag" ;
$wgExtensionFunctions[] = "wfotag";

function wfotag() {
    global $wgHooks;
	global $wgParser;
    $wgHooks['ParserAfterTidy'][]='oheader';
	$wgParser->setHook( "OntologyTags", "ofunction" );
}

function oheader(&$parser, &$text)
{
$text = preg_replace(
            '/<!-- ENCODED_CONTENT ([0-9a-zA-Z\\+]+=*) -->/e',
            'base64_decode("$1")',
            $text

        );
        return true;
}

function ofunction( $input, $argv, &$parser ) {
     global $wgTitle , $wgOut, $opath, $wgOntologiesJSON;

     $title = $parser->getTitle();
     $loggedIn = $title->userCan('edit') ? "true" : "false";
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/connection/connection-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/animation/animation-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/yahoo/yahoo-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/event/event-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/json/json-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/treeview/treeview-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/datasource/datasource-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/autocomplete/autocomplete-min.js"></script>');
     $wgOut->addScript(
		"<script type=\"{$wgJsMimeType}\">" .
		"var opath=\"$opath\";" .
        "var otagloggedIn = \"$loggedIn\";" .
        "var ontologiesJSON = '$wgOntologiesJSON';" .
		"</script>\n"
	);
    

if($loggedIn == "true")
$output = <<<HTML
<div id="otagprogress" style="display:none" align='center'><span><img src='$opath/progress.gif'> Saving...</span></div>
<div id="ontologyContainer" class="yui-skin-sam">
<div id="ontologyTags"></div>
<div id="ontologyTagDisplay">&nbsp;</div>
<div id="myAutoComplete">
<input id="myInput" type="text" onfocus="clear_box();" >
<div id="myContainer"></div>
</div>
<div id="otaghelp">To add a tag, either select from the available ontology trees below or type a search term in the search box.</div>
<div style="clear:both;"></div>
<table>
<tr valign="top">
<td>
<div id="ontologyTree1" class="treeDiv"></div>
</td>
<td>
<div id="ontologyTree2" class="treeDiv"></div>
</td>
<td>
<div id="ontologyTree3" class="treeDiv"></div>
</td></tr></table>
</div>
<link rel="stylesheet" type="text/css" href="$opath/otag.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/autocomplete/assets/skins/sam/autocomplete.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/treeview/assets/skins/sam/treeview.css" />
<script type="text/javascript" src="$opath/js/script.js"></script>
<script type="text/javascript">
YAHOO.util.Event.onDOMReady(ontologytree.init, ontologytree,true);
</script>
HTML;

else

$output = <<<HTML
<div id="otagprogress" style="display:none" align='center'><span><img src='$opath/progress.gif'> Saving...</span></div>
<div id="ontologyContainer" class="yui-skin-sam">
<div id="ontologyTags"> </div>
<div id="ontologyTagDisplay">&nbsp;</div>
</div>
<link rel="stylesheet" type="text/css" href="$opath/otag.css" />
<script type="text/javascript" src="$opath/js/script.js"></script>
HTML;

return   '<!-- ENCODED_CONTENT '.base64_encode($output).' -->' ; //. $check ;

}

?>