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
			<li><a target="_blank" href="http://www.ebi.ac.uk/arrayexpress/experiments/E-MTAB-2836">E-MTAB-2836</a> -
				 RNA-seq of coding RNA from tissue samples of 122 human individuals representing 32 different tissues from the Human Protein Atlas project 
			<li><a target="_blank" href="http://www.ebi.ac.uk/arrayexpress/experiments/E-MTAB-2919">E-MTAB-2919</a> -
				 RNA-seq from 53 human tissue samples from the Genotype-Tissue Expression (GTEx) Project
			<li><a target="_blank" href="http://www.ebi.ac.uk/arrayexpress/experiments/E-MTAB-3358">E-MTAB-3358</a> - 
				 RNA-Seq CAGE (Cap Analysis of Gene Expression) analysis of 56 human tissues in RIKEN FANTOM5 project
			<li><a target="_blank" href="http://www.ebi.ac.uk/arrayexpress/experiments/E-MTAB-3579">E-MTAB-3579</a> - 
				 RNA-Seq CAGE (Cap Analysis of Gene Expression) analysis of 35 mice tissues in RIKEN FANTOM5 project
			</ul>
			</p>			
			<hr/><br/>
			</div>
HTML;
		
	
		$topTenFile = fopen ( "wpi/bin/TissueAnalyzer/topTen.txt", r );
		$topTen = array ();
		while (!feof($topTenFile)) {
			//$line = fgets($topTenFile);
			array_push ( $topTen, trim (fgets($topTenFile)) );
		}
		fclose ( $topTenFile );
		//$topTen = array("Cytoplasmic_Ribosomal_Proteins","Proteasome_Degradation",
		//		"TCA_Cycle","Electron_Transport_Chain",
		//		"Peroxisomal_beta-oxidation_of_tetracosanoyl-CoA","Oxidative_phosphorylation");
		$top = json_encode($topTen);
		$wgOut->addHTML ( $intro );
		
		$wgOut->addScriptFile( "/wpi/extensions/TissueAnalyzer/js/jquery-migrate-1.2.0.min.js");
		$wgOut->addScriptFile( "/wpi/extensions/TissueAnalyzer/js/jquery-ui.min.js");
		//$wgOut->addScriptFile( "/wpi/extensions/TissueAnalyzer/js/jquery.svg.js");
		//$wgOut->addScriptFile( "/wpi/extensions/TissueAnalyzer/js/anatomogramModule.js");
	
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
							switch($(this).val()) {
								case "E-MTAB-2836":
									document.getElementById("description").innerHTML= 
										"RNA-seq was performed of tissue samples from 122 human individuals "+
										"representing 32 different tissues in order to study the human tissue transcriptome."+
										"This submission contains 27 new samples and the data from E-MTAB-1733.";
									break;
								case "E-MTAB-2919":
									document.getElementById("description").innerHTML= 
										"RNA-seq from human tissue samples from the Genotype-Tissue Expression (GTEx) Project (http://www.gtexportal.org/home/)";
									break;
								case "E-MTAB-3358":
									document.getElementById("description").innerHTML= 
										"This experiment captures the expression data reported by the RIKEN FANTOM5 project ( http://fantom.gsc.riken.jp/5/ ),"+
										"focusing on tissue/organism part data which was deposited in the seqence read archive (SRA) under study accssion DRP001031 ( https://www.ebi.ac.uk/ena/data/view/DRP001031 ) ."+
										"The samples in this experiment can also be found on a dedicated page of the FANTOM website: http://fantom.gsc.riken.jp/5/sstar/Browse_samples ."+
										"Since this is CAGE analsyis, gene expression data is reported by FANTOM5 in TPMs (tags per milliion) for gene promoters.";
								case "E-MTAB-3358":
									document.getElementById("description").innerHTML= 
										"This experiment captures the expression data reported by the RIKEN FANTOM5 project ( http://fantom.gsc.riken.jp/5/ ),"+
										"focusing on mice tissue data which was deposited in the sequence read archive (SRA) under study accession DRP001032 (https://www.ebi.ac.uk/ena/data/view/DRP001031 ) ."+
										"The samples in this experiment can also be found on a dedicated page of the FANTOM website: http://fantom.gsc.riken.jp/5/sstar/Browse_samples. Since this is CAGE analysis,"+
										"gene expression data is reported by FANTOM5 in TPMs (tags per milliion) for gene promoters."+
										"This is in conjunction with E-MTAB-3578 (http://www.ebi.ac.uk/arrayexpress/experiments/E-MTAB-3578/)";
							}
					});
				});
				</script>');

		$datasetSelect = "<form name= action=''><SELECT name='dataset' id='dataSelect' size='1'>";
		$datasetSelect .=(strcmp ( trim ($dataset), "E-MTAB-2836" ) == 0) ? "<option selected=\"selected\">$dataset</option>" :"<option>E-MTAB-2836</option>";
		$datasetSelect .=(strcmp ( trim ($dataset), "E-MTAB-2919" ) == 0) ? "<option selected=\"selected\">$dataset</option>" :"<option>E-MTAB-2919</option>";
		$datasetSelect .=(strcmp ( trim ($dataset), "E-MTAB-3358" ) == 0) ? "<option selected=\"selected\">$dataset</option>" :"<option>E-MTAB-3358</option>";
		$datasetSelect .=(strcmp ( trim ($dataset), "E-MTAB-3579" ) == 0) ? "<option selected=\"selected\">$dataset</option>" :"<option>E-MTAB-3579</option>";
		$datasetSelect .="</SELECT>";

		$speciesSelect = "<SELECT name='select' id='tissueSelect' size='1'>";
		//$tissuesFile = fopen ( "wpi/bin/TissueAnalyzer/"+trim($dataset)+"_tissues.txt", r );
		//$path = "wpi/bin/TissueAnalyzer/"+$dataset;
		$path = "wpi/bin/TissueAnalyzer/".$dataset."_tissues.txt";
		$tissuesFile = fopen ($path , r );
		//$tissuesFile = fopen ( "wpi/bin/TissueAnalyzer/E-MTAB-2836_tissues.txt", r );
		$select = $_GET ["select"];		

		
		
		//$js .= '<script type="text/javascript">
		//					function tissue(name,id) {
		//						this.name = name;
		//						this.id = id;
		//					}
		//					$( document ).ready(function() {
		//						//window.onload =(function () {
		//						var allQueryFactorValues = new Array(); ';

		while ( ! feof ( $tissuesFile ) ) {
			$line = fgets ( $tissuesFile );
			$tissue = $line;
			//$pieces = explode ( "\t", $line );
			//$tissue = $pieces [0];
			//$id = trim($pieces [1]);
			if ($tissue === false)
				break;
			//$js .= 'allQueryFactorValues[allQueryFactorValues.length] = new tissue("'.$tissue.'","'.$id.'");';
				
			$speciesSelect .= (strcmp ( trim ( $select ), trim ( $tissue ) ) == 0) ? "<option selected=\"selected\">$tissue</option>" : "<option>$tissue</option>";
		}
		fclose ( $tissuesFile );

		//$js .= 'anatomogramModule.init(
		//		allQueryFactorValues,
		//		"/wpi/extensions/TissueAnalyzer/images/human_male.svg",
		//		"/wpi/extensions/TissueAnalyzer/images/human_female.svg",
		//		"' . $select . '", "' . $sex . '"
		//				);
	//});</script>';
	//	$wgOut->addScript($js);
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

		if (isset ( $select ) & strlen ( $select ) <= 16 & is_string ( $select )) {
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
				<div class="legend-title" id="legend-title" style="display:inline-block">Highlighting legend</div>
				<div class="legend-scale">
				  <ul class="legend-labels">
				    <li><span style="background:#6A03B2;"></span>Active gene (expression > 6)</li>
				    <li><span style="background:#B0B0B0;"></span>Not-active gene (expression < 6)</li>
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
