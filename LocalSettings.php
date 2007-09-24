<?php

# This file was automatically generated by the MediaWiki installer.
# If you make manual changes, please keep track in case you need to
# recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.

# If you customize your file layout, set $IP to the directory that contains
# the other MediaWiki files. It will be used as a base to locate files.
if( defined( 'MW_INSTALL_PATH' ) ) {
	$IP = MW_INSTALL_PATH;
} else {
	$IP = dirname( __FILE__ );
}

$path = array( $IP, "$IP/includes", "$IP/languages" );
set_include_path( implode( PATH_SEPARATOR, $path ) . PATH_SEPARATOR . get_include_path() );

require_once( "includes/DefaultSettings.php" );

# If PHP's memory limit is very low, some operations may fail.
ini_set( 'memory_limit', '20M' );

if ( $wgCommandLineMode ) {
	if ( isset( $_SERVER ) && array_key_exists( 'REQUEST_METHOD', $_SERVER ) ) {
		die( "This script must be run from the command line\n" );
	}
} elseif ( empty( $wgNoOutputBuffer ) ) {
	## Compress output if the browser supports it
	if( !ini_get( 'zlib.output_compression' ) ) @ob_start( 'ob_gzhandler' );
}

$wgSitename         = "WikiPathways";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
$wgScriptPath       = '';

## For more information on customizing the URLs please see:
## http://www.mediawiki.org/wiki/Manual:Short_URL

$wgEnableEmail      = true;
$wgEnableUserEmail  = true;

$wgEmergencyContact = "webmaster@localhost";
$wgPasswordSender = "webmaster@localhost";

## For a detailed description of the following switches see
## http://meta.wikimedia.org/Enotif and http://meta.wikimedia.org/Eauthent
## There are many more options for fine tuning available see
## /includes/DefaultSettings.php
## UPO means: this is also a user preference option
$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO
$wgEmailAuthentication = true;

$wgDBtype           = "mysql";
$wgDBserver         = "localhost";
$wgDBport           = "5432";
$wgDBprefix         = "";

# Load passwords/usernames
require('pass.php');

# Schemas for Postgres
$wgDBmwschema       = "mediawiki";
$wgDBts2schema      = "public";

# Experimental charset support for MySQL 4.1/5.0.
$wgDBmysql5 = false;

## Shared memory settings
$wgMainCacheType = CACHE_NONE;
$wgMemCachedServers = array();

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads       = true;

##Extensions
$wgUseImageResize      = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

## If you want to use image uploads under safe mode,
## create the directories images/archive, images/thumb and
## images/temp, and make them all writable. Then uncomment
## this, if it's not already uncommented:
# $wgHashedUploadDirectory = false;

## If you have the appropriate support software installed
## you can enable inline LaTeX equations:
$wgUseTeX           = false;

$wgLocalInterwiki   = $wgSitename;

$wgLanguageCode = "en";

$wgProxyKey = "b748562511ea57982358c30cec614e30b52b75119e3df78ac554eec5f69343cf";

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'standard', 'nostalgia', 'cologneblue', 'monobook':
$wgDefaultSkin = 'wikipathways';

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
# $wgEnableCreativeCommonsRdf = true;
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "http://creativecommons.org/licenses/by-nc-sa/3.0/";
$wgRightsText = "a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 License";
$wgRightsIcon = "http://creativecommons.org/images/public/somerights20.png";
# $wgRightsCode = ""; # Not yet used

$wgDiff3 = "/usr/bin/diff3";

# When you make changes to this configuration file, this will make
# sure that cached pages are cleared.
$configdate = gmdate( 'YmdHis', @filemtime( __FILE__ ) );
$wgCacheEpoch = max( $wgCacheEpoch, $configdate );

$wgGroupPermissions['user']['edit'] = true;

$wgGroupPermissions['*'    ]['createaccount']   = true;
$wgGroupPermissions['*'    ]['read']            = true;
$wgGroupPermissions['*'    ]['edit']            = false;
$wgGroupPermissions['*'    ]['createpage']      = false;
$wgGroupPermissions['*'    ]['createtalk']      = true;

#Non-defaults:

#Allow slow parser functions ({{PAGESINNS:ns}})
$wgAllowSlowParserFunctions = true;

#Logo
$wgLogo = "http://www.wikipathways.org/skins/common/images/earth-or-pathway_text2_beta.png";

#Allow gpml extension and larger image files
$wgFileExtensions = array( 'png', 'gif', 'jpg', 'jpeg', 'svg', 'gpml', 'mapp');
$wgUploadSizeWarning = 1024 * 1024 * 5;

