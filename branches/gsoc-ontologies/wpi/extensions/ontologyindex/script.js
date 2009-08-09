var server_url = wgServer + wgScript + "/Special:Ontology_Index?mode=";

var ontologies = new Array(3);
ontologies[0] = ["Pathway Ontology",1035,"PW:0000001"];
ontologies[1] = ["Disease",1009,"DOID:4"];
ontologies[2] = ["Cell Type",1006,"CL:0000000"];

var last_select = null;
var last_select_species = "All Species";
var species = "All Species";
var top_level_terms = new Array(3);
//top_level_terms['0'] = ["classic metabolic pathway - PW:0000002","disease pathway - PW:0000013","regulatory pathway - PW:0000004","signaling pathway - PW:0000003"];
//top_level_terms['1'] = ["cell in vivo - CL:0000003","experimentally modified cell - CL:0000578","hematopoietic cell - CL:0000988","oenocyte - CL:0000487"];
//top_level_terms['2'] = ["disease of anatomical entity - DOID:7","disease of behavior - DOID:150","disease of biological process - DOID:344","disease of environmental origin - DOID:3","disease of infectious agent - DOID:0050117","syndrome - DOID:225","temp holding - DOID:63"]

addOnloadHook(
    function () {
    document.getElementById("index_container").innerHTML = "<div id='index_mode'>" +
        "<a href='" + server_url +"list'>List</a> | <a href='" + server_url +"tree'>Tree</a>" +
        "</div>" +
        "<div id='container_left'>" +
        "<div id='species_list'>Loading...</div>" + 
        "<hr style='margin: 5px 0 5px 0;'>" +
        "<div id='ontology_list'>Loading...</div>" +
        "</div>" +
        "<div id='container_right'>" +
        "<div id='pathway_list'></div>" +
        "<div id='treeDiv'>Please select a top level Ontology term !</div>" +
        "</div>" ;
    init_ontology_list();
    }
) ;

function init_ontology_list()
{
   document.getElementById("ontology_list").innerHTML = "<font size='4'><b>Ontologies :</b></font><br>" ;
   get_species();
}

