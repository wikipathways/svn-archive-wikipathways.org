<?php

class tableRow {
	protected $data;
	protected $action = false;

	public function __construct( $d ) {
		$this->data = $d;
	}

	public function action( $tag, $ts, $delta ) {
	}

	public function format( $id = null ) {
		if( $id ) {
			return "<tr id='$id'><td>".implode( "<td>", $this->data );
		} else {
			return "<tr><td>".implode( "<td>", $this->data );
		}
	}
}

// Primative
class tableRowFactory {
	static public function produce( $type, $data ) {
		if($type == "red") {
			return new redRow( $data );
		}
		elseif($type == "delete") {
			return new deleteRow( $data );
		}
		else {
			return new tableRow( $data );
		}
	}
}


class redRow extends tableRow {
	public function action( $tag, $ts, $delta ) {
		global $wgLang;
		$date = date_create( $ts );

		if( $date->format("YmdHis") > $tag->getTimeMod() ) {
			$this->action = true;
		} else {
			$this->action = false;
		}
	}

	public function format() {
		// Row is not red if the last edit date (5th column) is after the tag date (4th column)
		$style = "";
		if( ! $this->action ) {
			$style = " style='background-color: #BC8F8F'";
		}
		return "<tr$style><td>".implode( "<td>", $this->data )."\n";
	}
}

class deleteRow extends tableRow {
	public function action( $tag, $ts, $delta ) {
		global $wgLang;
		$prev = date_create( "now" );
		$prev->modify( "-$delta" );
		$date = date_create( $ts );

		if( $date->format("YmdHis") < $tag->getTimeMod() && $prev->format("YmdHis") > $tag->getTimeMod() ) {
			/* In the future, we'll set this to the ID of the tag or page, but for now ... */
			$this->action = $tag->getPageId();
		} else {
			$this->action = false;
		}
	}

	private function deleteButton( $row ) {
		global $wgUser, $wgStylePath;
		$pageId = $this->action;

		if( $wgUser->isLoggedIn() ) {
			return "<A title='". wfmsg( "wpict-delete" ) . "' ".
				"href='javascript:CurationTags.removeTagFromPathway(\"ProposedDeletion\", $pageId, \"$row\" )'>" .
				"<IMG src='$wgStylePath/wikipathways/cancel.png'/></A>";
		} else {
			return "";
		}
	}

	public function format() {
		// show a delete button
		$row = "";
		if( $this->action ) {
			$row = "row".$this->action;
		}
		return parent::format( $row )."<td>".( $this->action !== false ?
			$this->deleteButton( $row ) : wfMsg( "wpict-too-new" ) );
	}
}

class LegacySpecialCurationTags extends SpecialPage {
	function __construct() {
		parent::__construct( "SpecialCurationTags" );
	}

	function execute( $par ) {
		global $wgRequest;

		if( isset( $wgRequest->data['title'] ) ) unset( $wgRequest->data['title'] );
		$query = array();
		foreach( $wgRequest->data as $k => $v) {
			$query[] = urlencode( $k ) . '=' . urlencode( $v );
		}

		$title = Title::newFromText( "CurationTags", NS_SPECIAL );
		$wgRequest->response()->header( "HTTP/1.1 301 Moved Permanently" );
		$wgRequest->response()->header( "Content-Type: text/html; charset=utf-8" );
		$wgRequest->response()->header( "Location: ". $title->getLocalURL( implode( "&", $query ) ) );
	}
}

class SpecialCurationTags extends SpecialPage {
	function __construct() {
		parent::__construct("CurationTags");
		self::loadMessages();
	}

	private $tagNames;

