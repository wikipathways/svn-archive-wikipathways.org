<?php

class NewTA extends SpecialPage {
	protected $name        = 'NewTA';

	function NewTA() {
		SpecialPage::SpecialPage ( $this->name  );
		self::loadMessages();
	}

	function execute($par) {
		global $wgOut, $wgUser, $wgLang;
		$this->setHeaders ();
		$wgOut->setPagetitle ("NewTA");
		$sex = (isset ( $_GET ["sex"] )) ? $_GET ["sex"] : "male";
		$cutoff = (isset ( $_GET ["cutoff"] )) ? $_GET ["cutoff"] : "5";
		$dataset = (isset ( $_GET ["dataset"] )) ? $_GET ["dataset"] : "E-MTAB-2836";
		$select = $_GET ["select"];

		$datasetSelect = "<form name= action=''><SELECT name='dataset' id='dataSelect' size='1'>";
		$path = "wpi/bin/TissueAnalyzer/datasets.txt";
		$datasetFile = fopen ($path , r );
		$hashArray = array ();
		while ( ! feof ( $datasetFile ) ) {
			$line = fgets ( $datasetFile );
			$pieces = explode ( "\t", $line );
			$id = $pieces [0];
			if ($id === '')
				break;	
			$hashArray[$id]["short"] = $pieces [2];
			$hashArray[$id]["full"] = $pieces [1];
						
			$datasetSelect .= (strcmp ( trim ( $dataset ), trim ( $id ) ) == 0) ? "<option selected=\"selected\">$id</option>" : "<option>$id</option>";
		}
		fclose ( $datasetFile );
		$datasetSelect .="</SELECT>";

		$intro = <<<HTML
								
			<style type='text/css'>
					#bodyContent {
						overflow:visible;
					}
			</style>		  
			<div style="display:inline-block;overflow:visible">
			<div style="display:block;overflow:visible">
			<p>This project was developed during the <b>Google Summer of Code 2014</b> by Jonathan Mélius.
			We integrated tissue baseline expression data (RNAseq) from Expression Atlas with the pathways from WikiPathways.<br/>
			The aim of this project is to provide indications about 'how expressed a pathway is in a specific tissue'.<br/>
			You can find the dataset used on the Expression Atlas website: 
			<a target="_blank" href="http://www.ebi.ac.uk/arrayexpress/experiments/E-MTAB-1733">E-MTAB-1733</a>.
			<br/><i><font color="red">This project is still under development and further improvements will be available in the up-coming releases of WikiPathways.</font></i><br/><br/>
			
			<ul>
				<li>Start by selecting the dataset of interest.</li> 
				<li>Then by selecting your tissue of interest. The pathways in the table are sorted based on the median expression of the genes involved.</li> 
				<li>If you click on the pathway name in the table, the pathway will be shown below the table and the active genes are highlighted in the pathway.</li>
				<li>Generic pathways that are expressed in nearly all of the tissues (e.g >23 out of 27) are hidden by default but can be shown by selecting "Show generic pathways"</li>
			</ul>
			<ul>New, multiple datasets are available:<br>
HTML;
			foreach ($hashArray as $id => $description) {
				foreach ($description as $k => $v) {
					if (strcmp($k,"short" )== 0){
						$intro .= "<li>$v</li> ";
					}
				}
			}
			$intro .= "</ul>
			</p>			
			<hr/><br/>
			</div>";
		
	
		$topTenFile = fopen ( "wpi/bin/TissueAnalyzer/topTen.txt", r );
		$topTen = array ();
		while (!feof($topTenFile)) {
			array_push ( $topTen, trim (fgets($topTenFile)) );
		}
		fclose ( $topTenFile );
		$top = json_encode($topTen);

		
		
		$hash = json_encode($hashArray);
		$wgOut->addHTML ( $intro );
		
		$wgOut->addScriptFile( "/wpi/extensions/TissueAnalyzer/js/jquery-migrate-1.2.0.min.js");
		$wgOut->addScriptFile( "/wpi/extensions/TissueAnalyzer/js/jquery-ui.min.js");
		//$wgOut->addScriptFile( "/wpi/extensions/TissueAnalyzer/js/jquery.svg.js");
		//$wgOut->addScriptFile( "/wpi/extensions/TissueAnalyzer/js/anatomogramModule.js");
		$wgOut->addScript('<script language="JavaScript">
						var hexArr = [];
						var rgbArr = [];
						var namArr = [];
						//var colorhexFlag = "B0B0B0";
						var colorhexFlag = "";
						var colorhexPick1 = "6A03B2";
						var colorhexPick2 = "B0B0B0";
						function HexToR(h) {return parseInt((cutHex(h)).substring(0,2),16)}
						function HexToG(h) {return parseInt((cutHex(h)).substring(2,4),16)}
						function HexToB(h) {return parseInt((cutHex(h)).substring(4,6),16)}
						function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h}

