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
     global $wgTitle , $wgOut, $opath;

     $title = $parser->getTitle();
     $loggedIn = $title->userCan('edit') ? "true" : "false";

     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/connection/connection-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/animation/animation-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/datasource/datasource-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/autocomplete/autocomplete-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/yahoo/yahoo-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/event/event-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/json/json-min.js"></script>');
     $wgOut->addScript('<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/treeview/treeview-min.js"></script>');
     $wgOut->addScript(
		"<script type=\"{$wgJsMimeType}\">" .
		"var opath=\"$opath\";" .
        "var otagloggedIn = \"$loggedIn\";" .
		"</script>\n"
	);
    

if($loggedIn == "true")
$output = <<<HTML
<div id="otagprogress" style="display:none" align='center'><span><img src='$opath/progress.gif'> Saving...</span></div>
<div id="ontology_container" class="yui-skin-sam">
<div id="otags">Loading ... </div>
<div id="test1">&nbsp;</div>
<div id="myAutoComplete">
<input id="myInput" type="text" value="..." onfocus="clear_box(this.id);" >
<div id="myContainer"></div>
</div>
<table>
<tr valign="top">
<td>
<div id="treeDiv1" class="treeDiv"></div>
</td>
<td>
<div id="treeDiv2" class="treeDiv"></div>
</td>
<td>
<div id="treeDiv3" class="treeDiv"></div>
</td></tr></table>
</div>
<link rel="stylesheet" type="text/css" href="$opath/otag.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/autocomplete/assets/skins/sam/autocomplete.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/treeview/assets/skins/sam/treeview.css" />
<script type="text/javascript" src="$opath/js/script.js"></script>
<script type="text/javascript">
YAHOO.util.Event.onDOMReady(ontologytree.init, ontologytree,true);
</script>
HTML;
else
$output = <<<HTML
<div id="otagprogress" style="display:none" align='center'><span><img src='$opath/progress.gif'> Saving...</span></div>
<div id="ontology_container" class="yui-skin-sam">
<div id="otags">Loading ... </div>
<div id="test1">&nbsp;</div>
</div>
<link rel="stylesheet" type="text/css" href="$opath/otag.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/autocomplete/assets/skins/sam/autocomplete.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/treeview/assets/skins/sam/treeview.css" />
<script type="text/javascript" src="$opath/js/script.js"></script>
HTML;
return   '<!-- ENCODED_CONTENT '.base64_encode($output).' -->' ; //. $check ;

}

?>