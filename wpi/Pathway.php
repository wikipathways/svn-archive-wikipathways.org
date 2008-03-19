<?php
require_once('PathwayData.php');
require_once('CategoryHandler.php');
require_once('StatisticsCache.php');

/**
Class that represents a Pathway on WikiPathways
**/
class Pathway {
	private static $spName2Code = array(
		'Homo sapiens' => 'Hs', 
		'Rattus norvegicus' => 'Rn', 
		'Mus musculus' => 'Mm',
		'Drosophila melanogaster' => 'Dm',
		'Caenorhabditis elegans' => 'Ce',
		'Saccharomyces cerevisiae' => 'Sc',
	);
	private static $spCode2Name; //TODO: complete species
	
	private $fileTypes = array(
				FILETYPE_IMG => FILETYPE_IMG, 
				FILETYPE_GPML => FILETYPE_GPML,
				FILETYPE_PNG => FILETYPE_IMG
	);

	private $pwName;
	private $pwSpecies;
	
	private $pwData; //The PathwayData for this pathway
	private $pwCategories; //The CategoryHandler for this pathway
	private $firstRevision; //The first revision of the pathway article
	private $revision; //The active revision for this instance (0 = current by default)

	/**
	 Constructor for this class.
	 \param name The name of the pathway (without namespace and species prefix!)
	 \param species The species (full name, e.g. Human)
	 \param updateCache Whether the cache should be updated if needed
	*/
	function __construct($name, $species, $updateCache = false) {
		wfDebug("Creating pathway: $name, $species\n");
		if(!$name) throw new Exception("name argument missing in constructor for Pathway");
		if(!$species) throw new Exception("species argument missing in constructor for Pathway");
		
		# general illegal chars 
		
		//~ $rxIllegal = '/[^' . Title::legalChars() . ']/';
		$rxIllegal = '/[^a-zA-Z0-9_ -]/';
		if (preg_match ($rxIllegal, $name, $matches))
		{
			throw new Exception("Illegal character '" . $matches[0] . "' in pathway name");
		}
		
		$this->pwName = $name;
		$this->pwSpecies = $species;
		
		if($updateCache) $this->updateCache();
	}
		
	/**
	 * Get the active revision in the modification
	 * history for this instance. The active revision
	 * is '0' by default, pointing to the most recent
	 * revision.
	 * \see Pathway::setActiveRevision(revision)
	 */
	public function getActiveRevision() {
		return $this->revision;
	}
	
	/**
	 * Get the revision number of the latest version
	 * of this pathway
	 **/
	public function getLatestRevision() {
		return $this->getTitleObject()->getLatestRevID();
	}
	
	/**
	 * Set the active revision for this instance. The active
	 * revision is '0' by default, pointing to the most recent
	 * revision. Set another revision number to retrieve older
	 * versions of this pathway.
	 */
	public function setActiveRevision($revision) {
		if($this->revision != $revision) {
			$this->revision = $revision;
			$this->updateCache(); //Make sure the cache for this revision is up to date	
		}
	}
	
	/**
	 * Get the PathwayData object that contains the
	 * data stored in the GPML
	 */
	public function getPathwayData() {
		//Only create when asked for (performance)
		if(!$this->pwData) {
			$this->pwData = new PathwayData($this);
		}
		return $this->pwData;
	}
	
	/**
	 * Get the CategoryHandler object that handles
	 * categories for this pathway
	 */
	public function getCategoryHandler() {
		if(!$this->pwCategories) {
			$this->pwCategories = new CategoryHandler($this);
		}
		return $this->pwCategories;
	}
	
	/**
	 Convert a species code to a species name (e.g. Hs to Human)
	*/	
	public static function speciesFromCode($code) {
		if(!Pathway::$spCode2Name) {
			foreach(array_keys(Pathway::$spName2Code) as $name) {
				Pathway::$spCode2Name[Pathway::$spName2Code[$name]] = $name;
			}
		}
		return Pathway::$spCode2Name[$code];
	}
	
