<?php

class ontologyindex extends SpecialPage {
    public static $ONTOLOGY_TABLE = "ontology";
    
    function __construct() {
		parent::__construct( 'ontologyindex' );
		wfLoadExtensionMessages('ontologyindex');
	}

	function execute( $par ) {
		global $wgRequest, $wgOut;

		$this->setHeaders();
		

        if ($term =  $wgRequest->getVal("term"))
        {
            $this->oform();
            $this->fetch_pathways($term);
        }
        else
        {
        if ($input =  $wgRequest->getVal("search_term"))
        {
            $this->oform();
            $this->tag_search($input);
        }
        else
        {
        if ($out =  $wgRequest->getVal("ontology"))
        {
            $this->oform($out);
            $this->ontology_terms($out);
        }
        else
        {
            $this->oform();
            $this->ontology_terms("All Ontologies");
        }
        }
        }

	}
    
    function ontology_terms($ontology)
    {
        global $wgOut , $wgScript ;
        $table = self::$ONTOLOGY_TABLE;
        $ontology = mysql_real_escape_string($ontology);
        $dbr =& wfGetDB(DB_SLAVE);
        if($ontology == "All Ontologies")
        $res = $dbr->select( $table, array('term','term_id') );
        else
        $res = $dbr->select( $table, array('term','term_id'), array( 'ontology' => $ontology  ) );
        while($row = $dbr->fetchObject($res))
            {
                $arr[] = $row->term;
            }
        $arr = array_unique($arr);
        $dbr->freeResult( $res );
        $wgOut->addHTML('<table width="100%"><tbody><tr><ul>');
        foreach($arr as $term)
        {
            $wgOut->addHTML("<tr><td><li><a href='$wgScript/Special:Ontology_Index?term=$term'>" . $term . "</a></li></td></tr>");
            $count++;
        }
        if(!$count)
            $wgOut->addWikiText( " Sorry, Your search did not match any tags !");
        $wgOut->addHTML("</ul></tbody></table>");
    }
    function oform($ont)
    {
        global $wgOut,$wgScript;
        
        $ontologies = array("All Ontologies","Cell Type","Evidence Codes","GO:Biological Process");
        foreach($ontologies as $ontology)
            {
                if($ont == $ontology)
                $select .= "<option Selected>$ontology</option>";
                else
                $select .= "<option>$ontology</option>";
            }
        $wgOut->addHTML("<form action='$wgScript/Special:Ontology_Index' method='POST'>");
        $wgOut->addHTML("Display tags from Ontology :");
        $wgOut->addHTML("<Select name='ontology' onchange='this.form.submit()'>$select</Select>");
        $wgOut->addHTML("  Search for terms : ");
        $wgOut->addHTML("<input type='text' name='search_term'>");
        $wgOut->addHTML("<input type='Submit' value='Go'>");

        $wgOut->addHTML("</form><hr/>");
    }

    function tag_search($input)
    {
        global $wgOut,$wgScript;
        $input = mysql_real_escape_string($input);
        $dbr = wfGetDB( DB_SLAVE );
        $table = self::$ONTOLOGY_TABLE;
		$query = "SELECT * FROM $table " .
			"WHERE term LIKE '%$input%'";
		$res = $dbr->query($query);
   while($row = $dbr->fetchObject($res))
            {
                $arr[] = $row->term;
            }
        $arr = array_unique($arr);
        $dbr->freeResult( $res );
        $wgOut->addHTML('<table width="100%"><tbody><tr><ul>');
        foreach($arr as $term)
        {
            $wgOut->addHTML("<tr><td><li><a href='$wgScript/Special:Ontology_Index?term=$term'>" . $term . "</a></li></td></tr>");
            $count++;
        }
        if(!$count)
            $wgOut->addWikiText( " Sorry, Your search did not match any tags !");
        $wgOut->addHTML("</ul></tbody></table>");
    }
    function fetch_pathways($term)
    {

        global $wgOut,$wgScript ;
        $term = mysql_real_escape_string($term);
        $dbr = wfGetDB( DB_SLAVE );
        $table = self::$ONTOLOGY_TABLE;
		$query = "SELECT * FROM $table " .
			"WHERE term = '$term'";
		$res = $dbr->query($query);
        while($row = $dbr->fetchObject($res))
            {
                $arr[] = $row->pw_id;
            }
        $arr = array_unique($arr);
        $dbr->freeResult( $res );
        $url = "$wgScript/Special:Ontology_Index";
            $nr = count($arr);
            $wgOut->addWikiText("The table below shows all $nr pathways that are tagged with Ontology term: " . "'''$term'''" );
            $wgOut->addHTML("<p><a href='$url'>back</a></p>");
        	$wgOut->addHTML("<table class='prettytable sortable'><tbody>");
			$wgOut->addHTML("<th>Pathway title<th>Pathway name<th>Organism");

			foreach($arr as $pw) {
				try {
						$p = Pathway::newFromTitle($pw);
						if($p->isDeleted()) continue;

						$wgOut->addHTML(
							"<tr><td><a href='{$p->getFullUrl()}'>{$pw}</a><td><a href='{$p->getFullUrl()}'>{$p->name()}</a><td>{$p->species()}"	);					
				} catch(Exception $e) {
					wfDebug("Unable to create pathway object for Title " . $pw);
				}
			}
            $wgOut->addHTML("</tbody></table>");

    }

}