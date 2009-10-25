/*
Copyright (c) 2009, Yahoo! Inc.
All rights reserved.

Redistribution and use of this software in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

    * Redistributions of source code must retain the above copyright notice, this list of conditions and the
      following disclaimer.
    * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
    * Neither the name of Yahoo! Inc. nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission of Yahoo! Inc.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/


var out = " ";
var opentag_id = -1;
var div = document.getElementById('otags');
var otagroot = document.getElementById('ontology_container');
var save_img = document.getElementById('save_img');
var save_link = document.getElementById('save_link');
var title = wgPageName;
var tags = new Array();
var old_tags = new Array();
var timeout = null;
var ontologies = new Array(3);
ontologies[0] = ["Pathway Ontology","PW:0000001",1035,39997,"treeDiv1"];
ontologies[1] = ["Disease","DOID:4",1009,40256,"treeDiv2"];
ontologies[2] = ["Cell Type","CL:0000000",1006,40177,"treeDiv3"];


if(otagloggedIn == "true")
    ontologytree = function() {

        function buildTree() {
        var tree = new Array();
        for (var tree_no=0; tree_no<3; tree_no++) {
          tree[tree_no] = new YAHOO.widget.TreeView(ontologies[tree_no][4]);
          tree[tree_no].setDynamicLoad(loadNodeData);
           var root = tree[tree_no].getRoot();
           var aConcepts = [ontologies[tree_no][0] + " - " + ontologies[tree_no][1]] ;

           for (var i=0, j=aConcepts.length; i<j; i++) {
                var tempNode = new YAHOO.widget.TextNode(aConcepts[i], root, false);
				tempNode.c_id=tempNode.label.substring(tempNode.label.lastIndexOf(" - ")+3,tempNode.label.length);
                tempNode.label = tempNode.label.substring(0,tempNode.label.lastIndexOf(" - "));
                }
            tree[tree_no].subscribe("labelClick", function(node) {
            display_tag(node.label,node.c_id,0);
            tree[0].destroy();
            tree[1].destroy();
            tree[2].destroy();
            tree = null;
            YAHOO.util.Event.onDOMReady(ontologytree.init, ontologytree,true);YAHOO.util.Event.onDOMReady(ontologytree.init, ontologytree,true);
	       });
           tree[tree_no].draw();
        }
        }

    return {
        init: function() {
            buildTree();
        }
    }
} ();

function loadNodeData(node, fnLoadComplete)  {

            //Get the node's label and urlencode it; this is the word/s
            //on which we'll search for related words:
     		// encodeURI(node.label);

            var ontology_id = get_ontology_id(0,node.c_id);
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
                timeout: 13000
            };

            YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);
        }


if(otagloggedIn == "true")
    function auto_complete (){
        var oDS = new YAHOO.util.XHRDataSource( opath + "/search_proxy.php");
        // Set the responseType
        oDS.responseType = YAHOO.util.XHRDataSource.TYPE_JSON;
        // Define the schema of the JSON results
        oDS.responseSchema = {
            resultsList : "ResultSet.Result",
            fields : ["label","id","ontology"]
        };
        oDS.maxCacheEntries = 15;
        // Instantiate the AutoComplete
        var oAC = new YAHOO.widget.AutoComplete("myInput", "myContainer", oDS);
        // Throttle requests sent
        oAC.queryDelay = 0.2;
        oAC.minQueryLength = 3;
        oAC.useShadow = true;
        oAC.prehighlightClassName = "yui-ac-prehighlight";

        // The webservice needs additional parameters
        oAC.generateRequest = function(sQuery) {
            return "?search_term=" + sQuery ;
        };

        oAC.resultTypeList = false;
        // Customize formatter to show thumbnail images
        oAC.formatResult = function(oResultData, sQuery, sResultMatch) {

            if(oResultData.label == "No results !")
                return  "<em>" + oResultData.label + "</em>";
            else
                return  "<em>" + oResultData.label + "</em><br />" + oResultData.ontology ;
        };

        var itemSelectHandler = function(sType, aArgs) {
        var oData = aArgs[2]; // object literal of data for the result
        if(oData.label == "No results !")
            {
            }
        else
            {
                display_tag(oData.label,oData.id,0);
            }
        };

        oAC.itemSelectEvent.subscribe(itemSelectHandler);

        return {
            oDS: oDS,
            oAC: oAC
        };
}




var handleSuccess = function(o){

    if(o.responseText.lastIndexOf("php")>0 || o.responseText.lastIndexOf("exception")>0)
        {
            div.innerHTML = "<pre><b><font color='red'>Error ! </font></b></br>" + o.responseText + "</pre>" ;
            enable_save();
        }
        
    //if(tempNode.label.substring(tempNode.label.lastIndexOf(" - ")+3,tempNode.label.length);)
    else
        {
            if(o.responseText == "Success")
                {
                    gettags();
                }
            else
                {
                    if(o.responseText !== undefined && o.responseText != "No Tags")
                    {
                        tags = new Array();
                        var json_result = YAHOO.lang.JSON.parse(o.responseText);
                        for(i=0;i<json_result.Resultset.length;i++)
                        {
                            tags[i]=new Array(json_result.Resultset[i].term,json_result.Resultset[i].term_id,json_result.Resultset[i].ontology,"no");
                        }
                        display_tags();
                    }
                    else
                    {
                        display_tags();
                    }
                }
        }
}
var handleFailure = function(o){

	if(o.responseText !== undefined){

	}
}

var callback =
{
  success:handleSuccess,
  failure:handleFailure,
  argument: { foo:"foo", bar:"bar" }
};




function makeRequest(comment){
    disable_save(100);
    document.getElementById('test1').innerHTML = "<br>";
    var no_tags = 0;
    var res_array = new Array();
    for(i=0;i<tags.length;i++)
        {
            if(tags[i][3] == "no" && tags[i][0] != "")
                {
                res_array[no_tags] = new Array(tags[i][0],tags[i][1],tags[i][2]);
                no_tags++;
                }
        }

    if(no_tags == 0)
        {
        var res_json = "NULL";
        }
    else
        var res_json = YAHOO.lang.JSON.stringify(res_array);

    var postData =  "title=" + wgTitle + "&tag=" + res_json + "&comment=" + comment;
    var request = YAHOO.util.Connect.asyncRequest('POST', opath + "/otags.php", callback, postData);
//	setTimeout("gettags()",2000);

}

function get_ontology_name(tag_id)
{
        switch(tag_id.substring(0,2))
            {
                case "PW":
                    ontology_name = "Pathway Ontology";
                    break;
                case "CL":
                    ontology_name = "Cell Type";
                    break;
                case "DO":
                    ontology_name = "Disease";
                    break;
                default:
                    ontology_name = "Unknown";
                    break;
            }
            return ontology_name;
}

function get_ontology_id(type,tag_id)
{
    if(type == "version")
        switch(tag_id.substring(0,2))
            {
                case "PW":
                    ontology_id = ontologies[0][3];
                    break;
                case "DO":
                    ontology_id = ontologies[1][3];
                    break;
                case "CL":
                    ontology_id = ontologies[2][3];
                    break;
            }
    else
        switch(tag_id.substring(0,2))
            {
                case "PW":
                    ontology_id = ontologies[0][2];
                    break;
                case "DO":
                    ontology_id = ontologies[1][2];
                    break;
                case "CL":
                    ontology_id = ontologies[2][2];
                    break;
            }
        
            return ontology_id;
}

function gettags() {
    
    div.innerHTML = "Loading ... ";
    var rand = Math.random();
    var postData = "action=fetch" + "&title=" + wgTitle +"&rand=" + rand ;
    var request = YAHOO.util.Connect.asyncRequest('POST', opath + "/otags.php" , callback, postData);
}

    var init = function () {
    setTimeout("gettags()",2000);
    if(otagloggedIn == "true")
        setTimeout("auto_complete()",2000);
    } ();


function display_tags(){

    out = [" "," "," "];
    var output = "";
    for(j=0;j<ontologies.length;j++)
        {
            for(i=0;i<tags.length;i++)
                {
                    if(tags[i][0] !="" && tags[i][3] !="yes" && tags[i][2] == ontologies[j][0])
                    {

                        out[j] += "<a href='javascript:display_tag(\"" + tags[i][0] + "\",\"" + tags[i][1] + "\","+(i+1)+",\"no\");'>" + tags[i][0] + "</a>";
                        if( (i+1) < tags.length && tags[i+1][2] == ontologies[j][0])
                            {
                                out[j] += ", ";
                            }
                    }
                }
        }

    for(j=0;j<ontologies.length;j++)
        {
            if( out[j] == " ")
                out[j] = "No Tags yet!";
            output += "<b>" + ontologies[j][0] + "</b> : " + out[j] + "<br>";
        }
            div.innerHTML =  output;
            enable_save(25);
        
}

function add_tag(concept,concept_id)
{
    if(tags.toString().indexOf(concept_id)>0)
        {
            document.getElementById('test1').innerHTML = "<div class='otag'><font color='red'>Error : The pathway is already tagged with this term !</font><br><a title='Close' href='javascript:tag_close();'><img src='" + opath + "/cancel.png' /></a><br></div>";
        }
    else
        {
            var len = tags.length;
            var ontology_name = get_ontology_name(concept_id);
            tags[len]=new Array(concept,concept_id,ontology_name,"no");
            tag_close();
            makeRequest("Added tag : " + concept + " (" + ontology_name + ")");
        }
}

function display_tag(concept,concept_id,id,check){


if(opentag_id != concept_id)
    {
        ontology_version_id = get_ontology_id("version",concept_id);
        var output = " ";
        var url = "http://bioportal.bioontology.org/visualize/" + ontology_version_id + "/" + concept_id;
        output="<div class='otag'><b>Term</b> : " + concept + "<br/><b>ID</b> : " + concept_id + "<br/>"
            + "<a href='" + url + "'  title='View more Info on BioPortal !' target='_blank'><img src='" + opath + "/info.png'></a>&nbsp;"
        
        if(otagloggedIn == "true")
            if(id!=0)
                {
                    if(check == "no")
                        {
                            output += "<a title='Close' href='javascript:tag_close();'><img src='" + opath + "/apply.png' /></a>&nbsp;";
                            output += "<a title='Remove' href='javascript:delete_tags(" + (id-1) +  ");'><img src='" + opath + "/cancel.png' /></a><br></div>";
                        }
                }
            else
                {
                    output += "<a title='Add' href='javascript:add_tag(\"" + concept +  "\",\""+concept_id + "\");'><img src='" + opath + "/apply.png' /></a>&nbsp;";
                    output += "<a title='Close' href='javascript:tag_close();'><img src='" + opath + "/cancel.png' /></a><br></div>";
                }
            opentag_id = concept_id;
    }
else
    {
        var output = "<br>";
        opentag_id = -1;
    }


document.getElementById('test1').innerHTML = output;
}

function tag_close()
{
    opentag_id = -1;
    document.getElementById('test1').innerHTML = "<br>";
    clear_box(1);
}

function delete_tags(index)
{
    old_tags = YAHOO.lang.JSON.parse(YAHOO.lang.JSON.stringify(tags));
    tag_close();
    tags[index][3]="yes";
    var ontology_name = get_ontology_name(tags[index][1]);
    makeRequest("Deleted tag : " + tags[index][0] + " (" + ontology_name + ")");
}

function clear_box()
{

    document.getElementById('myInput').value='';
     
}

function enable_save(opacity)
{
    if(opacity == null)
        opacity = 20;
    document.getElementById('otagprogress').style.display = "none";

}

function disable_save(opacity)
{
    document.getElementById('otagprogress').style.display = "block";

}