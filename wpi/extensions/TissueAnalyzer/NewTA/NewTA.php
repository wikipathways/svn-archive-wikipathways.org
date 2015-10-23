<?php
# Not a valid entry point, skip unless MEDIAWIKI is defined
if (!defined('MEDIAWIKI')) {
        echo <<<EOT
To install this special page, put the following line in LocalSettings.php:
require_once( "$IP/extensions/TissueAnalyzer/NewTA/NewTA.php" );
EOT;
        exit( 1 );
}

$wgAutoloadClasses['NewTA'] = dirname(__FILE__) . '/NewTA_body.php';
$wgSpecialPages['NewTA'] = 'NewTA';
$wgHooks['LoadAllMessages'][] = 'NewTA::loadMessages';

?>
