<?php
# Not a valid entry point, skip unless MEDIAWIKI is defined
if (!defined('MEDIAWIKI')) {
        echo <<<EOT
To install this special page, put the following line in LocalSettings.php:
require_once( "$IP/extensions/PathwayFinder/PathwayFinder.php" );
EOT;
        exit( 1 );
}

$wgAutoloadClasses['PathwayFinder'] = dirname(__FILE__) . '/PathwayFinder_body.php';
$wgSpecialPages['PathwayFinder'] = 'PathwayFinder';
$wgHooks['LoadAllMessages'][] = 'PathwayFinder::loadMessages';

?>
