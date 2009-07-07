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

//var path = "http://localhost/wikipathways/";

YAHOO.example.treeExample = function() {

    var tree;

        function loadNodeData(node, fnLoadComplete)  {
            
     		// encodeURI(node.label);
            var sUrl = opath + "/wp_proxy.php?concept_id=" + encodeURI(node.c_id);
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
                timeout: 13000
            };
            YAHOO.util.Connect.asyncRequest('GET', sUrl, callback);
        }

        function buildTree() {
           //create a new tree:
           tree = new YAHOO.widget.TreeView("treeDiv1");

           //turn dynamic loading on for entire tree:
           tree.setDynamicLoad(loadNodeData);

           //get root node for tree:
           var root = tree.getRoot();

           //add child nodes for tree; our top level nodes are
           var aConcepts = ["Pathway Ontology - PW:0000001"] ;


           for (var i=0, j=aConcepts.length; i<j; i++) {

              var tempNode = new YAHOO.widget.MenuNode(aConcepts[i], root, false);
				tempNode.c_id=tempNode.label.substring(tempNode.label.lastIndexOf(" - ")+3,tempNode.label.length);
                tempNode.label = tempNode.label.substring(0,tempNode.label.lastIndexOf(" - "));
                }

            tree.subscribe("labelClick", function(node) {
            display_tag(node.label,node.c_id,0);
            tree.destroy();
            tree = null;
            YAHOO.util.Event.onDOMReady(YAHOO.example.treeExample.init, YAHOO.example.treeExample,true);
	       });

           tree.draw();
        }


    return {
        init: function() {
            buildTree();
        }

    }
} ();


function auto_complete ()
    {
    // Use an XHRDataSource
    var oDS = new YAHOO.util.XHRDataSource(opath + "/search_proxy.php");
    // Set the responseType
    oDS.responseType = YAHOO.util.XHRDataSource.TYPE_JSON;
    // Define the schema of the JSON results
    oDS.responseSchema = {
        resultsList : "ResultSet.Result",
        fields : ["label","id"]
    };
    oDS.maxCacheEntries = 15;
    // Instantiate the AutoComplete
    var oAC = new YAHOO.widget.AutoComplete("myInput", "myContainer", oDS);
    // Throttle requests sent
    oAC.queryDelay = 0.2;
    oAC.minQueryLength = 3;
    oAC.useShadow = true;
    // The webservice needs additional parameters
    oAC.generateRequest = function(sQuery) {
        return "?search_term=" + sQuery ;
    };

var itemSelectHandler = function(sType, aArgs) {
	YAHOO.log(sType); // this is a string representing the event;
				      // e.g., "itemSelectEvent"
	var oMyAcInstance = aArgs[0]; // your AutoComplete instance
	var elListItem = aArgs[1]; // the <li> element selected in the suggestion
	   					       // container
	var oData = aArgs[2]; // object literal of data for the result
    if(aArgs[2][0] == "No results !")
        {
            
        }
    else
        {
            display_tag(aArgs[2][0],aArgs[2][1],0);
        }
};

//subscribe your handler to the event, assuming
//you have an AutoComplete instance myAC:
oAC.itemSelectEvent.subscribe(itemSelectHandler);

    return {
        oDS: oDS,
        oAC: oAC
    };

}
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
                            tags[i]=new Array(json_result.Resultset[i].term,json_result.Resultset[i].term_id," ","no");
                        }
                        display_tags();
                    }
                    else
                    {
                        div.innerHTML = "No Tags yet !";
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




function makeRequest(){
    disable_save(100);
    document.getElementById('test1').innerHTML = "<br>";
    var str = "";
    var no_tags = 0;
    var res_array = new Array();
    for(i=0;i<tags.length;i++)
        {
            if(tags[i][3] == "no" && tags[i][0] != "")
                {
                res_array[no_tags] = new Array(tags[i][0],tags[i][1]);
                no_tags++;
                }
        }

    if(no_tags == 0)
        {
        var res_json = "NULL";
        }
    else
        var res_json = YAHOO.lang.JSON.stringify(res_array);

    var postData =  "title=" + wgTitle + "&tag=" + res_json;
    var request = YAHOO.util.Connect.asyncRequest('POST', opath + "/otags.php", callback, postData);
//	setTimeout("gettags()",2000);

}


function gettags() {
    
    div.innerHTML = "Loading ... ";
    var rand = Math.random();
    var postData = "action=fetch" + "&title=" + wgTitle +"&rand=" + rand ;
    var request = YAHOO.util.Connect.asyncRequest('POST', opath + "/otags.php" , callback, postData);
}

    var init = function () {
    setTimeout("gettags()",2000);
    setTimeout("auto_complete()",2000);
    } ();

function display_tags(){

    out = "";
    for(i=0;i<tags.length;i++)
        {
            if(tags[i][0] !="" && tags[i][3] !="yes")
            {
                
                    out += "<a href='javascript:display_tag(\"" + tags[i][0] + "\",\"" + tags[i][1] + "\","+(i+1)+",\"no\");'>" + tags[i][0] + "</a>";

                if( (i+1) < tags.length)
                    {
                        out += ", ";
                    }
            }
        }

    if( out == "")
        out = "No Tags yet!"
    div.innerHTML =  out ;
    enable_save(25);
}

//addOnloadHook(
//    function () {
//        addTab("javascript:doQwikify()", "wikify", "ca-wikify", "Mark for wikification");
//    }
//);


function add_tag(concept,concept_id)
{
    var len = tags.length;
    tags[len]=new Array(concept,concept_id," ","no");
    document.getElementById('myInput').value = 'type here...';
    tag_close();
    makeRequest();
}

function display_tag(concept,concept_id,id,check){
// div.innerHTML=tags + "blah";
if(opentag_id != concept_id)
    {
        var output = " ";
        var url = "http://bioportal.bioontology.org/visualize/39997/" + concept_id;
        output="<div class='otag'><b>Term</b> : " + concept + "<br/><b>ID</b> : " + concept_id + "<br/>"
            + "<a href='" + url + "' target='_blank'><img src='" + opath + "/info.png'></a>&nbsp;"
       // "<input type='hidden' id='concept' value='" + concept + "'> <br/>";
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
                output += "<a title='Add' href='javascript:add_tag(\"" + concept +  "\",\""+concept_id + "\");'><img src='" + opath + "/new.png' /></a>&nbsp;";
                output += "<a title='Close' href='javascript:tag_close();'><img src='" + opath + "/cancel.png' /></a><br></div>";
            }
        opentag_id = concept_id;
    }
else
    {
        var output = "<br>";
        opentag_id = -1;
    }

document.getElementById('myInput').value = 'type here...';
document.getElementById('test1').innerHTML = output;
}