	function execute($par) {
		global $wgOut, $wgUser, $wgLang, $wgRequest, $wgTitle;
		$url = $wgTitle->getLocalURL();
		$this->setHeaders();

		if( $tagName = $wgRequest->getVal( 'showPathwaysFor' ) ) {
			$disp = htmlentities( CurationTag::getDisplayName($tagName) );
			$wgOut->setPageTitle( wfMsgExt( 'curation-tag-show', array( 'parsemsg' ), $disp ) );
			$wgOut->addScriptFile( "../wikipathways/CurationTags.js"  );
			$def = CurationTag::getTagDefinition();
			// Don't you just love how php does things?
			$useRev  = "" . array_shift( $def->xpath("Tag[@name='$tagName']/@useRevision") );
			$newEdit = "" . array_shift( $def->xpath("Tag[@name='$tagName']/@newEditHighlight") );
			$action  = "" . array_shift( $def->xpath("Tag[@name='$tagName']/@highlightAction") );

			$pages = CurationTag::getPagesForTag($tagName);
			$table = "";
			foreach($pages as $pageId) {
				try {
					$t = Title::newFromId($pageId);
					if($t->getNamespace() == NS_PATHWAY) {
						$p = Pathway::newFromTitle($t);
						if($p->isDeleted()) continue; //Skip deleted pathways

						$nr = $nr + 1;

						$data = array();
						$data[] = "<a href='{$p->getFullUrl()}'>{$p->name()}</a>";
						$data[] = $p->species();

						$tag = new MetaTag($tagName, $pageId);
						$umod = User::newFromId($tag->getUserMod());
						$data[] = $wgUser->getSkin()->userLink( $umod->getId(), $umod->getName() );
						$data[] = "<i style='display: none'>{$tag->getTimeMod()}</i>".
							$wgLang->timeanddate( $tag->getTimeMod(), true );

						if($useRev) {
							if( $p->getLatestRevision() == $tag->getPageRevision() ) {
								$data[] = "<font color='green'>yes</font>";
							} else {
								$ts = $p->getFirstRevisionAfterRev( $tag->getPageRevision() )->getTimestamp();
								$data[] = "<font color='red'><i style='display:none'>$ts</i>".
									$wgLang->timeAndDate( $ts ) ."</font>";
							}
						}

						if($newEdit) {
							// Last Edited date
							$ts = Revision::newFromId( $p->getLatestRevision() )->getTimestamp();
							$data[] = "<i style='display:none'>$ts</i>".
								$wgLang->timeAndDate( $ts );
						}

						$row = tableRowFactory::produce( $action, $data );
						$row->action( $tag, $ts, $newEdit );
						$table .= $row->format();
					}
				} catch(Exception $e) {
					wfDebug("SpecialCurationTags: unable to create pathway object for page " . $pageId);
				}
			}

			$wgOut->addWikiText(
				"The table below shows all $nr pathways that are tagged with curation tag: " .
				"'''$disp'''. "
			);
			$wgOut->addHTML("<p><a href='$url'>back</a></p>");
			$wgOut->addHTML("<table class='prettytable sortable'><tbody>");
			$wgOut->addHTML("<tr><th>Pathway name<th>Organism<th>Tagged by<th>Date tagged");
			if($useRev) {
				$wgOut->addHTML("<th>Applies to latest revision");
			}
			if($newEdit) {
				$wgOut->addHTML("<th>Last Edited");
			}
			$wgOut->addHTML($table);
		} else {
			$wgOut->addWikiText("This page lists all available curation tags. " .
				"See the [[Help:CurationTags|help page]] for instructions on how to use curation tags.");
			$wgOut->addHTML("<table class='prettytable sortable'><tbody>");
			$wgOut->addHTML("<th>Name<th>Template<th>Description");
			$this->tagNames = CurationTag::getTagNames();
			foreach($this->tagNames as $tagName) {
				$tmp = htmlentities("Template:$tagName");
				$disp = htmlentities(CurationTag::getDisplayName($tagName));
				$descr = htmlentities(CurationTag::getDescription($tagName));
				$wgOut->addHTML("<tr><td>$disp<td>");
                                $l = new Linker;
                                $wgOut->addHTML( $l->makeLink( $tmp, $tagName ) );
				$wgOut->addHTML("<td>$descr");
				$urlName = htmlentities($tagName);
				$url = $wgTitle->getLocalURL("showPathwaysFor=$urlName");
				$wgOut->addHTML("<td><a href='".$url."'>Show pathways</a>");
			}
		}
		$wgOut->addHTML("</tbody></table>");
	}

	function loadMessages() {
		static $messagesLoaded = false;
		global $wgMessageCache;
		if ( $messagesLoaded ) return true;
		$messagesLoaded = true;

		require( dirname( __FILE__ ) . '/SpecialCurationTags.i18n.php' );
		foreach ( $allMessages as $lang => $langMessages ) {
			$wgMessageCache->addMessages( $langMessages, $lang );
		}
		return true;
	}
}