function fetch_ontology_list(no)
{
    var handleSuccess = function(o){

                    var oResults = YAHOO.lang.JSON.parse(o.responseText);
                    if((oResults.ResultSet.Result) && (oResults.ResultSet.Result.length)) {
                        if(YAHOO.lang.isArray(oResults.ResultSet.Result)) {
                                document.getElementById("ontology_list").innerHTML += "<b>" + ontologies[no][0] + "</b>";
                                for(var j=0; j < oResults.ResultSet.Result.length ; j++)
                                       {
                                        term = oResults.ResultSet.Result[j];
                                        id = term.substring(term.lastIndexOf(" - ")+3,term.length);
                                        id = id.replace("||","");
                                        term = term.substring(0,term.lastIndexOf(" - "));
                                        document.getElementById("ontology_list").innerHTML += "<li><a  id=" + id + " onClick='create_tree(\"" + term + " - " + id + "\",\"" + id + "\");'>" + term + '</a></li>';
                                        }
                                document.getElementById("ontology_list").innerHTML += "<br>";
                                if(no < (ontologies.length-1))
                                    {
                                        no++;
                                        fetch_ontology_list(no);
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
    var sUrl = opath + "/wp_proxy.php?action=tree&mode=list&ontology_id=" + ontologies[no][1] + "&concept_id=" + encodeURI(ontologies[no][2]) + "&species=" + species;
    var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);

}

function get_pathways(label, id)
{
    var handleSuccess = function(o){

    document.getElementById("pathway_list").innerHTML = o.responseText + "<br><hr width='50%' align='center'><br>";
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
    ontology_id = get_ontology_id(id);
    var sUrl = opath + "/wp_proxy.php?action=pathways&ontology_term=" + label + "&ontology_id=" + ontology_id + "&concept_id=" + encodeURI(id) + "&species=" + species;
    document.getElementById("pathway_list").innerHTML = "Loading...";
    var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);
    

}

function get_species()
{
    var handleSuccess = function(o){
    var result = YAHOO.lang.JSON.parse(o.responseText);
    output = "<li>" + "<a id='All Species' onClick='set_species(\"All Species\");'>" + "All Species" + '</a>' + "</li>";
    for(var j=0; j<result.length; j++)
        {
            output += "<li>" + "<a id='" + result[j] + "' onClick='set_species(\"" + result[j] + "\");'>" + result[j] + '</a>' + "</li>";
        }
    document.getElementById("species_list").innerHTML = "<font size='4'><b>Species :</b></font><ul>" + output + "</ul>";
    set_species("All Species");
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
    var sUrl = opath + "/wp_proxy.php?action=species";
    document.getElementById("species_list").innerHTML = "Loading...";
    var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);

}

function set_species(specie)
{
        species = specie;
        if( last_select_species != null)
            {
                document.getElementById(last_select_species).style.color = "#002BB8";
                document.getElementById(last_select_species).style.fontWeight = "normal";
            }
           document.getElementById(specie).style.color = "#FF0000";
           document.getElementById(specie).style.fontWeight = "bold";
           last_select_species = specie;
           document.getElementById("ontology_list").innerHTML = "<font size='4'><b>Ontologies :</b></font><br>" ;
           document.getElementById("treeDiv").innerHTML = "Please select a top level Ontology term !";
           document.getElementById("pathway_list").innerHTML = "";
           fetch_ontology_list(0);
}


function create_tree(root_id,id)
{

           var tree;

           tree = new YAHOO.widget.TreeView("treeDiv");
           tree.setDynamicLoad(loadNodeData);
           var root = tree.getRoot();
           var aConcepts = root_id ;
           document.getElementById("pathway_list").innerHTML = "";
           if(last_select != null)
                {
                document.getElementById(last_select).style.color = "#002BB8";
                document.getElementById(last_select).style.fontWeight = "normal";
                }

           last_select = id;
           document.getElementById(id).style.color = "#FF0000";
           document.getElementById(id).style.fontWeight = "bold";
           var tempNode = new YAHOO.widget.TextNode(aConcepts, root, tree);
           tempNode.c_id=tempNode.label.substring(tempNode.label.lastIndexOf(" - ")+3,tempNode.label.length);
           tempNode.label = tempNode.label.substring(0,tempNode.label.lastIndexOf(" - "));

           // display the pathways
//           get_pathways(tempNode.label, tempNode.c_id);
//
           tree.draw();
//
           tree.subscribe("labelClick", function(node) {
               if(node.c_id.lastIndexOf("0000a")>0)
                   {
                        var pw_url = node.c_id.replace("0000a","");
                        winRef = window.open( wgServer + wgScript + "/Pathway:" + pw_url ,node.label);
                   }
//            get_pathways(node.label,node.c_id);
//
////            tree.destroy();
////            tree = null;
////            YAHOO.util.Event.onDOMReady(ontologytree.init, ontologytree,true);
//	       })
//
//            tree.subscribe("expand", function(node) {
//                get_pathways(node.label,node.c_id);
//                // return false; // return false to cancel the expand
         })

    return {
        init: function() {
            buildTree(root_id);
        }
    }
        }
    function loadNodeData(node, fnLoadComplete)
    {

            //Get the node's label and urlencode it; this is the word/s
            //on which we'll search for related words:
     		// encodeURI(node.label);

            var ontology_id = get_ontology_id(node.c_id);
            var sUrl = opath + "/wp_proxy.php?tree_pw=yes&action=tree&mode=tree&ontology_id=" + ontology_id + "&concept_id=" + encodeURI(node.c_id) + "&species=" + species;
            var callback = {
                success: function(oResponse) {
                    var oResults = YAHOO.lang.JSON.parse(oResponse.responseText);
                    if((oResults.ResultSet.Result) && (oResults.ResultSet.Result.length)) {
                        if(YAHOO.lang.isArray(oResults.ResultSet.Result)) {
                            for (var i=0, j=oResults.ResultSet.Result.length; i<j; i++) {

                            var tempNode = new YAHOO.widget.MenuNode(oResults.ResultSet.Result[i], node, false);
                            tempNode.c_id=tempNode.label.substring(tempNode.label.lastIndexOf(" - ")+3,tempNode.label.length);

                            if(tempNode.c_id.lastIndexOf("0000a")>0 || tempNode.c_id.lastIndexOf("||")>0)
                                {
                                       tempNode.isLeaf = true;

                                }
                            tempNode.c_id = tempNode.c_id.replace("||","");
                            tempNode.label =    tempNode.label.substring(0,tempNode.label.lastIndexOf(" - "));
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
                case "DO":
                    ontology_id = ontologies[1][1];
                    break;
                case "CL":
                    ontology_id = ontologies[2][1];
                    break;
                
            }
            
            return ontology_id;
}