<?php
# Alert the user that this is not a valid entry point to MediaWiki if they try to access the special pages file directly.
if (!defined('MEDIAWIKI')) {
        echo <<<EOT
To install my extension, put the following line in LocalSettings.php:
require_once( "\$IP/extensions/MyExtension/MyExtension.php" );
EOT;
        exit( 1 );
}

$wgExtensionCredits['specialpage'][] = array(
	'name' => 'MyExtension',
	'author' => 'My name',
	'url' => 'http://www.mediawiki.org/wiki/Extension:MyExtension',
	'description' => 'Default description message',
	'descriptionmsg' => 'myextension-desc',
	'version' => '0.0.0',
);

$dir = dirname(__FILE__) . '/';

$wgAutoloadClasses['ontologyindex'] = $dir . 'ontologyindex_body.php'; # Tell MediaWiki to load the extension body.
$wgExtensionMessagesFiles['ontologyindex'] = $dir . 'ontologyindex.i18n.php';
$wgExtensionAliasesFiles['ontologyindex'] = $dir . 'ontologyindex.alias.php';
$wgSpecialPages['ontologyindex'] = 'ontologyindex'; # Let MediaWiki know about your new special page.
?>