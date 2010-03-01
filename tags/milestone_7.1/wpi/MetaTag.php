<?php
/* MetaTag API */

/**
 * This class represents a single metatag, providing support
 * for reading and writing tags. This class also takes care of 
 * updating the tag history.
 */
class MetaTag {
	public static $TAG_HISTORY_TABLE = "tag_history";
	public static $TAG_TABLE = "tag";
	
	public static $ACTION_UPDATE = "update";
	public static $ACTION_REMOVE = "remove";
	public static $ACTION_CREATE = "create";
	
	private $exists = false;
	
	private $name;
	private $text;
	private $page_id;
	private $revision;
	private $user_add;
	private $user_mod;
	private $time_add;
	private $time_mod;
	
	/**
	 * Create a new metatag object
	 * @param $name The tag name
	 * @param $page_id The id of the page that will be tagged
	 */
	public function __construct($name, $page_id) {
		if(!$name) throw new MetaTagException("Name can't be empty");
		if(!$page_id) throw new MetaTagException("Page id can't be empty");
		
		$this->name = $name;
		$this->page_id = $page_id;
		$this->loadFromDB();
	}
	
	/**
	 * Get all tags for the given page
	 * @param $pageId The page id
	 * @return An array of MetaTag objects
	 */
	public static function getTagsForPage($page_id) {
		$tags = array();
		
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
			self::$TAG_TABLE, 
			array('tag_name'),
			array('page_id' => $page_id)
		);
		while($row = $dbr->fetchObject( $res )) {
			$tags[] = new MetaTag($row->tag_name, $page_id);
		}
		
