var server_url = wgServer + wgScript + "/Special:Ontology_Index?mode=";

var ontologies = new Array(3);
ontologies[0] = ["Pathway Ontology",1035];
ontologies[1] = ["Cell Type",1006];
ontologies[2] = ["Disease",1009];

var top_level_terms = new Array(3);
top_level_terms['0'] = ["classic metabolic pathway - PW:0000002","disease pathway - PW:0000013","regulatory pathway - PW:0000004","signaling pathway - PW:0000003"];
top_level_terms['1'] = ["cell in vivo - CL:0000003","experimentally modified cell - CL:0000578","hematopoietic cell - CL:0000988","oenocyte - CL:0000487"];
top_level_terms['2'] = ["disease of anatomical entity - DOID:7","disease of behavior - DOID:150","disease of biological process - DOID:344","disease of environmental origin - DOID:3","disease of infectious agent - DOID:0050117","syndrome - DOID:225","temp holding - DOID:63"]

addOnloadHook(
    function () {
    document.getElementById("index_container").innerHTML = "<div id='index_mode'><a href='" + server_url +"list'>List</a> | <a href='" + server_url +"tree'>Tree</a></div><div id='ontology_list'></div><div id='treeDiv'>Please select a top level Ontology term !</div>";
    init_ontology_list();

    }
);

function init_ontology_list()
{

for(var i=0; i < top_level_terms.length ; i++)
    {
        document.getElementById("ontology_list").innerHTML += "<b>" + ontologies[i][0] + "</b><UL>";
        for(var j=0; j < top_level_terms[i].length ; j++)
            {
                term = top_level_terms[i][j];
                id=term.substring(term.lastIndexOf(" - ")+3,term.length);
                term = term.substring(0,term.lastIndexOf(" - "));
                document.getElementById("ontology_list").innerHTML += "<li><a onClick='create_tree(\"" + term + " - " + id + "\");'>" + term + '</li>';
            }
        document.getElementById("ontology_list").innerHTML += "</UL><br>";
    }

}



        function create_tree(root_id) {

           var tree;
           tree = new YAHOO.widget.TreeView("treeDiv");
           tree.setDynamicLoad(loadNodeData);
           var root = tree.getRoot();
           var aConcepts = root_id ;

        

              var tempNode = new YAHOO.widget.TextNode(aConcepts, root, false);
				tempNode.c_id=tempNode.label.substring(tempNode.label.lastIndexOf(" - ")+3,tempNode.label.length);
                tempNode.label = tempNode.label.substring(0,tempNode.label.lastIndexOf(" - "));
        

           // var tempNode = new YAHOO.widget.TextNode('This is a leaf node', root, false);
           // tempNode.isLeaf = true;

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
            var sUrl = opath + "/wp_proxy.php?ontology_id=" + ontology_id + "&concept_id=" + encodeURI(node.c_id);
            var callback = {
                success: function(oResponse) {
                    YAHOO.log("XHR transaction was successful.", "info", "example");
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