	public static function getAllPathways() {
		$allPathways = array();
		$dbr =& wfGetDB(DB_SLAVE);
		$ns = NS_PATHWAY;
		$query = "SELECT page_title FROM page
				WHERE page_namespace = $ns AND page_is_redirect = 0";
		$res = $dbr->query($query, __METHOD__);
		while( $row = $dbr->fetchRow( $res )) {
			try {
				$pathway = Pathway::newFromTitle($row[0]);
				$allPathways[
					strtolower($pathway->name()) . ':' . 
					strtolower($pathway->species())] = $pathway;
			} catch(Exception $e) {
				wfDebug(__METHOD__ . ": Unable to add pathway to list: $e");			
			}
		}
		$dbr->freeResult($res);
		ksort($allPathways);
		return $allPathways;
	}
	
	/**
	 Convert a species name to species code (e.g. Human to Hs)
	*/
	public static function codeFromSpecies($species) {
		return Pathway::$spName2Code[$species];
	}
	
	/**
	 Create a new Pathway from the given title
	 \param Title The full title of the pathway page (e.g. Pathway:Human:Apoptosis),
	 or the MediaWiki Title object
	*/
	public function newFromTitle($title, $checkCache = false) {
		if($title instanceof Title) {
			$title = $title->getFullText();
		}
		
		$name = Pathway::nameFromTitle($title);
		$species = Pathway::speciesFromTitle($title);
		$code = Pathway::$spName2Code[$species]; //Check whether this is a valid species
		if($name && $code) {
			return new Pathway($name, $species, $checkCache);
		} else {
			throw new Exception("Couldn't parse pathway article title: $title");
		}
	}
	
	/**
	 Create a new Pathway based on a filename 
	 \param Title The full title of the pathway file (e.g. Hs_Apoptosis.gpml),
	 or the MediaWiki Title object
	*/
	public function newFromFileTitle($title, $checkCache = false) {
		if($title instanceof Title) {
			$title = $title->getText();
		}
		//"Hs_testpathway.ext"
		if(ereg("^([A-Z][a-z])_(.+)\.[A-Za-z]{3,4}$", $title, $regs)) {
			$species = Pathway::speciesFromCode($regs[1]);
			$name = $regs[2];
		}
		if(!$name || !$species) throw new Exception("Couldn't parse file title: $title");
		return new Pathway($name, $species, $checkCache);
	}
	
	/**
	 * Get the full url to the pathway page
	*/
	public function getFullURL() {
		return $this->getTitleObject()->getFullURL();
	}
	
	/**
	 * Get the MediaWiki Title object for the pathway page
	 */
	public function getTitleObject() {
		//wfDebug("TITLE OBJECT:" . $this->species() . ":" . $this->name() . "\n");
		return Title::newFromText($this->species() . ':' . $this->name(), NS_PATHWAY);
	}
	
	/**
	 * Returns a list of species
	 */
	public static function getAvailableSpecies() {
		return array_keys(Pathway::$spName2Code);
	}

	/**
	 * Returns a list of categories, excluding species
	 */
	public static function getAvailableCategories() {
		return CategoryHandler::getAvailableCategories(false);
	}
	
	private static function nameFromTitle($title) {
		$parts = explode(':', $title);

		if(count($parts) < 2) {
			throw new Exception("Invalid pathway article title: $title");
		}
		return array_pop($parts);
	}

	private static function speciesFromTitle($title) {
		$parts = explode(':', $title);

		if(count($parts) < 2) {
			throw new Exception("Invalid pathway article title: $title");
		}
		$species = array_slice($parts, -2, 1);
		$species = array_pop($species);
		$species = str_replace('_', ' ', $species);
		return $species;
	}

	/**
	 * Get or set the pathway name (without namespace or species prefix)
	 * \param name changes the name to this value if not null
	 * \return the name of the pathway
	 */
	public function name($name = NULL) {
		if($name) {
			$this->pwName = $name;
		}
		return $this->pwName;
	}
	
	/**
	 * Get the pathway name (without namespace or species prefix)
	 */
	public function getName($textForm = true) {
		return Pathway::nameFromTitle($this->getTitleObject()->getText());
	}
	
