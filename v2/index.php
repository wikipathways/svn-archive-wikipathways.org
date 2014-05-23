<?php
$requestURI = explode('/', $_SERVER['REQUEST_URI']);
$scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
$acceptedContentTypes = explode(',',$_SERVER['HTTP_ACCEPT']);

for($i= 0;$i < sizeof($scriptName);$i++)
        {
      if ($requestURI[$i]     == $scriptName[$i])
              {
                unset($requestURI[$i]);
            }
      }
 
$command = array_values($requestURI);
$finalCommand = end($command);
switch($command[0])
      {
 
      case 'pathways' :
		if ($finalCommand == '.json' || $finalCommand == '.jsonld' || in_array("application/json", $acceptedContentTypes) || in_array("application/ld+json", $acceptedContentTypes)) {
			$pathway = file_get_contents('https://wikipathways.firebaseio.com/pathways/'.$command[1].'/.json');
			header('Content-Type: application/json');
			echo $pathway;
		} else if ($finalCommand == '.gpml' || in_array("application/xml", $acceptedContentTypes) || in_array("application/gpml+xml", $acceptedContentTypes)) {
			$pathway = file_get_contents('http://www.wikipathways.org//wpi/wpi.php?action=downloadFile&type=gpml&pwTitle=Pathway:'.$command[1].'&oldid=0');
			header('Content-Type: application/xml');
			echo $pathway;
		} else {
			$pathway = file_get_contents('http://test2.wikipathways.org/index.php/Pathway:'.$command[1]);
			//$pathway = file_get_contents('http://test2.wikipathways.org/index.php/Pathway:'.$command[1].'&oldid=0');
			header('Content-Type: text/html');
			echo $pathway;
		}
                break;
 
      case 'commandTwo' :
                echo 'You entered command: '.$command[0];
                break;
 
      default:
                echo 'That command does not exist.';
                  break;
      }
?>