function tag_close()
{
    opentag_id = -1;
    document.getElementById('test1').innerHTML = "<br>";
}

function delete_tags(index)
{
    old_tags = YAHOO.lang.JSON.parse(YAHOO.lang.JSON.stringify(tags));
    tag_close();
    tags[index][3]="yes";
    makeRequest();
}


function clear_box()
{
    if(document.getElementById('myInput').value == 'type here...' || document.getElementById('myInput').value == 'No results !')
        {
            document.getElementById('myInput').value='';
        }
}

function enable_save(opacity)
{
    if(opacity == null)
        opacity = 20;
    document.getElementById('otagprogress').style.display = "none";
    if(timeout != null)
        {
            clearTimeout(timeout);
        }

    if(opacity != 100)
        {
            
            if(otagroot.style.MozOpacity == null)
                {
                    opacity += 5;
                    otagroot.style.filter = 'alpha(opacity=' + opacity + ')';


                }
            else
                {
                    opacity += 5;
                    otagroot.style.MozOpacity = opacity/100 ;
                    // document.getElementById('test1').innerHTML = opacity/100;
                }
            timeout = setTimeout(function(){enable_save(opacity); opacity = null},200);
        }
}

function disable_save(opacity)
{
    document.getElementById('otagprogress').style.display = "block";
    if(timeout != null)
        {
            clearTimeout(timeout);
        }

    if(opacity != 25)
        {
            if(otagroot.style.MozOpacity == null)
                {
                    opacity -= 5;
                }
            else
                {
                    opacity -= 5;
                    otagroot.style.MozOpacity = opacity/100 ;
                }
            timeout = setTimeout(function(){disable_save(opacity); opacity = null},150);
        }
}