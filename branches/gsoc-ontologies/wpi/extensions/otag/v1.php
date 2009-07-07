<?php
//require_once('../../wpi.php');
//
//
//
//		$pathway = Pathway::newFromTitle("WP15");
//		//$data = $pathway->getPathwayData();
//		$gpml = $pathway->getGpml();
//
        echo "======================== <br>";
$gpml = <<<gpm
<?xml version="1.0" encoding="ISO-8859-1"?>
<Pathway xmlns="http://genmapp.org/GPML/2008a" Name="blah" Version="20090610" Organism="Homo sapiens">
  <Graphics BoardWidth="6120.95" BoardHeight="2970.0" WindowWidth="18000.0" WindowHeight="12000.0" />
  <Shape Type="Rectangle" Style="Solid" GraphId="fd201">
    <Graphics FillColor="Transparent" Color="000000" CenterX="4934.75" CenterY="2294.75" Width="1259.5" Height="810.5" ZOrder="16384" Rotation="0.0" />
  </Shape>
  <InfoBox CenterX="0.0" CenterY="0.0" />
</Pathway>
gpm;
        echo $gpml;
// load XML, create XPath object
       $dom = DOMDocument::loadXML($gpml);
        $root = $dom->document_element(); 
        print_r($root);
       $xpath = new DOMXPath($dom);

// get node eva, which we will append to
print_r($dom);
$eva = $xpath->query('Pathway/Graphics/')->item(0);
print_r($eva);



//       $dom = DOMDocument::loadXML($gpml);
//echo $doc->saveXML();
//$root = $dom->document_element();
//echo $root->get_attribute('Name'); // en



/**
str_replace("d7cfe","blah",$gpml);
echo "=================";
		$tag = $xml->addChild("Attribute", "");
        $tag->addAttribute("key","WikiPathways-ontologies");
        $tag->addAttribute("value","bioluminescence||GO:0008218||Gene Ontology");

        echo $xml->asXML();
        //$pathway1 = Pathway::newFromTitle("WP10");
		//$data = $pathway->getPathwayData();
		//print_r($pathway1->updatePathway($gpml,"blah"));
$dom = new DomDocument();
$dom->loadXML($xml);
$node = $dom->createElement("Comment",$category);
$dom->appendChild($node);
$source_node = $dom->createAttribute("source");
$node->appendChild($source_node);
$source = $dom->createTextNode("WikiPathways-category");
$source_node->appendChild($source);
$xpath = new DomXPath($dom);
//$xpath->registerNamespace("path", "http://genmapp.org/GPML/2008a");
$result = $xpath->query("//*[@BoardWidth]");
$result_comment = $xpath->query("/Comment");
//echo $result->length;
//print_r($result->item(0)->getAttribute('BoardWidth'));
$result->item(0)->parentNode->insertBefore($result_comment->item(0), $result->item(0));
*/
	
	
?>
