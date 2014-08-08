<?php

class TissueAnalyzer extends SpecialPage {

	function TissueAnalyzer() {
		SpecialPage::SpecialPage ( "TissueAnalyzer" );
		// self::loadMessages();
	}

	function execute($par) {
		global $wgOut, $wgUser, $wgLang;
		$this->setHeaders ();
		$wgOut->setPagetitle ( "TissueAnalyzer" );
		
		$sex = (isset ( $_GET ["sex"] )) ? $_GET ["sex"] : "male";
		$intro = <<<HTML

			<div style="display:inline-block">
			<p> The dataset come from the
			<a target="_blank" href="http://www.ebi.ac.uk/arrayexpress/experiments/E-MTAB-1733">E-MTAB-1733</a>
			experiment.	And it have been analysed through the TissueAnalyzer plugin on
			<a target="_blank" href="http://www.pathvisio.org/">PathVisio</a></p>
			<div style='display:inline-block'>
			
HTML;

		$wgOut->addHTML ( $intro );
		$speciesSelect = "<form name= action=''>
				<SELECT name='select' size='1'>";
		$tissuesFile = fopen ( "wpi/bin/TissueAnalyzer/tissues.txt", r );
		$select = $_GET ["select"];

		

		$topTen = array("Cytoplasmic_Ribosomal_Proteins","Proteasome_Degradation",
				"TCA_Cycle","Electron_Transport_Chain",
				"Peroxisomal_beta-oxidation_of_tetracosanoyl-CoA","Oxidative_phosphorylation");
		$top = json_encode($topTen);

		$js .= '
				<script language="JavaScript" type="text/javascript" src="/skins/wikipathways/TissueAnalyzer/jquery-migrate-1.2.0.min.js"></script>
				<script language="JavaScript" type="text/javascript" src="/skins/wikipathways/TissueAnalyzer/jquery-ui.min.js"></script>
				<script language="JavaScript" type="text/javascript" src="/skins/wikipathways/TissueAnalyzer/jquery.svg.js"></script>
				<script language="JavaScript" type="text/javascript" src="/skins/wikipathways/TissueAnalyzer/anatomogramModule.js"></script>
				<script language="JavaScript" type="text/javascript" src="/skins/wikipathways/TissueAnalyzer/jquery-svgpan.js"></script>

				<script language="JavaScript">
					function tissue_viewer(id,genes){
						console.log(genes);
						$("#path_viewer").attr("src",
						"http://www.wikipathways.org/wpi/PathwayWidget.php?id="+id+genes);
						$("#path_viewer").attr("style","overflow:hidden;");
					}
				</script>

				<script language="JavaScript">
					function check() {
						var js_array = '.$top.';
						if ($("#check").is(":checked")){
							$("label[for=check]").text("Hide common pathways");
							$("#tissueTable tr").each(function() {
								if (js_array.indexOf(this.id) != -1)  {
								//$(this).attr("class","");
								$(this).show();
								}
							});
						}
						else{
							$("label[for=check]").text("Show common pathways");
							$("#tissueTable tr").each(function() {
								if (js_array.indexOf(this.id) != -1)  {
								//$(this).attr("class","toggleMe");
								$(this).hide();
								}
							});
						}
					}
						</script>
							
						<script type="text/javascript">
							function tissue(name,id) {
								this.name = name;
								this.id = id;
							}
							$( document ).ready(function() {
								//window.onload =(function () {
								var allQueryFactorValues = new Array(); ';

		while ( ! feof ( $tissuesFile ) ) {
			$line = fgets ( $tissuesFile );
			$pieces = explode ( "\t", $line );
			$tissue = $pieces [0];
			$id = trim($pieces [1]);
			if ($tissue === false)
				break;
			$js .= 'allQueryFactorValues[allQueryFactorValues.length] = new tissue("'.$tissue.'","'.$id.'");';
				
			$speciesSelect .= (strcmp ( trim ( $select ), trim ( $tissue ) ) == 0) ? "<option selected=\"selected\">$tissue" : "<option>$tissue";
		}
		fclose ( $tissuesFile );

		$js .= 'anatomogramModule.init(
				allQueryFactorValues,
				"/wpi/extensions/TissueAnalyzer/images/human_male.svg",
				"/wpi/extensions/TissueAnalyzer/images/human_female.svg",
				"' . $select . '", "' . $sex . '"
						);
	});</script>';

		$speciesSelect .= "</SELECT>";

		$button = <<<HTML
			<INPUT type="submit" name="button" value= "submit"></form>
HTML;
		$out = <<<HTML
			<table id='nsselect' class='allpages'>
				<tr>
					<td align='right'>Select tissue:</td>
					<td align='left'>{$speciesSelect}</td>
					<td align='right'>{$button}</td>
				</tr>
			</table>
HTML;
		$wgOut->addHTML ( $out );