	/**
	 * Get or set the pathway species
	 * \param species changes the species to this value if not null
	 * \return the species of the pathway
	 */
	public function species($species = NULL) {
		if($species) {
			$this->pwSpecies = $species;
		}
		return $this->pwSpecies;
	}
	
	/**
	 * Get the species code (abbrevated species name, e.g. Hs for Human)
	 */
	public function getSpeciesCode() {
		return Pathway::$spName2Code[$this->pwSpecies];
	}

	/**
	 * Check if this pathway exists in the database
	 * @return true if the pathway exists, false if not
	 */
	public function exists() {
		$title = $this->getTitleObject();
		return !is_null($title) && $title->exists();
	}
	
	/**
	 * Get the GPML code for this pathway (the active revision will be
	 * used, see Pathway::getActiveRevision)
	 */	 
	public function getGpml() {
		$gpmlTitle = $this->getTitleObject();
		$gpmlRef = Revision::newFromTitle($gpmlTitle, $this->revision);
		
		return $gpmlRef == NULL ? "no gpml" : $gpmlRef->getText();
	}

	/**
	 * Get the filename of a cached file following the naming conventions
	 * \param the file type to get the name for (one of the FILETYPE_* constants)
	 */
	public function getFileName($fileType) {
		return $this->getFileTitle($fileType)->getDBKey();
	}
	
	/**
	 * Gets the path that points to the cached file
	 * \param the file type to get the name for (one of the FILETYPE_* constants)
	 * \param whether to update the cache (if needed) or not
	 */
	public function getFileLocation($fileType, $updateCache = true) {
		if($updateCache) { //Make sure to have up to date version
			$this->updateCache($fileType);	
		}
		$fn = $this->getFileName($fileType);
		return wfLocalFile( $fn )->getPath();
	}
	
	/**
	 * Gets the url that points to the the cached file
	 * \param the file type to get the name for (one of the FILETYPE_* constants)
	 * \param whether to update the cache (if needed) or not
	 */
	public function getFileURL($fileType, $updateCache = true) {
		if($updateCache) {
			$this->updateCache($fileType);
		}
		return "http://" . $_SERVER['HTTP_HOST'] . Image::imageURL($this->getFileName($fileType));
	}
	
	/**
	 * Register a file type that can be exported to
	 * (needs to be supported by the GPML exporter
	 */
	public function registerFileType($fileType) {
		$this->fileTypes[$fileType] = $fileType;
	}
	
	/**
	 * Creates a MediaWiki title object that represents the article in the 
	 * NS_IMAGE namespace for cached file of given file type. 
	 * There is no guarantee that an article exists for each filetype.
	 * Currently articles exist for FILETYPE_IMG (.svg articles in the NS_IMAGE namespace)
	 */
	public function getFileTitle($fileType) {
		$prefix = $this->getFilePrefix();
		//Append revision number if it's not the most recent
		if($this->revision) {
			$rev_stuffix = "_" . $this->revision;
		}
		$title = Title::newFromText( "{$prefix}{$rev_stuffix}." . $fileType, NS_IMAGE );
		if(!$title) {
			throw new Exception("Invalid file title for pathway " + $fileName);
		}
		return $title;
	}

	/**
	 * Get the title object for the image page.
	 * Equivalent to <code>getFileTitle(FILETYPE_IMG)</code>
	 */
	public function getImageTitle() {
		return $this->getFileTitle(FILETYPE_IMG);
	}
	
	/**
	 * Get the prefix part of the filename, with all illegal characters
	 * filtered out (e.g. Hs_Apoptosis for Human:Apoptosis)
	 */
	public function getFilePrefix() {
		$prefix = $this->getSpeciesCode() . "_" . $this->pwName;
		/*
		 * Filter out illegal characters, and try to make a legible name
		 * out of it. We'll strip some silently that Title would die on.
		 */
		$filtered = preg_replace ( "/[^".Title::legalChars()."]|:/", '-', $prefix );
		$title = Title::newFromText( $filtered, NS_IMAGE );
		if(!$title) {
			throw new Exception("Invalid file title for pathway " + $fileName);
		}
		return $title->getDBKey();
	}
	
