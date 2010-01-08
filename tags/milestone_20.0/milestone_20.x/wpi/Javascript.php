<?php
/**
 * Handles javascript dependencies for WikiPathways extensions
 */
$wgHooks['OutputPageParserOutput'][] = 'wpiAddJavascript';

function wpiAddJavascript(&$out, $parseroutput) {
	global $wgJsMimeType, $wpiJavascriptSnippets, $wpiJavascriptSources;
	
	//Array containing javascript source files to add
	if(!isset($wpiJavascriptSources)) $wpiJavascriptSources = array();
	$wpiJavascriptSources = array_unique($wpiJavascriptSources);
	
	//Array containing javascript snippets to add
	if(!isset($wpiJavascriptSnippets)) $wpiJavascriptSnippets = array();
	$wpiJavascriptSnippets = array_unique($wpiJavascriptSnippets);

	foreach($wpiJavascriptSnippets as $snippet) {
		$out->addScript("<script type=\"{$wgJsMimeType}\">$snippet</script>\n");
	}
	
	foreach($wpiJavascriptSources as $src) {
		$out->addScript("<script src=\"{$src}\" type=\"{$wgJsMimeType}\"></script>\n");
	}
	return true;
}
?>
