var server_url = wgServer + wgScript + "/Special:Ontology_Index?mode=";

var ontologies = new Array(3);
ontologies[0] = ["Pathway Ontology",1035,"PW:0000001"];
ontologies[1] = ["Disease",1009,"DOID:4"];
ontologies[2] = ["Cell Type",1006,"CL:0000000"];

var last_select = null;

var top_level_terms = new Array(3);
//top_level_terms['0'] = ["classic metabolic pathway - PW:0000002","disease pathway - PW:0000013","regulatory pathway - PW:0000004","signaling pathway - PW:0000003"];
//top_level_terms['1'] = ["cell in vivo - CL:0000003","experimentally modified cell - CL:0000578","hematopoietic cell - CL:0000988","oenocyte - CL:0000487"];
//top_level_terms['2'] = ["disease of anatomical entity - DOID:7","disease of behavior - DOID:150","disease of biological process - DOID:344","disease of environmental origin - DOID:3","disease of infectious agent - DOID:0050117","syndrome - DOID:225","temp holding - DOID:63"]

addOnloadHook(
    function () {
    document.getElementById("index_container").innerHTML = "<div id='index_mode'><a href='" + server_url +"list'>List</a> | <a href='" + server_url +"tree'>Tree</a></div><div id='ontology_list'>Loading...</div><div id='treeDiv'>Please select a top level Ontology term !</div>";
    init_ontology_list()
    }
);

function init_ontology_list()
{
   document.getElementById("ontology_list").innerHTML = "" ;
   fetch_ontology_list(0);
}

function fetch_ontology_list(i)
{
    var handleSuccess = function(o){
                   
                    var oResults = YAHOO.lang.JSON.parse(o.responseText);
                    if((oResults.ResultSet.Result) && (oResults.ResultSet.Result.length)) {
                        if(YAHOO.lang.isArray(oResults.ResultSet.Result)) {
                                document.getElementById("ontology_list").innerHTML += "<b>" + ontologies[i][0] + "</b><UL>";
                                for(var j=0; j < oResults.ResultSet.Result.length ; j++)
                                       {
                                        term = oResults.ResultSet.Result[j];
                                        id = term.substring(term.lastIndexOf(" - ")+3,term.length);
                                        id = id.replace("||","");
                                        term = term.substring(0,term.lastIndexOf(" - "));
                                        document.getElementById("ontology_list").innerHTML += "<li><a  id=" + id + " onClick='create_tree(\"" + term + " - " + id + "\",\"" + id + "\");'>" + term + '</li>';
                                        }
                                document.getElementById("ontology_list").innerHTML += "</UL><br>";
                                if(i < (ontologies.length-1))
                                    {
                                        i++;
                                        fetch_ontology_list(i);
                                    }
                        }

	}
}

var handleFailure = function(o){
	if(o.responseText !== undefined){
		div.innerHTML = "<ul><li>Transaction id: " + o.tId + "</li>";
		div.innerHTML += "<li>HTTP status: " + o.status + "</li>";
		div.innerHTML += "<li>Status code message: " + o.statusText + "</li></ul>";
	}
}

var callback =
{
  success:handleSuccess,
  failure:handleFailure,
  argument: { foo:"foo", bar:"bar" }
};
    var sUrl = opath + "/wp_proxy.php?mode=list&ontology_id=" + ontologies[i][1] + "&concept_id=" + encodeURI(ontologies[i][2]);
    var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);

}

function create_tree(root_id,id) {

           var tree;
           tree = new YAHOO.widget.TreeView("treeDiv");
           tree.setDynamicLoad(loadNodeData);
           var root = tree.getRoot();
           var aConcepts = root_id ;

           if(last_select != null)
                {
                document.getElementById(last_select).style.color = "#002BB8";
                document.getElementById(last_select).style.fontWeight = "normal";
                }
           
           last_select = id;
           document.getElementById(id).style.color = "#FF0000";
           document.getElementById(id).style.fontWeight = "bold";
           var tempNode = new YAHOO.widget.TextNode(aConcepts, root, false);
           tempNode.c_id=tempNode.label.substring(tempNode.label.lastIndexOf(" - ")+3,tempNode.label.length);
           tempNode.label = tempNode.label.substring(0,tempNode.label.lastIndexOf(" - "));
           tree.draw();
   
    return {
        init: function() {
            buildTree(root_id);
        }
    }
        }
    function loadNodeData(node, fnLoadComplete)  {

            //Get the node's label and urlencode it; this is the word/s
            //on which we'll search for related words:
     		// encodeURI(node.label);

            var ontology_id = get_ontology_id(node.c_id);
            var sUrl = opath + "/wp_proxy.php?mode=tree&ontology_id=" + ontology_id + "&concept_id=" + encodeURI(node.c_id);
            var callback = {
                success: function(oResponse) {
                    var oResults = YAHOO.lang.JSON.parse(oResponse.responseText);
                    if((oResults.ResultSet.Result) && (oResults.ResultSet.Result.length)) {
                        if(YAHOO.lang.isArray(oResults.ResultSet.Result)) {
                            for (var i=0, j=oResults.ResultSet.Result.length; i<j; i++) {

                            var tempNode = new YAHOO.widget.MenuNode(oResults.ResultSet.Result[i], node, false);
                            tempNode.c_id=tempNode.label.substring(tempNode.label.lastIndexOf(" - ")+3,tempNode.label.length);
                            if(tempNode.label.lastIndexOf("||")>0)
                                {
                                       tempNode.isLeaf = true;
                                       tempNode.c_id = tempNode.c_id.replace("||","");
                                }
                            tempNode.label = tempNode.label.substring(0,tempNode.label.lastIndexOf(" - "));

                            }
                        }
                    }
                    oResponse.argument.fnLoadComplete();
                },

                failure: function(oResponse) {
                    YAHOO.log("Failed to process XHR transaction.", "info", "example");
                    oResponse.argument.fnLoadComplete();
                },

                argument: {
                    "node": node,
                    "fnLoadComplete": fnLoadComplete
                },

                //timeout -- if more than 7 seconds go by, we'll abort
                //the transaction and assume there are no children:
                timeout: 25000
            };

            YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);
        }


function get_ontology_id(tag_id)
{
        switch(tag_id.substring(0,2))
            {
                case "PW":
                    ontology_id = ontologies[0][1];
                    break;
                case "CL":
                    ontology_id = ontologies[1][1];
                    break;
                case "DO":
                    ontology_id = ontologies[2][1];
                    break;
            }
            return ontology_id;
}