	/**
	 * Get first revision for current title
	 */
	public function getFirstRevision() {
		if(!$this->firstRevision) {
			$revs = Revision::fetchAllRevisions($this->getTitleObject());
			$revs->seek($revs->numRows() - 1);
			$row = $revs->fetchRow();
			$this->firstRevision = Revision::newFromId($row['rev_id']);
		}
		return $this->firstRevision;
	}
	
	/**
	 * Get revision id for the last revision prior to specified datae.
	 * This is useful for generating statistics over the history of the archive. 
	 */
	public function getLastRevisionPriorToDate($timestamp) {
		$revs =  Revision::fetchAllRevisions($this->getTitleObject());
		foreach($revs as $eachRev){
			$revTime = $eachRev->rev_timestamp;
			print "$revTime\n";
			if ($revTime < $timestamp){
				return $eachRev;
			}
		}
		return NULL;
	}

	/**
	 * Update the pathway with the given GPML code
	 * \param gpmlData The GPML code that contains the updated pathway data
	 * \param description A description of the changes
	 */
	public function updatePathway($gpmlData, $description) {
		global $wgLoadBalancer, $wgUser;
		
		//First validate the gpml
		if($error = self::validateGpml($gpmlData)) {
			throw new Exception($error);
		}
		
		$gpmlTitle = $this->getTitleObject();
		
		//Check permissions
		if(is_null($wgUser) || !$wgUser->isLoggedIn()) {
			throw new Exception("User is not logged in");
		}
		if($wgUser->isBlocked()) {
			throw new Exception("User is blocked");
		}
		if(!$gpmlTitle->userCanEdit()) {
			throw new Exception("User has wrong permissions to edit the pathway");
		}
		if(wfReadOnly()) {
			throw new Exception("Database is read-only");
		}
		
		$gpmlArticle = new Article($gpmlTitle, 0);	//Force update from the newest version
		if(!$gpmlTitle->exists()) {
			//This is a new pathway, add the author to the watch list
			$gpmlArticle->doWatch();
		}

		$succ = true;
		$succ =  $gpmlArticle->doEdit($gpmlData, $description);
		if($succ) {
			$wgLoadBalancer->commitAll();
		
			//Update category links
			$this->updateCategories();
			//Update cache
			$this->updateCache();

			//Calculate number of unique genes for given species
			// and update file with stored values
			StatisticsCache::updateUniqueGenesCache ($this->speciesFromTitle($gpmlTitle->getFullText()));

		} else {
			throw new Exception("Unable to save GPML, are you logged in?");
		}
		return $succ;
	}

	/**
	 * Validates the GPML code and returns the error if it's invalid
	 * @return <code>null</code> if the GPML is valid, the error if it's invalid
	 **/
	static function validateGpml($gpml) {
		$return = null;
		$xml = DOMDocument::loadXML($gpml);
		if(!$xml) {
			return "Error: no valid XML provided\n$gpml";
		}
		if(!$xml->schemaValidate(WPI_SCRIPT_PATH . "/bin/GPML.xsd")) {
			$error = libxml_get_last_error();
			$return  = $gpml[$error->line - 1] . "\n";
			$return .= str_repeat('-', $error->column) . "^\n";

			switch ($error->level) {
				case LIBXML_ERR_WARNING:
				    $return .= "Warning $error->code: ";
				    break;
				 case LIBXML_ERR_ERROR:
				    $return .= "Error $error->code: ";
				    break;
				case LIBXML_ERR_FATAL:
				    $return .= "Fatal Error $error->code: ";
				    break;
			}

			$return .= trim($error->message) .
				       "\n  Line: $error->line" .
				       "\n  Column: $error->column";

			if ($error->file) {
				$return .= "\n  File: $error->file";
			}
		}
		return $return;
	}

	/**
	 * Revert this pathway to an old revision
	 * \param oldId The id of the old revision to revert the pathway to
	 */
	public function revert($oldId) {
		global $wgUser, $wgLang;
		$rev = Revision::newFromId($oldId);
		$gpml = $rev->getText();
		if($gpml) {
			$usr = $wgUser->getSkin()->userLink($wgUser->getId(), $wgUser->getName());
			$date = $wgLang->timeanddate( $rev->getTimestamp(), true );
			$this->updatePathway($gpml, "Reverted to version '$date' by $usr");
		} else {
			throw new Exception("Unable to get gpml content");
		}
	}
		
