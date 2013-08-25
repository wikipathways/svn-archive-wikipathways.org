<?php
/**
Entry point for a pathway viewer widget that can be included in other pages.

This page will display the interactive pathway viewer for a given pathway. It takes the following parameters:
- id: the pathway id (e.g. WP4)
- rev: the revision number of a specific version of the pathway (optional, leave out to display the newest version)

You can include a pathway viewer in another website using an iframe:

<iframe src ="http://www.wikipathways.org/wpi/PathwayWidget.php?id=WP4" width="500" height="500" style="overflow:hidden;"></iframe>

 */
	require_once('wpi.php');
	require_once('extensions/PathwayViewer/PathwayViewer.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<style  type="text/css">
a#wplink {
text-decoration:none;
font-family:serif;
color:black;
font-size:12px;
}
#logolink {
	float:right;
	top:-20px;
	left: -10px;
	position:relative;
	z-index:2;
	opacity: 0.8;
}
html, body {
	width:100%;
	height:100%;
}
#pathwayImage {
	position:fixed;
	top:0;
	left:0;
	font-size:12px;
	width:100%;
	height:100%;
}
</style>
<!--
<meta name="svg.render.forceflash" content="true">
-->
<?php
	  echo '<link rel="stylesheet" href="' . $cssJQueryUI . '" type="text/css" />' . "\n";

//Initialize javascript
echo '<script type="text/javascript" src="' . $jsJQuery . '"></script>' . "\n";

$jsSnippets = XrefPanel::getJsSnippets();
foreach($jsSnippets as $js) {
	echo "<script type=\"text/javascript\">$js</script>\n";
}

$imgPath = "$wgServer/$wgScriptPath/skins/common/images/";
echo "<script type=\"text/javascript\">XrefPanel_imgPath = '$imgPath';</script>";

$jsSrc = PathwayViewer::getJsDependencies();
$jsSrc = array_merge($jsSrc, XrefPanel::getJsDependencies());
foreach($jsSrc as $js) {
	echo '<script type="text/javascript" src="' . $js . '"></script>' . "\n";
}

$id = $_REQUEST['id'];
$rev = $_REQUEST['rev'];

$pathway = Pathway::newFromTitle($id);
if($rev) {
	$pathway->setActiveRevision($rev);
}

$svg = $pathway->getFileURL(FILETYPE_IMG);
$gpml = $pathway->getFileURL(FILETYPE_GPML);

echo <<<SCRIPT
<script type="text/javascript">
	PathwayViewer_basePath = '$wfPathwayViewerPath/';
	$search
	$bridge
</script>
SCRIPT;

/*
echo <<<SCRIPT
<script type="text/javascript">
	PathwayViewer_basePath = '$wfPathwayViewerPath/';
	PathwayViewer_viewers.push(new PathwayViewer({
		imageId: "pathwayImage",
		svgUrl: "$svg",
		gpmlUrl: "$gpml",
		start: true,
		width: '100%',
		height: '100%'
	));
	$search
	$bridge
</script>
SCRIPT;
*/
?>
<title>WikiPathways Pathway Viewer</title>
</head>
<body>
<!--
<div id="pathwayImage"><img src="" /></div>
-->
<script>
function getUrlParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
};
var repo = getUrlParameter('repo');
//var url = getUrlParameter('pathwayUrl');
var pwId = getUrlParameter('id');
var revision = 0;
if (!(!getUrlParameter('revision'))) {
	revision = getUrlParameter('revision');
};
var url = 'http://test3.wikipathways.org/wpi/webservice/webservice.php/getPathway?pwId=' + pwId +'&revision=' + revision;
</script>

<?php
  $authorizedRepos = array("wikipathways", "AlexanderPico", "ariutta", "khanspers");
  $repo = "wikipathways";

  if (isset($_GET['repo'])) {
    if (in_array($_GET['repo'], $authorizedRepos)) {
      $repo = htmlspecialchars($_GET['repo']);
    }
  }

  if ($_GET['repo'] == "local") {
    $pathwayTemplateSvgUrl = "pathway-template.svg";
    $pathwayTemplateSvgUrlEditable = "pathway-template.svg";
  }
  else {
    $pathwayTemplateSvgUrl = "https://raw.github.com/" . $repo . "/pathvisio.js/dev/src/views/pathway-template.svg";
    $pathwayTemplateSvgUrlEditable = "https://github.com/" . $repo . "/pathvisio.js/blob/dev/src/views/pathway-template.svg";
  }

  echo "<div id='javascript-svg-pathway-container' class='pathway'>";
    $pathwayTemplateSvg = simplexml_load_file($pathwayTemplateSvgUrl);
    echo $pathwayTemplateSvg->saveXML();
  echo "</div>";

?>

<div class="ui-layout-east ui-layout-pane ui-layout-pane-east" style="position: absolute; margin: 0px; left: auto; right: 0px; top: 0px; bottom: 0px; height: 346px; z-index: 1; padding: 10px; background-color: rgb(255, 255, 255); border: 1px solid rgb(187, 187, 187); overflow: auto; width: 280px; visibility: visible; display: block; background-position: initial initial; background-repeat: initial initial;">
   <div style="text-align: left; font-size: 90%; display: block;">
      <div class="xrefinfo">
