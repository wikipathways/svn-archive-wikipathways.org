<?php
require_once('DetectBrowserOS.php');

/*
 * Loads an interactive pathway viewer using svgweb.
 */
$wfPathwayViewerPath = WPI_URL . "/extensions/PathwayViewer";

$wgExtensionFunctions[] = 'wfPathwayViewer';
$wgHooks['LanguageGetMagic'][]  = 'wfPathwayViewer_Magic';

function wfPathwayViewer() {
	global $wgParser;
	$wgParser->setFunctionHook( "PathwayViewer", "displayPathwayViewer" );
}

function wfPathwayViewer_Magic( &$magicWords, $langCode ) {
	$magicWords['PathwayViewer'] = array( 0, 'PathwayViewer' );
	return true;
}

function displayPathwayViewer(&$parser, $pwId, $imgId) {
	global $wgOut, $wgStylePath, $wfPathwayViewerPath, $wpiJavascriptSources, $wgScriptPath,
		$wpiJavascriptSnippets, $jsRequireJQuery, $wpiAutoStartViewer, $wgRequest, $wgJsMimeType;

	$jsRequireJQuery = true;

	try {
		$parser->disableCache();

		//Force flash renderer
		//<meta name="svg.render.forceflash" content="true">
		$wgOut->addMeta('svg.render.forceflash', 'true');

		//Add javascript dependencies
		XrefPanel::addXrefPanelScripts();
		$wpiJavascriptSources = array_merge($wpiJavascriptSources, PathwayViewer::getJsDependencies());

		$script = "PathwayViewer_basePath = '" . $wfPathwayViewerPath . "/';";
		$wpiJavascriptSnippets[] = $script;

		$revision = $wgRequest->getval('oldid');
		$pvPwAdded[] = $pwId . '@' . $revision;

		$pathway = Pathway::newFromTitle($pwId);
		if($revision) {
			$pathway->setActiveRevision($revision);
		}
		$svg = $pathway->getFileURL(FILETYPE_IMG);
		$gpml = $pathway->getFileURL(FILETYPE_GPML);

		$dostart = ',start: true';
		$start = $dostart; //Autostart by default

		//First switch by variable in pass.php
		if(!$wpiAutoStartViewer) $start = $dostart;

		//Allow override via get parameter
		$getStart = $wgRequest->getval('startViewer');
		if($getStart == 'false' || $getStart == '0') $start = '';
		if($getStart == 'true' || $getStart == '1') $start = $dostart;

//		$script = <<<SCRIPT
//			var viewer = new PathwayViewer({
//                                  imageId: "$imgId",
//                                                svgUrl: "$svg",
//                                                gpmlUrl: "$gpml"$start
//                                               });
//		PathwayViewer_viewers.push(viewer);
//SCRIPT;

		$script = "<script type=\"{$wgJsMimeType}\">window.onload = function() {pathvisiojs.load({target: '#pwImage', data: \"$gpml\", hiddenElements: ['find','wikipathways-link']});} </script>
			<link rel=\"stylesheet\" href=\"http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css\" media=\"screen\" type=\"text/css\" />
			<link rel=\"stylesheet\" href=\"http://wikipathways.github.io/pathvisiojs/src/css/pathvisio-js.css\" media=\"screen\" type=\"text/css\" />
  			<link rel=\"stylesheet\" href=\"http://wikipathways.github.io/pathvisiojs/src/css/annotation.css\" media=\"screen\" type=\"text/css\" />
  			<link rel=\"stylesheet\" href=\"http://wikipathways.github.io/pathvisiojs/src/css/pan-zoom.css\" media=\"screen\" type=\"text/css\" />
  			<link rel=\"stylesheet\" href=\"http://wikipathways.github.io/pathvisiojs/src/css/pathway-template.css\" media=\"screen\" type=\"text/css\" />\n";
		return array($script, 'isHTML'=>1, 'noparse'=>1);
	} catch(Exception $e) {
		return "invalid pathway title: $e";
	}
	return true;
}

class PathwayViewer {
	static function getJsDependencies() {
		global $wgScriptPath, $wfPathwayViewerPath; //$jsSvgWeb

//		$scripts = array(
//			"$wgScriptPath/wpi/js/jquery/plugins/jquery.mousewheel.js",
//			"$wgScriptPath/wpi/js/jquery/plugins/jquery.layout.min-1.3.0.js",
//			"$wfPathwayViewerPath/pathwayviewer.js",
//			"$wfPathwayViewerPath/highlightByElement.js"
//		);

                $scripts = array(   
                        "$wfPathwayViewerPath/pathwayviewer.js",
                        "$wgScriptPath/wpi/lib/js/rgb-color.min.js",    
                        "$wgScriptPath/wpi/lib/js/case-converter.min.js", 
                        "$wgScriptPath/wpi/lib/js/async.js",
                        "$wgScriptPath/wpi/lib/js/d3.min.js", 
                        "$wgScriptPath/wpi/lib/js/jquery.min.js", 
                        "$wgScriptPath/wpi/lib/js/typeahead.min.js", 
                        "$wgScriptPath/wpi/lib/js/openseadragon.min.js", 
                        "$wgScriptPath/wpi/lib/js/modernizr.js",   
                        "$wgScriptPath/wpi/lib/js/screenfull.min.js", 
                        "$wgScriptPath/wpi/lib/js/svg-pan.js",  
                        "$wgScriptPath/wpi/lib/js/pathfinding-browser.min.js",  
                        "$wgScriptPath/wpi/lib/js/pathvisio.min.js"            
                );  

		//Do not load svgweb when using HTML5 version of svg viewer (IE9)
//		if(browser_detection('ie_version') != 'ie9x') {
//			array_unshift($scripts, $jsSvgWeb);
//		}

		return $scripts;
	}
}