	/**
	 * Delete this pathway (MediaWiki pages and cache)
	 */
	public function delete() {
		global $wgLoadBalancer;
		wfDebug("Deleting pathway" . $this->getTitleObject()->getFullText() . "\n");
		$reason = 'Deleted pathway';
		$title = $this->getTitleObject();
		Pathway::deleteArticle($title, $reason);
		//Clean up SVG page
		$this->clearCache(null, true);
		$wgLoadBalancer->commitAll();
	}

	private function deleteImagePage($reason) {
		global $wgLoadBalancer;
		$title = $this->getFileTitle(FILETYPE_IMG);
		Pathway::deleteArticle($title, $reason);
		$img = new Image($title);
		$img->delete($reason);
		$wgLoadBalancer->commitAll();
	}

	/**
	 * Delete a MediaWiki article
	 */
	public static function deleteArticle($title, $reason='not specified') {
		global $wgUser, $wgLoadBalancer;
		
		$article = new Article($title);
		
		if (wfRunHooks('ArticleDelete', array(&$this, &$wgUser, &$reason))) {
			$article->doDeleteArticle($reason);
			$wgLoadBalancer->commitAll();
			wfRunHooks('ArticleDeleteComplete', array(&$this, &$wgUser, $reason));
		}
	}
	
	/**
	 * Updates the MediaWiki category links for this pathway to match
	 * the categories stored in the GPML
	 */
	public function updateCategories() {
		$this->getCategoryHandler()->setGpmlCategories();
	}
			
	/**
	 * Checks whether the cached files are up-to-data and updates them
	 * if neccesary
	 * \param fileType The file type to check the cache for (one of FILETYPE_* constants)
	 * or null to check all files
	 */
	public function updateCache($fileType = null) {
		wfDebug("updateCache called for filetype $fileType\n");
		if(!$fileType) { //Update all
			foreach($this->fileTypes as $type) {
				$this->updateCache($type);
			}
			return;
		}
		if($this->isOutOfDate($fileType)) {
			wfDebug("\t->Updating cached file for $fileType\n");
			switch($fileType) {
			case FILETYPE_PNG:
				$this->savePngCache();
				break;
			case FILETYPE_GPML:
				$this->saveGpmlCache();
				break;
			case FILETYPE_IMG:
				$this->saveImageCache();
				break;
			default:
				$this->saveConvertedCache($fileType);
				break;
			}
		}
	}
	
	/**
	 * Clear all cached files
	 * \param fileType The file type to remove the cache for (one of FILETYPE_* constants)
	 * or null to remove all files
	 * \param forceImagePage If true, the MediaWiki image article for this pathway will
	 * also be removed
	 */
	public function clearCache($fileType = null, $forceImagePage=false) {
		if($forceImagePage) { //Only delete the image file when explicitly asked for!
			$this->deleteImagePage("Clearing cache");
		}
		if(!$fileType) { //Update all
			$this->clearCache(FILETYPE_PNG);
			$this->clearCache(FILETYPE_GPML);
		} else {
			$file = $this->getFileLocation($fileType, false);
			if(file_exists($file)) {
				unlink($file); //Delete the cached file
			}
		}
	}

	//Check if the cached version of the GPML data derived file is out of date
	private function isOutOfDate($fileType) {		
		wfDebug("isOutOfDate for $fileType\n");

		//Special treatment for svg, check if image page exists
		if($fileType == FILETYPE_IMG) {
			$imgTitle = $this->getFileTitle(FILETYPE_IMG);
			$article = new Article($imgTitle);
			//Return false if image isn't uploaded,
			//Else continue with file date check
			if(!$article->exists()) return true;	
		}
			
		$gpmlTitle = $this->getTitleObject();
		$gpmlRev = Revision::newFromTitle($gpmlTitle);
		if($gpmlRev) {
			$gpmlDate = $gpmlRev->getTimestamp();
		} else {
			$gpmlDate = -1;
		}
		
		$file = $this->getFileLocation($fileType, false);

		if(file_exists($file)) {
			$fmt = wfTimestamp(TS_MW, filemtime($file));
			wfDebug("\tFile exists, cache: $fmt, gpml: $gpmlDate\n");
			return  $fmt < $gpmlDate;
		} else { //No cached version yet, so definitely out of date
			wfDebug("\tFile doesn't exist\n");
			return true;
		}
	}
	
