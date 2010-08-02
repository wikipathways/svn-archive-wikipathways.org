<?php


class GraphMLConverter
{
    public $_graphML;
    private $_addedPathways;
    private $_relationsData;

    public function __construct($relationsData)
    {
        $this->_graphML = new SimpleXMLElement("<graphml></graphml>");
        $this->_addedPathways = array();
        $this->_relationsData = $relationsData;
        $this->addKeys();
        $this->addProperties();
        $this->addData();
    }

    private function addKeys()
    {
        $keys = array(
            array( 'name' => 'name', 'type' => 'String', 'for' => 'node' ),
            array( 'name' => 'pwId', 'type' => 'String', 'for' => 'node' ),
            array( 'name' => 'url', 'type' => 'String', 'for' => 'node' ),
            array( 'name' => 'score', 'type' => 'float', 'for' => 'edge' ),
        );

        foreach($keys as $key)
        {
            $keyElement = $this->_graphML->addChild("key");
            $keyElement->addAttribute("id", $key['name']);
            $keyElement->addAttribute("for",$key['for']);
            $keyElement->addAttribute("attr.name", $key['name']);
            $keyElement->addAttribute("attr.type", $key['type']);
        }
    }

    private function addNode($pwId)
    {
        if(!array_key_exists($pwId, $this->_addedPathways))
        {
            $nodeId = count($this->_addedPathways);
            $this->_addedPathways[$pwId]['id'] = $nodeId;

            $node = $this->_graphML->addChild("node");
            $node->addAttribute("id", $nodeId);

            $nodeData = $node->addChild("data", $pwId);
            $nodeData->addAttribute("key", "pwId");

            $nodeName = $node->addChild("data", getPathwayName($pwId));
            $nodeName->addAttribute("key", "name");

            return $nodeId;
        }
        else {
            return $this->_addedPathways[$pwId]['id'];
        }

    }

    private function addEdge($nodeId_1, $nodeId_2, $score)
    {
        $edge = $this->_graphML->addChild("edge");
        
        $edge->addAttribute("source", $nodeId_1);
        $edge->addAttribute("target", $nodeId_2);

        $edgeScore = $edge->addchild("data", (float)$score);
        $edgeScore->addAttribute("key", "score");
    }

    private function addData()
    {
        foreach($this->_relationsData as $relation)
        {
            $pwId_1 = (string) $relation->pwId_1;
            $pwId_2 = (string) $relation->pwId_2;
            $score = (float)$relation->score;

            $nodeId_1 =  $this->addNode($pwId_1);
            $nodeId_2 =  $this->addNode($pwId_2);
            
            $this->addEdge($nodeId_1, $nodeId_2, $score);
        }
    }

    private function addProperties()
    {
        $graphProperty = $this->_graphML->addChild('graph');
        $graphProperty->addAttribute("edgedefault", "undirected");
    }

    public function getGraphML()
    {
        return $this->_graphML->asXML();
    }

}


function getPathwayName($pwId)
{
    $pw = new Pathway($pwId);
    $pwName = $pw->getName();

    return $pwName;

}

?>




