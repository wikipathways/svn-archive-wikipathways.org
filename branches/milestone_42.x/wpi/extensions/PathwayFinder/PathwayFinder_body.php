<?php

// visit https://rcbranch.wikipathways.org/index.php/Special:PathwayFinder?database=mirtarbase&identifiers=hsa-miR-21-3p
class PathwayFinder extends SpecialPage {
	protected $name = 'PathwayFinder';

	function PathwayFinder() {
		SpecialPage::SpecialPage ( $this->name  );
		self::loadMessages();
	}

	function execute($par) {
		global $wgOut, $wgUser, $wgLang;
		$this->setHeaders ();
		$wgOut->setPagetitle ("Pathway Finder");

		$welcomePage = false;

		$out = <<<HTML
			<style type='text/css'>
					.navi {
							//list-style: none;
							margin: 0;
							padding: 0px 0 0px 30px;
							font-size: 135%;
					}
					.navi a {
							display: block;
							color: #000;
							padding: 4px 0 0px 0px;
							text-decoration: none;
					}
					.navi a:hover {
							background-color: #555;
							color: white;
					}			
			</style>

			<div id="pathway-finder-container" style="display:inline-block;overflow:visible;">
				Loading...
			</div>
			<script type="text/javascript" src="/wpi/extensions/PathwayFinder/pathway-finder.js"></script>
HTML;
		//$wgOut->addScriptFile('/wpi/lib/tissueanalyzer/fancybox/jquery.fancybox-1.3.4.js');		
		$wgOut->addHTML($out);
		
		return true;
	}


	static function loadMessages() {
		static $messagesLoaded = false;
		global $wgMessageCache;
		if ($messagesLoaded)
			return true;
		$messagesLoaded = true;

		require (dirname ( __FILE__ ) . '/PathwayFinder.i18n.php');
		foreach ( $allMessages as $lang => $langMessages ) {
			$wgMessageCache->addMessages ( $langMessages, $lang );
		}
		return true;
	}
}