	public function getGpmlModificationTime() {
		$gpmlTitle = $this->getTitleObject();
		$gpmlRev = Revision::newFromTitle($gpmlTitle);
		if($gpmlRev) {
			$gpmlDate = $gpmlRev->getTimestamp();
		} else {
			throw new Exception("No GPML page");
		}
		return $gpmlDate;
	}

	/**
	 * Save a cached version of a filetype to be converted
	 * from GPML
	 */
	private function saveConvertedCache($fileType) {
		# Convert gpml to fileType
		$gpmlFile = realpath($this->getFileLocation(FILETYPE_GPML));
		$conFile = $this->getFileLocation($fileType, false);
		$dir = dirname($conFile);
		if ( !is_dir( $dir ) ) wfMkdirParents( $dir );
		self::convert($gpmlFile, $conFile);
		return $conFile;
	}
		
	/**
	 * Convert the given GPML file to another
	 * file format. The file format will be determined by the
	 * output file extension.
	 */
	public static function convert($gpmlFile, $outFile) {
		$gpmlFile = realpath($gpmlFile);
		
		$basePath = WPI_SCRIPT_PATH;
		$cmd = "java -jar $basePath/bin/pathvisio_core.jar '$gpmlFile' '$outFile' 2>&1";
		wfDebug("CONVERTER: $cmd\n");
		exec($cmd, $output, $status);
		
		foreach ($output as $line) {
			$msg .= $line . "\n";
		}
		if($status != 0 ) {
			throw new Exception("Unable to convert to $outFile:\nStatus:$status\nMessage:$msg");
		}
		return true;
	} 
	
	private function saveImageCache() {
		$file = $this->getFileLocation(FILETYPE_GPML);
		$this->saveImage($file, "Updated SVG cache");
	}
	
	/**
	 * Saves the pathway image (based on the given GPML file) 
	 * and uploads it to the MediaWiki image page
	 */
	private function saveImage($gpmlFile, $description) {
		$imgName = $this->getFileName(FILETYPE_IMG);
		# Convert gpml to svg
		$gpmlFile = realpath($gpmlFile);
		$imgFile = WPI_TMP_PATH . "/" . $imgName;
		
		self::convert($gpmlFile, $imgFile);
		# Upload svg file to wiki
		return Pathway::saveFileToWiki($imgFile, $imgName, $description);
	}
	
	private function saveGpmlCache() {
		$gpml = $this->getGpml();
		$file = $this->getFileLocation(FILETYPE_GPML, false);
		writeFile($file, $gpml);
	}
	
	private function savePngCache() {
		global $wgSVGConverters, $wgSVGConverter, $wgSVGConverterPath;
		
		$input = $this->getFileLocation(FILETYPE_IMG);
		$output = $this->getFileLocation(FILETYPE_PNG, false);
		
		$width = 1000;
		$retval = 0;
		if(isset($wgSVGConverters[$wgSVGConverter])) {
			$cmd = str_replace( //TODO: calculate proper height for rsvg
				array( '$path/', '$width', '$input', '$output' ),
				array( $wgSVGConverterPath ? wfEscapeShellArg( "$wgSVGConverterPath/" ) : "",
				intval( $width ),
				wfEscapeShellArg( $input ),
				wfEscapeShellArg( $output ) ),
				$wgSVGConverters[$wgSVGConverter] ) . " 2>&1";
			$err = wfShellExec( $cmd, $retval );
			if($retval != 0 || !file_exists($output)) {
				throw new Exception("Unable to convert to png: $err\nCommand: $cmd");
				
			}
		} else {
			throw new Exception("Unable to convert to png, no SVG rasterizer found");
		}
		$ex = file_exists($output);
		wfDebug("PNG CACHE SAVED: $output, $ex;\n");
	}
	