		$dbr->freeResult( $res );
		return $tags;
	}
	
	/**
	 * Get all pages that have the given tag.
	 * @param $name The tag name
	 * @return An array with page ids
	 */
	public static function getPagesForTag($name) {
		$pages = array();
		
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
			self::$TAG_TABLE, 
			array('page_id'),
			array('tag_name' => $name)
		);
		while($row = $dbr->fetchObject( $res )) {
			$pages[] = $row->page_id;
		}
		
		$dbr->freeResult( $res );
		return $pages;
	}
	
	/**
	 * Attempts to load the tag information
	 * from the database if the tag exists
	 */
	private function loadFromDB() {
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
			self::$TAG_TABLE, 
			array('tag_text', 'revision', 'user_add', 'user_mod', 'time_add', 'time_mod'),
			array('tag_name' => $this->name, 'page_id' => $this->page_id)
		);
		$row = $dbr->fetchObject( $res );
		if($row) {
			$this->exists = true;
			$this->text = $row->tag_text;
			$this->revision = $row->revision;
			$this->user_add = $row->user_add;
			$this->user_mod = $row->user_mod;
			$this->time_add = $row->time_add;
			$this->time_mod = $row->time_mod;
		}
		$dbr->freeResult( $res );
	}
	
	/**
	 * Write the tag information to the database. Existing tag with
	 * the same name/page_id will be overwritten. This method also checks if the
	 * current user ($wgUser) is allowed to write the tag (based on edit permissions 
	 * of the page that will be tagged.
	 */
	public function save() {
		if($this->canWrite()) {
			$this->doWriteToDB();
		} else {
			throw new MetaTagException($this, "User not permitted to tag page");
		}
	}
	
	/**
	 * Remove the tag from the database. 
	 */
	public function remove() {
		if($this->canWrite()) {
			$this->doRemove();
		} else {
			throw new MetaTagException($this, "User not permitted to tag page");
		}
	}
	
	private function canWrite() {
		//Check valid page and user permissions
		$title = Title::newFromID($this->page_id);
		if($title) {
			if($title->userCan('edit')) {
				return true;
			} else {
				return false;
			}
		} else {
			throw new MetaTagException($this, "Unable to create title object");
		}
	}
	
	private function doRemove() {
		$dbw =& wfGetDB(DB_MASTER);
		$dbw->immediateBegin();

		if($this->exists) {
			$this->updateTimeStamps();
			$this->updateUsers();
		
			$dbw->delete(
				self::$TAG_TABLE,
				array('tag_name' => $this->name, 'page_id' => $this->page_id)
			);
			
			$this->writeHistory(self::$ACTION_REMOVE);
		}
		
		$dbw->immediateCommit();
		$this->exists = false;
	}
	
	private function doWriteToDB() {
		$dbw =& wfGetDB(DB_MASTER);
		$dbw->immediateBegin();

		$this->updateTimeStamps();
		$this->updateUsers();
		
		$values = array(
			'tag_text' => $this->text,
			'revision' => $this->revision,
			'user_mod' => $this->user_mod,
			'time_mod' => $this->time_mod
		);
		
		if($this->exists) {
			$dbw->update(
				self::$TAG_TABLE,
				$values,
				array('tag_name' => $this->name, 'page_id' => $this->page_id)
			);
			
			$dbw->immediateCommit();
			
			$this->writeHistory(self::$ACTION_UPDATE);
		} else {
			$values['tag_name'] = $this->name;
			$values['page_id'] = $this->page_id;
			$values['time_add'] = $this->time_add;
			$values['user_add'] = $this->user_add;
			$dbw->insert(
				self::$TAG_TABLE,
				$values
			);
			
			$this->exists = true;
			$dbw->immediateCommit();
			
			$this->writeHistory(self::$ACTION_CREATE);
		}
		

	}
	
	private function writeHistory($action) {
		$dbw =& wfGetDB(DB_MASTER);
		$dbw->immediateBegin();

		$dbw->insert(
			self::$TAG_HISTORY_TABLE,
			array(
				'tag_name' => $this->name,
				'page_id' => $this->page_id,
				'action' => $action,
				'action_user' => $this->user_mod,
				'time' => $this->time_mod
			)
		);
		
		$dbw->immediateCommit();
	}
	
	private function updateUsers() {
		global $wgUser;
		if($wgUser) {
			$this->user_mod = $wgUser->getID();
			if(!$this->exists) {
				$this->user_add = $this->user_mod;
			}
		}
	}
	
	private function updateTimestamps() {
		$this->time_mod = wfTimestamp(TS_MW);
		if(!$this->exists) {
			$this->time_add = $this->time_mod;
		}
	}
	
	/**
	 * Check whether this tag already exists in the
	 * database
	 */
	public function exists() {
		return $this->exists;
	}
	
	/**
	 * Get the contents of the tag
	 */
	public function getText() {
		return $this->text;
	}
	
	/**
	 * Set the contents of the tag
	 */
	public function setText($text) {
		$this->text = $text;
	}
	
	/**
	 * Get the tag name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Get the id of the page this tag applies to
	 */
	public function getPageId() {
		return $this->page_id;
	}
	
	/**
	 * Get the page revision this tag applies to
	 */
	public function getPageRevision() {
		return $this->revision;
	}
	
	/**
	 * Set the page revision this tag applies to
	 */
	public function setPageRevision($revision) {
		$this->revision = $revision;
	}
	
	/**
	 * Get the id of the user that added this tag
	 */
	public function getUserAdd() {
		return $this->user_add;
	}
	
	/**
	 * Get the id of the user that last modified this tag
	 */
	public function getUserMod() {
		return $this->user_mod;
	}
	
	/**
	 * Get the timestamp of the tag creation
	 */
	public function getTimeAdd() {
		return $this->time_add;
	}
	
	/**
	 * Get the timestamp of the last tag modification
	 */
	public function getTimeMod() {
		return $this->time_mod;
	}
	
	/**
	 * Get the tag history, starting at the given time
	 * @param $fromTime A timestamp in the TS_MW format
	 * @return An array of MetaTagHistoryRow objects
	 */
	public function getHistory($fromTime = '0') {
		return self::queryHistory($this->page_id, $this->name, $fromTime);
	}
	
	public static function getHistoryForPage($pageId, $fromTime = '0') {
		return self::queryHistory($pageId, false, $fromTime);
	}
	
	private static function queryHistory($pageId, $tagName, $fromTime = '0') {
		
		$nameWhere = '';
		if($tagName) {
			$nameWhere = "'{$tagName}' AND";
		}
		
		$dbr = wfGetDB( DB_SLAVE );
		$tbl = self::$TAG_HISTORY_TABLE;
		$query = "SELECT * FROM $tbl WHERE " .
			"$nameWhere page_id = {$pageId} " .
			"AND time >= $fromTime ORDER BY time DESC";
		$res = $dbr->query($query);
		$history = array();
		while($row = $dbr->fetchObject( $res )) {
			$history[] = new MetaTagHistoryRow($row);
		}
		$dbr->freeResult( $res );
		return $history;
	}
}

class MetaTagException extends Exception {
	private $tag;
	
	public function __construct($tag, $msg) {
		parent::__construct($msg);
		$this->tag = $tag;
	}
	
	public function getTag() { return $tag; }
}

/**
 * Represent a row in the tag history table.
 */
class MetaTagHistoryRow {
	private $tag_name;
	private $page_id;
	private $action;
	private $user;
	private $time;
	
	function __construct($dbRow) {
		$this->tag_name = $dbRow->tag_name;
		$this->page_id = $dbRow->page_id;
		$this->action = $dbRow->action;
		$this->user = $dbRow->action_user;
		$this->time = $dbRow->time;
	}
	
	/**
	 * Get the action that was performed on the tag
	 */
	public function getAction() {
		return $this->action;
	}
	
	/**
	 * Get the id of the user that performed the action
	 */
	public function getUser() {
		return $this->user;
	}
	
	/**
	 * Get the time the action was performed
	 */
	public function getTime() {
		return $this->time;
	}
	
	/**
	 * Get the tag name
	 */
	public function getTagName() {
		return $this->tag_name;
	}
	
	/**
	 * Get the page id the tag applies to
	 */
	public function getPageId() {
		return $this->page_id;
	}
}

?>