		$checkbox = '
				<input id="check" type="checkbox" onchange="check(this)">
				<label for="check">Show commun pathways</label><br>
				';
		$wgOut->addHTML ($checkbox);


		if (isset ( $select ) & strlen ( $select ) <= 16 & is_string ( $select )) {
			$tissue = fopen ( "wpi/data/TissueAnalyzer/Tissue/$select.txt", r );
				
			$nrShow = 20;
			$expand = "<b>View all...</b>";
			$collapse = "<b>View first ".($nrShow)."...</b>";
			$button = "<table><td width='51%'><div onClick='".
					'doToggle("tissueTable", this, "' . $expand . '", "' . $collapse . '")' .
					"' style='cursor:pointer;color:#0000FF'>"."$expand<td width='45%'></table>";
			$html = "$button
			<table id='tissueTable' class='wikitable sortable'>
			<tr class='table-blue-tableheadings' id='tr_header'>
			<td class='table-blue-headercell'>Viewer</td>
			<td class='table-blue-headercell'>Pathway name</td>
			<td colspan=2>Median expression</td>
			<td class='table-blue-headercell'>Mean expression</td>
			<td class='table-blue-headercell'>Ratio <br>active gene measured</td>
			<td class='table-blue-headercell'>(%)</td>";
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
				//$active = $pieces[4]." ( ".$pieces[2]."% )";
// 				$pieces[2] = str_replace ( ".", ',', $pieces[2] );
				$pp = explode ( ".",$pieces[2]);
				if (isset ( $title )) {
					array_push ( $url, '<a target="_blank" href="' . $title->getFullURL () . '">' . $path_name . '</a>' );
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
				$filename = "wpi/data/TissueAnalyzer/Hs_$nami[$i]_$path_id[$i]_$path_rev[$i].txt";
				$filename2 = "wpi/data/TissueAnalyzer/$nami[$i]_$path_id[$i]_$path_rev[$i].txt";
				$filename = (file_exists ( $filename )) ? $filename : $filename2;
				$list_genes = "";
				$active_index = 0;
				$mesure_index = 0;
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
							foreach ( $genes as $gene ) {
								$info = explode ( ' ', $gene );
								if (count ( $info ) > 1) {
									$list_genes .= "&label[]=".$info[1];
									$active_index = $active_index + 1;
									//$list_genes .= "&xref[]=".$info[0].",Ensembl";
								}
							}
							foreach ( $mesure as $gene ) {
								$info = explode ( ' ', $gene );
								if (count ( $info ) > 1) {
									$list_genes .= "&label[]=".$info[1];
									$mesure_index = $mesure_index + 1;
									//$list_genes .= "&xref[]=".$info[0].",Ensembl";
								}
							}
						}
					}
				}
				
				if (!$list_genes == ""){
					$list_genes .= "&colors=%236A03B2";
					for($k = 0; $k < $mesure_index; ++ $k) {
						$list_genes .= ",%23D9A4FF";
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

				$html .= <<<HTML
				<tr class='$doShow' id='$nami[$i]'>
				<td ><input name='old' type='radio' onClick='tissue_viewer("$path_id[$i]","$list_genes")'></td>
				<td >$url[$i]</td>
				<td align='center'>$median[$i]</td>
				<td bgcolor='$hex'> </td>
				<td align='center'>$mean[$i]</td>				
				<td align='center'>$ratio[$i]</td>
				<td >$perc[$i]</td>
				
HTML;
			}
			fclose($tissue);
		}
		$html .= '</table></div>
				
				<img id="sex-toggle-image" src="/wpi/extensions/TissueAnalyzer/images/' . $sex . '_selected.png" style="width:20px;height:38px;padding:2px;vertical-align:top"" role="button" >
				<div id="anatomogramBody" style="display:inline-block;width: 400px; height:600px;vertical-align:top" ></div></div>
				<iframe id="path_viewer" src ="http://www.wikipathways.org/wpi/PathwayWidget.php?id=WP1" width="900px" height="500px" style="display: none;"></iframe>';


		$html .= $js;
		$wgOut->addHTML ( $html );
	}

	static function loadMessages() {
		static $messagesLoaded = false;
		global $wgMessageCache;
		if ($messagesLoaded)
			return true;
		$messagesLoaded = true;

		require (dirname ( __FILE__ ) . '/TissueAnalyzer.i18n.php');
		foreach ( $allMessages as $lang => $langMessages ) {
			$wgMessageCache->addMessages ( $langMessages, $lang );
		}
		return true;
	}
}