	## Based on SpecialUploadForm.php
	## Assumes $saveName is already checked to be a valid Title
	//TODO: run hooks
	static function saveFileToWiki( $fileName, $saveName, $description ) {
		global $wgLoadBalancer, $wgUser, $wgParser;
		
		wfDebug("========= UPLOADING FILE FOR WIKIPATHWAYS ==========\n");
		wfDebug("=== IN: $fileName\n=== OUT: $saveName\n");

		$oldTitle = $wgParser->mTitle;
		
		# Check blocks
		if( $wgUser->isBlocked() ) {
			throw new Exception( "User is blocked" );
		}

		if( wfReadOnly() ) {
			throw new Exception( "Page is read-only" );
		}
		
		$localFile = wfLocalFile($saveName);
		$localFile->upload($fileName, $description, "");
/*
		# Move the file to the proper directory
		$dest = wfLocalFile( $saveName )->getPath();
		$archive = wfImageArchiveDir( $saveName );
		if ( !is_dir( $dest ) ) wfMkdirParents( $dest );
		if ( !is_dir( $archive ) ) wfMkdirParents( $archive );

		$toFile = $dest;
		if( is_file( $toFile) ) {
			$oldVersion = gmdate( 'YmdHis' ) . "!{$saveName}";
			$success = rename($toFile, "{$archive}/{$oldVersion}");
			if(!$success) {
				throw new Exception( 
					"Unable to rename file $olddVersion to {$archive}/{$oldVersion}" );
			}
		}
		$success = rename($fileName, $toFile);
		if(!$success) {
			throw new Exception( "Unable to rename file $fileName to $toFile" );
		}
		chmod($toFile, 0644);
		
		# Update the image page
		$img = Image::newFromName( $saveName );
		
		$success = Pathway::recordUpload( $img, $oldVersion,
			                           $description,
			                           wfMsgHtml( 'license' ),
			                           "", //Copyright
			                           $fileName,
			                           FALSE ); //Watchthis
	                    
		if(!$success) {
			throw new Exception( "Couldn't create description page" );
		}

		$wgLoadBalancer->commitAll();

		//Dirty hack: set wgParser title back to original after uploading image,
		//because mediawiki sets it to the image page
		$wgParser->mTitle = $oldTitle;
		
		return $toFile; # return the saved file
		*/
	}
	