<!--
         <h3>Uric acid</h3>
         <div><b>Annotated with: </b><span style="font-size:12px;"><a target="_blank" href="http://www.hmdb.ca/metabolites/HMDB00289">HMDB00289 (HMDB)</a><br></span></div>
         <div>
            <p><a target="_blank" href="http://www.wikipathways.org//index.php?title=Special:SearchPathways&amp;doSearch=1&amp;ids=HMDB00289&amp;codes=Ch&amp;type=xref" title="Find other pathways with Uric acid..."><span style="float:left" class="ui-icon ui-icon-search"></span>Find pathways with Uric acid...</a></p>
         </div>
      </div>
      <div class="xreflinks">
         <div><b>External references:</b></div>
         <div class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" role="tablist">
            <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-state-active ui-corner-top" role="tab" aria-expanded="true" tabindex="0"><span class="ui-icon ui-icon-triangle-1-s"></span><a href="#">CAS</a></h3>
            <div class="ui-helper-clearfix ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active" role="tabpanel" style="overflow: auto;">
               <div>
                  <span style="font-size:12px;"><a target="_blank" href="http://commonchemistry.org/ChemicalDetail.aspx?ref=69-93-2">69-93-2</a><br></span>
                  <table>
                     <tbody>
                        <tr></tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all" role="tab" aria-expanded="false" tabindex="-1"><span class="ui-icon ui-icon-triangle-1-e"></span><a href="#">ChEBI</a></h3>
            <div class="ui-helper-clearfix ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" role="tabpanel" style="overflow: auto; display: none;">
               <div>
                  <span style="font-size:12px;"><a target="_blank" href="http://www.ebi.ac.uk/chebi/searchId.do?chebiId=17775">17775</a><br></span>
                  <table>
                     <tbody>
                        <tr></tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all" role="tab" aria-expanded="false" tabindex="-1"><span class="ui-icon ui-icon-triangle-1-e"></span><a href="#">HMDB</a></h3>
            <div class="ui-helper-clearfix ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" role="tabpanel" style="overflow: auto; display: none;">
               <div>
                  <span style="font-size:12px;"><a target="_blank" href="http://www.hmdb.ca/metabolites/HMDB00289">HMDB00289</a><br></span>
                  <table>
                     <tbody>
                        <tr></tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all" role="tab" aria-expanded="false" tabindex="-1"><span class="ui-icon ui-icon-triangle-1-e"></span><a href="#">Kegg Compound</a></h3>
            <div class="ui-helper-clearfix ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" role="tabpanel" style="overflow: auto; display: none;">
               <div>
                  <span style="font-size:12px;"><a target="_blank" href="http://www.genome.jp/dbget-bin/www_bget?cpd:C00366">C00366</a><br></span>
                  <table>
                     <tbody>
                        <tr></tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all" role="tab" aria-expanded="false" tabindex="-1"><span class="ui-icon ui-icon-triangle-1-e"></span><a href="#">NuGO wiki</a></h3>
            <div class="ui-helper-clearfix ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" role="tabpanel" style="overflow: auto; display: none;">
               <div>
                  <span style="font-size:12px;"><a target="_blank" href="http://wiki.nugo.org/index.php/HMDB00289">HMDB00289</a><br></span>
                  <table>
                     <tbody>
                        <tr></tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all" role="tab" aria-expanded="false" tabindex="-1"><span class="ui-icon ui-icon-triangle-1-e"></span><a href="#">PubChem</a></h3>
            <div class="ui-helper-clearfix ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" role="tabpanel" style="overflow: auto; display: none;">
               <div>
                  <span style="font-size:12px;">1175<br></span>
                  <table>
                     <tbody>
                        <tr></tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-corner-all" role="tab" aria-expanded="false" tabindex="-1"><span class="ui-icon ui-icon-triangle-1-e"></span><a href="#">Wikipedia</a></h3>
            <div class="ui-helper-clearfix ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" role="tabpanel" style="overflow: auto; display: none;">
               <div>
                  <span style="font-size:12px;"><a target="_blank" href="http://en.wikipedia.org/wiki/Uric acid">Uric acid</a><br></span>
                  <table>
                     <tbody>
                        <tr></tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
-->
      </div>
   </div>
</div>


<script src="/wpi/pvjs/src/js/pathvisio/pathvisio.js"></script>
<script src="/wpi/pvjs/src/js/pathvisio/pathway/pathway.js"></script>
<script src="/wpi/pvjs/src/js/pathvisio/pathway/edge/edge.js"></script>
<script src="/wpi/pvjs/src/js/pathvisio/pathway/edge/path-data.js"></script>
<script src="/wpi/pvjs/src/js/pathvisio/pathway/edge/marker.js"></script>
<script src="/wpi/pvjs/src/js/pathvisio/pathway/edge/point.js"></script>

<script src="/wpi/pvjs/src/js/pathvisio/pathway/info-box.js"></script>
<script src="/wpi/pvjs/src/js/pathvisio/pathway/group.js"></script>
<script src="/wpi/pvjs/src/js/pathvisio/pathway/labelable-element.js"></script>

<script src="/wpi/pvjs/src/js/pathvisio/helpers.js"></script>
<script src="/wpi/pvjs/src/js/rgbcolor.js"></script>

<script src="/wpi/pvjs/src/js/jxon.js"></script>
<script src="/wpi/pvjs/src/lib/jquery/jquery.js"></script>
<script src="/wpi/pvjs/src/lib/d3/d3.js" charset="utf-8"></script>

<script>
  window.onload = function() {
    pathvisio.pathway.load('#pathway-image', url);
//	var xrefHtml = XrefPanel.create('HMDB01397', 'HMDB', 'Mus musculus', 'mouse thing');
//	$('.xrefinfo').append(xrefHtml);
  };
</script>
<div style="position:absolute;height:0px;overflow:visible;bottom:0;right:0;">
	<div id="logolink">
		<?php
			echo "<a id='wplink' target='top' href='{$pathway->getFullUrl()}'>View at ";
			echo "<img style='border:none' src='$wgScriptPath/skins/common/images/wikipathways_name.png' /></a>";
		?>
	</div>
</div>
</body>
</html>
