var server_url = wgServer + wgScript + "/Special:Ontology_Index?mode=";

var ontologies = new Array(3);
ontologies[0] = ["Pathway Ontology",1035,"PW:0000001"];
ontologies[1] = ["Disease",1009,"DOID:4"];
ontologies[2] = ["Cell Type",1006,"CL:0000000"];

var last_select = "None";
var filter = "All";
var last_select_filter = filter;
var species =  "Homo sapiens";
var last_select_species = species;
var top_level_terms = new Array(3);
//top_level_terms['0'] = ["classic metabolic pathway - PW:0000002","disease pathway - PW:0000013","regulatory pathway - PW:0000004","signaling pathway - PW:0000003"];
//top_level_terms['1'] = ["cell in vivo - CL:0000003","experimentally modified cell - CL:0000578","hematopoietic cell - CL:0000988","oenocyte - CL:0000487"];
//top_level_terms['2'] = ["disease of anatomical entity - DOID:7","disease of behavior - DOID:150","disease of biological process - DOID:344","disease of environmental origin - DOID:3","disease of infectious agent - DOID:0050117","syndrome - DOID:225","temp holding - DOID:63"]

addOnloadHook(
    function () {
    document.getElementById("index_container").innerHTML = "<div id='index_mode'>" +
        "<a id='imgMode' href='" + server_url +"image'>Image</a> | <a id='listMode' href='" + server_url +"list'>List</a> | <a id='treeMode' href='" + server_url +"tree'>Tree</a>" +
        "<br> Sort by : " + "<a id='All' style='color: #FF0000;' onClick='set_filter(\"All\");'> Alphabetical</a> " + " | " + "<a id='Edited' onClick='set_filter(\"Edited\");'>Most Edited</a> | <a id='Popular' onClick='set_filter(\"Popular\");'>Most Viewed</a> | <a id='last_edited' onClick='set_filter(\"last_edited\");'>Last Edited</a>" +
        "</div>" +
        "<div id='container_left'>" +
        "<div id='species_list'>Loading...</div>" + 
        "<hr style='margin: 5px 0 5px 0;'>" +
        "<div id='ontology_list'>Loading...</div>" +
        "</div>" +
        "<div id='container_right'>" +
        "<div id='pathway_list'></div>" +
        "<div id='treeDiv'>Loading...</div>" +
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
                                        document.getElementById("ontology_list").innerHTML += "<ul><li><a  id=" + id + " onClick='set_ontology(\"" + term + " - " + id + "\",\"" + id + "\" ,\"Yes\");'>" + term + '</a></li></ul>';
                                        }
                                document.getElementById("ontology_list").innerHTML += "<br>";
                                if(no < (ontologies.length-1))
                                    {
                                        no++;
                                        fetch_ontology_list(no);
                                    }
                                else
                                    {
                                        if(YAHOO.util.Cookie.get('ontologyId') != "" && YAHOO.util.Cookie.get('ontologyId') != null)
                                        {
                                            last_select = YAHOO.util.Cookie.get('ontologyId');
                                            set_ontology(YAHOO.util.Cookie.get('ontology'),YAHOO.util.Cookie.get('ontologyId'),"No");
                                        }
                                        else
                                            set_ontology(" ",last_select,"No");
                                        get_pathways_list();
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
    var sUrl = opath + "/wp_proxy.php?action=tree&mode=sidebar&ontology_id=" + ontologies[no][1] + "&concept_id=" + encodeURI(ontologies[no][2]) + "&species=" + species;
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
    if(YAHOO.util.Cookie.get("species") != "" && YAHOO.util.Cookie.get("species") != null)
        set_species(YAHOO.util.Cookie.get("species"));
    else
        set_species(species);
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
           document.getElementById("ontology_list").innerHTML += "<a id='None' onClick='set_ontology(\"\",\"None\",\"Yes\");'>None</a><br />";
           document.getElementById("pathway_list").innerHTML = "";
           YAHOO.util.Cookie.set("species", species);
           fetch_ontology_list(0);

}
function get_pathways_list()
{

    var handleSuccess = function(o){
    if(o.responseText != " ")
        document.getElementById("treeDiv").innerHTML = "<ul>" + o.responseText + "</ul>";
    else
        document.getElementById("treeDiv").innerHTML = "No pathways found !";
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

    if(last_select != "None")
        var sUrl = opath + "/wp_proxy.php?filter=" + filter + "&action=" + page_mode + "&species="+ species + "&term=" + last_select;
    else
        var sUrl = opath + "/wp_proxy.php?filter=" + filter + "&action=" + page_mode + "&species="+ species + "&term=";
    document.getElementById("treeDiv").innerHTML = "Loading...";
    var request = YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);

}
    
function set_ontology(root_id,id,get_pathways)
{
    
           if(root_id != " ")
               {
                    YAHOO.util.Cookie.set("ontology", root_id);
                    YAHOO.util.Cookie.set("ontologyId", id);
               }
           document.getElementById("pathway_list").innerHTML = "";
           if(last_select != null)
                {
                document.getElementById(last_select).style.color = "#002BB8";
                document.getElementById(last_select).style.fontWeight = "normal";
                }

           last_select = id;
           document.getElementById(id).style.color = "#FF0000";
           document.getElementById(id).style.fontWeight = "bold";
           if(get_pathways == "Yes")
                get_pathways_list();

}

function set_filter(filterName)
{
    document.getElementById(last_select_filter).style.color = "#002BB8";
    document.getElementById(last_select_filter).style.fontWeight = "normal";
    document.getElementById(filterName).style.color = "#FF0000";
    document.getElementById(filterName).style.fontWeight = "bold";
    last_select_filter = filterName;
    filter = filterName;
    get_pathways_list();
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