	/**
	 * Record an image upload in the upload log and the image table
	 * MODIFIED FROM Image.php
	 * Because the original method redirected to the image page
	 */
	function recordUpload( $img, $oldver, $desc, $license = '', $copyStatus = '', $source = '', $watch = false ) {
		global $wgUser, $wgUseCopyrightUpload;

		$dbw =& wfGetDB( DB_MASTER );

		$img->checkDBSchema($dbw);

		// Delete thumbnails and refresh the metadata cache
		$img->purgeCache();

		// Fail now if the image isn't there
		if ( !$img->fileExists || $img->fromSharedDirectory ) {
			wfDebug( "Image::recordUpload: File ".$img->imagePath." went missing!\n" );
			return false;
		}

		if ( $wgUseCopyrightUpload ) {
			if ( $license != '' ) {
				$licensetxt = '== ' . wfMsgForContent( 'license' ) . " ==\n" . '{{' . $license . '}}' . "\n";
			}
			$textdesc = '== ' . wfMsg ( 'filedesc' ) . " ==\n" . $desc . "\n" .
			  '== ' . wfMsgForContent ( 'filestatus' ) . " ==\n" . $copyStatus . "\n" .
			  "$licensetxt" .
			  '== ' . wfMsgForContent ( 'filesource' ) . " ==\n" . $source ;
		} else {
			if ( $license != '' ) {
				$filedesc = $desc == '' ? '' : '== ' . wfMsg ( 'filedesc' ) . " ==\n" . $desc . "\n";
				 $textdesc = $filedesc .
					 '== ' . wfMsgForContent ( 'license' ) . " ==\n" . '{{' . $license . '}}' . "\n";
			} else {
				$textdesc = $desc;
			}
		}

		$now = $dbw->timestamp();

		#split mime type
		if (strpos($img->mime,'/')!==false) {
			list($major,$minor)= explode('/',$img->mime,2);
		}
		else {
			$major= $img->mime;
			$minor= "unknown";
		}

		# Test to see if the row exists using INSERT IGNORE
		# This avoids race conditions by locking the row until the commit, and also
		# doesn't deadlock. SELECT FOR UPDATE causes a deadlock for every race condition.
		$dbw->insert( 'image',
			array(
				'img_name' => $img->name,
				'img_size'=> $img->size,
				'img_width' => intval( $img->width ),
				'img_height' => intval( $img->height ),
				'img_bits' => $img->bits,
				'img_media_type' => $img->type,
				'img_major_mime' => $major,
				'img_minor_mime' => $minor,
				'img_timestamp' => $now,
				'img_description' => $desc,
				'img_user' => $wgUser->getID(),
				'img_user_text' => $wgUser->getName(),
				'img_metadata' => $img->metadata,
			),
			__METHOD__,
			'IGNORE'
		);

		if( $dbw->affectedRows() == 0 ) {
			# Collision, this is an update of an image
			# Insert previous contents into oldimage
			$dbw->insertSelect( 'oldimage', 'image',
				array(
					'oi_name' => 'img_name',
					'oi_archive_name' => $dbw->addQuotes( $oldver ),
					'oi_size' => 'img_size',
					'oi_width' => 'img_width',
					'oi_height' => 'img_height',
					'oi_bits' => 'img_bits',
					'oi_timestamp' => 'img_timestamp',
					'oi_description' => 'img_description',
					'oi_user' => 'img_user',
					'oi_user_text' => 'img_user_text',
				), array( 'img_name' => $img->name ), __METHOD__
			);

			# Update the current image row
			$dbw->update( 'image',
				array( /* SET */
					'img_size' => $img->size,
					'img_width' => intval( $img->width ),
					'img_height' => intval( $img->height ),
					'img_bits' => $img->bits,
					'img_media_type' => $img->type,
					'img_major_mime' => $major,
					'img_minor_mime' => $minor,
					'img_timestamp' => $now,
					'img_description' => $desc,
					'img_user' => $wgUser->getID(),
					'img_user_text' => $wgUser->getName(),
					'img_metadata' => $img->metadata,
				), array( /* WHERE */
					'img_name' => $img->name
				), __METHOD__
			);
		} else {
			# This is a new image
			# Update the image count
			$site_stats = $dbw->tableName( 'site_stats' );
			$dbw->query( "UPDATE $site_stats SET ss_images=ss_images+1", __METHOD__ );
		}

		$descTitle = $img->getTitle();
		$article = new Article( $descTitle );
		$minor = false;
		$watch = $watch || $wgUser->isWatched( $descTitle );
		$suppressRC = true; // There's already a log entry, so don't double the RC load

		if( $descTitle->exists() ) {
			// TODO: insert a null revision into the page history for this update.
			if( $watch ) {
				$wgUser->addWatch( $descTitle );
			}

			# Invalidate the cache for the description page
			$descTitle->invalidateCache();
			$descTitle->purgeSquid();
		} else {
			// New image; create the description page.
			//CHANGED: don't use insertNewArticle, this redirects
			//Use $article->doEdit
			//$article->insertNewArticle( $textdesc, $desc, $minor, $watch, $suppressRC );
			$flags = EDIT_NEW | EDIT_FORCE_BOT;
			$article->doEdit( $textdesc, $desc, $flags );
		}

		# Add the log entry
		$log = new LogPage( 'upload' );
		$log->addEntry( 'upload', $descTitle, $desc );

		# Commit the transaction now, in case something goes wrong later
		# The most important thing is that images don't get lost, especially archives
		$dbw->immediateCommit();

		# Invalidate cache for all pages using this image
		$update = new HTMLCacheUpdate( $img->getTitle(), 'imagelinks' );
		$update->doUpdate();

		return true;
	}
	
}

?>