## Better SVG converter
/** Pick one of the above */
$wgSVGConverter = 'inkscape';
/** If not in the executable PATH, specify */
#$wgSVGConverterPath = '/var/www/wikipathways/wpi/bin/batik';
$wgSVGConverters['inkscape'] = '$path/inkscape -z -b white -w $width -f $input -e $output';

##$wgMimeDetectorCommand = "file -bi"; #This doesn't work for svg!!!
##$wgCheckFileExtensions = false;

##Pathway namespace
define("NS_PATHWAY", 102); //NS_PATHWAY is same as NS_GPML since refactoring
define("NS_PATHWAY_TALK", 103);
define("NS_GPML", 102);
define("NS_GPML_TALK", 103);

$wgExtraNamespaces =
	array(	NS_PATHWAY => "Pathway", NS_PATHWAY_TALK => "Pathway_Talk",
			100 => "Pw_Old", 101 => "Pw_Old_Talk"); //Old namespace
$wgNamespacesToBeSearchedDefault += 
	array( 	NS_PATHWAY => true, NS_PATHWAY_TALK => true,
			100 => false, 100 => false); //Old namespace
$wgContentNamespaces += array(NS_PATHWAY, NS_PATHWAY_TALK);

##Debug
$wgDebugLogFile = '/var/www/wikipathways/wpi/tmp/wikipathwaysdebug.txt';
//$wgProfiling = true; //Set to true for debugging info

##Extensions
require_once('extensions/analytics.php'); //Google Analytics support
require_once('extensions/inputbox.php');
require_once('extensions/ParserFunctions.php');
//require_once('wpi/extensions/redirectImage.php'); //Redirect all image pages to file
require_once('wpi/extensions/PathwayOfTheDay.php');
require_once('wpi/extensions/siteStats.php');
require_once('wpi/extensions/pathwayInfo.php');
require_once('wpi/extensions/imageSize.php');
require_once('wpi/extensions/magicWords.php');
require_once('wpi/extensions/PopularPathwaysPage2/PopularPathwaysPage.php');
require_once('wpi/extensions/MostEditedPathwaysPage/MostEditedPathwaysPage.php');
require_once('wpi/extensions/NewPathwaysPage/NewPathwaysPage.php');
require_once('wpi/extensions/CreatePathwayPage/CreatePathwayPage.php');
require_once('wpi/extensions/pathwayHistory.php');
require_once('wpi/extensions/DynamicPageList2.php');
require_once('wpi/extensions/LabeledSectionTransclusion/compat.php');
require_once('wpi/extensions/LabeledSectionTransclusion/lst.php');
require_once('wpi/extensions/LabeledSectionTransclusion/lsth.php');
require_once('wpi/extensions/googleSearch.php');
require_once('wpi/extensions/button.php');
require_once('wpi/extensions/pathwayThumb.php');
require_once('wpi/extensions/BrowsePathwaysPage2/BrowsePathwaysPage.php');
require_once('wpi/extensions/editApplet.php');
require_once('wpi/extensions/listPathways.php');
require_once('wpi/extensions/movePathway.php');
require_once('wpi/batchDownload.php');
require_once('wpi/PathwayPage.php');

/* Biblio extension
Isbndb account: thomas.kelder@bigcat.unimaas.nl / BigC0w~wiki
*/
$isbndb_access_key = 'BR5539IJ'; 
require_once('extensions/Biblio.php');

/*
################################################################
# PageProtection extension
set_include_path(get_include_path() . PATH_SEPARATOR . realpath('extensions/includes'));
require_once("extensions/ExtensionFunctions.php");

$wgCachePages   = false;
$wgCacheEpoch   = 'date +%Y%m%d%H%M%S';
$wgPEMsize      = 64;                 //default key size
$wgPEMlite_size = 64;                  //lite key size
$wgPEMdir       = '/var/www/wikipathways/extensions/PPP/key';  //storage for keys
$wgPEMfile      = 'default.pem';        //default key's filename
$wgPEMlite_file = 'lite.pem';           //lite key's filename

$wgPEMold       = 'private.pem';        //old key's pathname (optional)
                                        //if you've been using PageProtection
# activate PageProtection extension
require_once('extensions/PPP/PageProtectionPlus.php');
*/
#
################################################################


##Cascading Style Sheets
#Default is {$wgScriptPath}/skins

$wgShowExceptionDetails = true;
$wgShowSQLErrors = true;

?>