						function ToHex(x) {
							var hex = x.toString(16);
							return hex.length == 1 ? "0" + hex : hex;
						}
						function rgbToHex(rgb) {
							var x = rgb.replace(/ /g, "");
							var a = x.split(",");
							var r = Number(a[0]);
							var g = Number(a[1]);
							var b = Number(a[2]);
							if (isNaN(r) || isNaN(g) || isNaN(b) || r < 0 || r > 255 || g < 0 || g > 255 || b < 0 || b > 255) {return -1;}
							return ToHex(r) + ToHex(g) + ToHex(b);
						}
						function clickColor(id,html5) {
							hh = 1;
							var colorrgb, colornam = "", xhttp, c, r, g, b, i;
							if (html5 && html5 == 5)	{
								c = document.getElementById("html5colorpicker"+id).value;
							}
							if (c.substr(0,1) == "#")	{
								c = c.substr(1);
							}
							c = c.replace(/;/g, "");
							if (c.indexOf(",") > -1 || c.toLowerCase().indexOf("rgb") > -1 || c.indexOf("(") > -1) {
								c = c.replace(/rgb/i, "");
								c = c.replace("(", "");
								c = c.replace(")", "");
								c = rgbToHex(c);
								if (c == -1) {wrongInput(); return;}
							}
							colorhexFlag=c;
							colorhex = c;
							if (colorhex.length == 3) {colorhex = colorhex.substr(0,1) + colorhex.substr(0,1) + colorhex.substr(1,1) + colorhex.substr(1,1) + colorhex.substr(2,1) + colorhex.substr(2,1); }
							colorhex = colorhex.substr(0,6);
						//    if (hexArr.length == 0) {checkColorValue(); }
							for (i = 0; i < hexArr.length; i++) {
								if (c.toLowerCase() == hexArr[i].toLowerCase()) {
									colornam = namArr[i];
									break;
								}
								if (c.toLowerCase() == namArr[i].toLowerCase()) {
									colorhex = hexArr[i];
									colornam = namArr[i];            
									break;
								}
								if (c == rgbArr[i]) {
									colorhex = hexArr[i];
									colornam = namArr[i];            
									break;
								}
							}
							colorhex = colorhex.substr(0,10);
							colorhex = colorhex.toUpperCase();
							r = HexToR(colorhex);
							g = HexToG(colorhex);
							b = HexToB(colorhex);
							if (isNaN(r) || isNaN(g) || isNaN(b)) {wrongInput(); return;}

							if (id==1){

							someString = document.getElementById("path_viewer").src;
							re = new RegExp(colorhexPick1.toUpperCase(),"g");
    						anotherString = someString.replace(re,colorhex);
				
							colorhexPick1=colorhexFlag;
							colorhexFlag=colorhex;
							}
							if (id==2){
							someString = document.getElementById("path_viewer").src;
							re = new RegExp(colorhexPick2.toUpperCase(),"g");
    						anotherString = someString.replace(re,colorhex);
				
							colorhexPick2=colorhexFlag;
							colorhexFlag=colorhex;
							}
							document.getElementById("path_viewer").src = anotherString;
					}
				</script>');
		$wgOut->addScript('
				<script language="JavaScript">
					function check() {
						var js_array = '.$top.';
						if ($("#check").is(":checked")){
							//$("label[for=check]").text("Hide common pathways");
							$("#tissueTable tr").each(function() {
								if (js_array.indexOf(this.id) != -1)  {
								//$(this).attr("class","");
								$(this).show();
								}
							});
						}
						else{
							//$("label[for=check]").text("Show generic pathways");
							$("#tissueTable tr").each(function() {
								if (js_array.indexOf(this.id) != -1)  {
								//$(this).attr("class","toggleMe");
								$(this).hide();
								}
							});
						}
					}
				</script>');
		$wgOut->addScript('<script language="JavaScript">
					function tissue_viewer(id,genes,pathway_name){
						document.getElementById("pwyname").innerHTML="<b>Selected pathway:</b> " + pathway_name;
						$("#my-legend").attr("style","");
						$("#path_viewer").attr("src",
						"http://www.wikipathways.org/wpi/PathwayWidget.php?id="+id+genes);
						$("#path_viewer").attr("style","overflow:hidden;");
					}
				</script>');

 		$wgOut->addScript('<script type="text/javascript">
    			function updateTextInput(val) {
    			  document.getElementById("cutoff_label").innerHTML=val; 
				}				
				$(function() {
					$("#dataSelect").change(function() {
						$("#tissueSelect").load("/wpi/bin/TissueAnalyzer/"+$(this).val()+"_tissues_opt.txt");
						var words = '.$hash.';
						document.getElementById("description").innerHTML= words[$(this).val()]["full"];
					});
				});
				</script>');

		

		$speciesSelect = "<SELECT name='select' id='tissueSelect' size='1'>";
		$path = "wpi/bin/TissueAnalyzer/".$dataset."_tissues_opt.txt";
		$tissuesFile = fopen ($path , r );
		

		while ( ! feof ( $tissuesFile ) ) {
			$line = fgets ( $tissuesFile );
			$tissue = str_replace("</option>",'',$line);
			$tissue = str_replace("<option>",'',$tissue);
            $tissue = trim ( $tissue );
			if ($tissue === '')
				break;
			$speciesSelect .= (strcmp ( trim ( $select ), trim ( $tissue ) ) == 0) ? "<option selected=\"selected\">$tissue</option>" : "<option>$tissue</option>";
		}
		fclose ( $tissuesFile );
		$speciesSelect .= "</SELECT>";

		$button = <<<HTML
			<INPUT type="submit" name="button" value= "submit"></form>
HTML;

		$slide ='			
				<input type="range" name="cutoff" min="4" max="6" value="'.$cutoff.'" step="1" onchange="updateTextInput(this.value);">                                                       
   				<label id="cutoff_label">'.$cutoff.'</label>
';
		$out = <<<HTML
			<div style="display:block;width:100%;overflow:visible">			
			<table id='nsselect' class='allpages'>
				<tr>
					<td align='right'>Select dataset:</td>
					<td align='left'>{$datasetSelect}</td>
					<td align='right'>Select tissue:</td>
					<td align='left'>{$speciesSelect}</td>
					
					<td align='right'>Select active gene cutoff:</td>
					<td align='right'>{$slide}</td>
					<td align='right'>{$button}</td>
				</tr>
			</table>
			<p id="description"></p>
HTML;
		$wgOut->addHTML ( $out );

		$checkbox = '	<input id="check" type="checkbox" onchange="check(this)">
				<label for="check">Show generic pathways</label>
				<label id="gradient" class="scale-title" style="float:right;display: none">Gradient color scale</label>
				</div>';
		$wgOut->addHTML ($checkbox);
		
		if (!isset ( $select )) {
		$div = "<div style='display:inline-block;overflow:visible;width:100%'>";
		
		$wgOut->addHTML ( $div );
		}

		if (isset ( $select ) & strlen ( $select ) <= 42 & is_string ( $select )) {
			$tissue = fopen ( "wpi/data/NewTA/$dataset/$cutoff/Tissue/$select.txt", r );
			$nrShow = 20;
			$expand = "<b>View all...</b>";
			$collapse = "<b>View first ".($nrShow)."...</b>";
			$button = "<table style='display:inline-block;width:300px;margin: 0.5em 0em 0em 0px'><td width='51%'><div onClick='".
					'doToggle("tissueTable", this, "' . $expand . '", "' . $collapse . '")' .
					"' style='cursor:pointer;color:#0000FF'>"."$expand<td width='45%'></table>";
			
			$html = "<div style='display:block;width: 860px;overflow:visible;width:100%'>
					<style type='text/css'>
					.scale-title {
					    text-align: left;
					    font-weight: bold;
					    font-size: 90%;
					    }
					  .scale-labels {
					    margin: 0;
					    padding: 0;
					    float: left;
					    list-style: none;
					    }
					  .scale-labels li {
					    display: block;
					    float: left;
					    width: 50px;
					    margin-bottom: 6px;
					    text-align: center;
					    font-size: 80%;
					    list-style: none;
					    }
					  .scale-labels li span {
					    display: block;
					    float: left;
					    height: 15px;
					    width: 50px;
					    }
					#gradient{
					display:inline !important;
					}	
					</style>					
					$button
					  <ul class='scale-labels' style='display:inline-block;float:right'>
					    <li><span style='background:#8c8cb9;'></span>0 - 3</li>
					    <li><span style='background:#7676c3;'></span>3 - 5 </li>
					    <li><span style='background:#5151d6;'></span>5 - 7</li>
					    <li><span style='background:#3e3edf;'></span>7 - 10 </li>
					    <li><span style='background:#0000FE;'></span> >10 </li>
					  </ul>
			
			
			</div>
			<div style='display:inline-block;overflow:visible;width:100%'>
			<table id='tissueTable' class='wikitable sortable' style='display:inline-block;width:100%'>
			<tr class='table-blue-tableheadings' id='tr_header'>
			<td class='table-blue-headercell' style='width:44%'>Pathways</td>
			<td class='table-blue-headercell' align='center' style='width:10%'>Linkout</td>
			<td class='table-blue-headercell' align='center'style='width:10%'>Median</td>
			<td class='table-blue-headercell' style='width:1%'></td>
			<td class='table-blue-headercell' align='center' style='width:10%'>Active genes</td>
			<td class='table-blue-headercell' align='center' style='width:10%'>Measured genes</td>
			<td class='table-blue-headercell' align='center'style='width:10%' >%</td>";
			$url = array ();
			$mean = array ();
			$perc = array ();
			$median = array ();
			$nami = array();
			$path_id = array();
			$path_rev = array();
			$ratio = array();
				
			while ( ! feof ( $tissue ) ) {
				$line = fgets ( $tissue );
				$pieces = explode ( "\t", $line );
				$name = $pieces [0];
				$id = strstr ( $name, 'WP' );
				$id = explode ( "_", $id );
				$path_name = explode ( "_WP", $name );
				$path_name = str_replace ( "Hs_", '', $path_name[0] );
				$path_name = str_replace ( "Mm_", '', $path_name );
				$title = Title::newFromText ( ( string ) $id [0], NS_PATHWAY );
				$pp = explode ( ".",$pieces[2]);
				if (isset ( $title )) {
					array_push ( $url, '<a target="_blank" href="' . $title->getFullURL () . '">' . $id[0] . '</a>' );
					array_push ( $mean, $pieces[1] );
					array_push ( $perc, $pp[0] );
					array_push ( $median, $pieces[3] );
					array_push ( $nami, $path_name);
					array_push ( $path_id, $id[0]);
					array_push ( $path_rev, $id[1]);
					array_push ( $ratio,$pieces[4]);
				}
			}
				
			array_multisort ($median, SORT_NUMERIC, SORT_DESC,
			$url, SORT_STRING, SORT_DESC,
			$mean, SORT_NUMERIC, SORT_DESC,
			$perc, SORT_NUMERIC, SORT_DESC,
			$ratio, SORT_NUMERIC, SORT_DESC,
			$path_id, SORT_NUMERIC, SORT_DESC,
			$path_rev, SORT_NUMERIC, SORT_DESC,
			$nami, SORT_STRING, SORT_DESC );
			
			for($i = 0; $i < count ( $mean ); ++ $i) {
				$filename = "wpi/data/NewTA/$dataset/$cutoff/Hs_$nami[$i]_$path_id[$i]_$path_rev[$i].txt";
				$filename2 = "wpi/data/NewTA/$dataset/$cutoff/$nami[$i]_$path_id[$i]_$path_rev[$i].txt";
				$filename = (file_exists ( $filename )) ? $filename : $filename2;
				$list_genes = "";
				$active_index = 0;
				$measure_index = 0;
				if (file_exists ( $filename )) {
					$file = fopen ( $filename, r );
					while ( ! feof ( $file ) ) {
						$line = fgets ( $file );
						if ($line == false)
							break;
						$pieces = explode ( "\t", $line );
						$name = $pieces[0];
						if ($name == $select ){
							$genes = explode ( ",", $pieces [4] );
							$mesure = explode ( ",", $pieces [5] );
							$list_genes = "";
							foreach ( $mesure as $gene ) {
								$info = explode ( ' ', $gene );
								if (count ( $info ) > 1) {
									$list_genes .= "&label[]=".$info[1];
									$measure_index = $measure_index + 1;
								}
							}
							foreach ( $genes as $gene ) {
								$info = explode ( ' ', $gene );
								if (count ( $info ) > 1) {
									$list_genes .= "&label[]=".$info[1];
									$active_index = $active_index + 1;
								}
							}							
						}
					}
				}
				$number = explode ( "/",$ratio[$i]);

				$n = intval($number[0]);
				$m = intval($number[1]);

				// Note: %23D9A4FF => #D9A4FF
				if (!$list_genes == ""){				
					if ($n===$m ){
						$list_genes .= "&colors=%236A03B2";						
						for($l = 1; $l < $active_index; ++ $l){
							$list_genes .= ",%236A03B2";
						}
					}
					else{
						$list_genes .= "&colors=%23B0B0B0";
						for($k = 1; $k < $measure_index; ++ $k){
							$list_genes .= ",%23B0B0B0";
						}
						for($l = 0; $l < $active_index; ++ $l){
							$list_genes .= ",%236A03B2";
						}
					}
				}
				$r = 0;
				$g = 0;
				$b = 0;
				
				if ( $median[$i] < 1.5 ) {
					$r = 170;
					$g = 170;
					$b = 170;
				}

				elseif ( $median[$i] > 10) {
					$color = 255;
					$r = 0;
					$g = 0;
					$b = 255;
				}
				else {
					$r = 170 - 2 *($median[$i]-1.5)/(10-1.5) * (255-170);
					$g = 170 - 2 * ($median[$i]-1.5)/(10-1.5) * (255-170);
					$b = 170 + ($median[$i]-1.5)/(10-1.5) * (255-170);
				}
				$rgb = array( $r, $g, $b );

				$hex = "#";
				$hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
				$hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
				$hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

				if ($i < $nrShow && !in_array($nami[$i], $topTen))
					$doShow = '';
				else
					$doShow = 'toggleMe';			
				$pathway_name = str_replace ( "_", " ", $nami[$i] );
				$html .= <<<HTML
				<tr class='$doShow' id='$nami[$i]'>
				<td ><a  href='#' onClick='tissue_viewer("$path_id[$i]","$list_genes","$pathway_name")'> $pathway_name</a></td>
				<td align='center' >$url[$i]</td>
				<td align='center' >$median[$i]</td>
				<td bgcolor='$hex' > </td>
				<td align='center' >$number[0]</td>				
				<td align='center' >$number[1]</td>
				<td align='center' >$perc[$i]</td>
				
HTML;
			}
			fclose($tissue);
		}

		$html .= '</table>
				
				
				<!--<img role="button" id="sex-toggle-image" src="/wpi/extensions/TissueAnalyzer/images/' . $sex . '_selected.png" style="width:20px;height:38px; margin-top: 12px;vertical-align:top"  >-->
				<!--<div id="anatomogramBody" style="display:inline-block;width:25%; height:600px;vertical-align:top" ></div>-->
				
			
				<style type="text/css">
				  .my-legend .legend-title {
				    text-align: left;
				    margin-bottom: 5px;
				    font-weight: bold;
				    font-size: 90%;
				    }
				  .my-legend .legend-scale ul {
				    margin: 0;
				    margin-bottom: 5px;
				    padding: 0;
				    float: left;
				    list-style: none;
				    }
				  .my-legend .legend-scale ul li {
					display: inline-block;
				    font-size: 80%;
				    list-style: none;
				    margin-left: 0;
				    line-height: 18px;
				    margin-bottom: 2px;
				    }
				  .my-legend ul.legend-labels li span {
				    display: block;
				    float: left;
				    height: 16px;
				    width: 30px;
				    margin-right: 5px;
				    margin-left: 0;
				    border: 1px solid #999;
				    }
				</style>
				</div>
				<div class="my-legend" id="my-legend" style="display: none;">
				<div class="legend-title" id="legend-title" style="display:inline-block;width:100%">Highlighting legend</div>
				<div class="legend-scale" style="display:inline-block">
				  <ul class="legend-labels">
				    <li><input type="color" id="html5colorpicker1"  onchange="clickColor(1,5)" value="#6A03B2">Active gene (expression > '.$cutoff.')</input></li>
				    <li><input type="color" id="html5colorpicker2"  onchange="clickColor(2,5)" value="#B0B0B0"></span>Not-active gene (expression < '.$cutoff.')</li>
				  </ul>				
				</div>
				</div>
				</div>
				<div id="pwyname"></div>
				<iframe id="path_viewer" src ="http://www.wikipathways.org/wpi/PathwayWidget.php?id=WP1" width="860px" height="500px" style="display: none;"></iframe>
				';

		$wgOut->addHTML ( $html );
		return true;
	}
	static function loadMessages() {
		static $messagesLoaded = false;
		global $wgMessageCache;
		if ($messagesLoaded)
			return true;
		$messagesLoaded = true;

		require (dirname ( __FILE__ ) . '/NewTA.i18n.php');
		foreach ( $allMessages as $lang => $langMessages ) {
			$wgMessageCache->addMessages ( $langMessages, $lang );
		}
		return true;
	}
}
