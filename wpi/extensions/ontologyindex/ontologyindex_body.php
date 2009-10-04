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
        

            $this->tree();

	}
    
    function tree()
    {
        global $wgOut,$wgRequest;
        $opath = WPI_URL . "/extensions/ontologyindex" ;
        $mode = $wgRequest->getVal('mode');
        $mode = ($mode == "")?"list":$mode;
        $wgOut->addHTML('<link rel="stylesheet" type="text/css" href="' . $opath . '/otagindex.css" />
                         <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/treeview/assets/skins/sam/treeview.css" />
                         <script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
                         <script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/connection/connection-min.js"></script>
                         <script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/treeview/treeview-min.js"></script>
                         <script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/json/json-min.js"></script>
                         <script src="http://yui.yahooapis.com/2.7.0/build/yahoo/yahoo-min.js"></script>
                         <script src="http://yui.yahooapis.com/2.7.0/build/event/event-min.js"></script>
                         <script type="text/javascript" src="http://yui.yahooapis.com/2.8.0r4/build/cookie/cookie-min.js"></script>');
        $wgOut->addHTML("<div id='index_container'></div>");
        $wgOut->addScript(
            "<script type='text/javascript'>var opath=\"$opath\";
            var page_mode = \"$mode\";
            </script>"
    	);
        if($mode == "tree")
        $wgOut->addScript("<script type='text/javascript' src='$opath/script.js'></script>");
        else
        $wgOut->addScript("<script type='text/javascript' src='$opath/script_list.js'></script>");
    }


}