<?php

require_once("Maintenance.php");

$dbr =& wfGetDB(DB_SLAVE);
$res = $dbr->select("user", array("user_id"));
while($row = $dbr->fetchRow($res)) {
	try {
		$user = User::newFromId($row[0]);
		echo "Processing user: " . $user->getName() . "<br>\n";
		
		$userPageTitle = $user->getUserPage();
		$userTalkTitle = $user->getTalkPage();
		
		if(!$userPageTitle->exists()) {
			echo "\tNo user page, creating from template<br>\n";
			if($doit) {
				$tempCall = "{{subst:Template:UserPage|{$user->getName()}|{$user->getRealName()}}}";

				$userPage = new Article($userPageTitle, 0);
				$succ = true;
				$succ =  $userPage->doEdit($tempCall, "Initial user page");
				if($succ) {
					$wgLoadBalancer->commitAll();
				}
			}
		}
		if(!$userTalkTitle->exists()) {
			echo "\tNo user talk page, creating from template<br>\n";
			if($doit) {
				$tempCall = "{{subst:Template:TalkPage|{$user->getName()}}}";

				$userPage = new Article($userTalkTitle, 0);
				$succ = true;
				$succ =  $userPage->doEdit($tempCall, "Initial user page");
				if($succ) {
					$wgLoadBalancer->commitAll();
				}
			}
		}
	} catch(Exception $e) {
		echo "Exception: {$e->getMessage()}<BR>\n";
	}
}

?>