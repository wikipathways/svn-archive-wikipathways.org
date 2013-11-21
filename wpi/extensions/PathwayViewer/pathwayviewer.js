// mater variable for height of pvjs viewer
var viewer_height = '500px';
var viewer_width = '800px';

/**
 *  After page is ready:
 *   1. Grab pwImage div; clean up <a>; remove <img>
 *   2. Prepare new divs inside thumbinner
 *   3. Animate window 
 *   4. load pvjs
 */
$(window).ready(function() {

	var img = $('#pwImage');
	if (img.get(0).nodeName.toLowerCase()!= 'img') {
		img = $('#pwImage img');
	}
	if (img.parent().is('a')){
		var oldParent=img.parent();
		var newParent=oldParent.parent();
		oldParent.after(img);
		oldParent.remove();
	}
	var container = $('<div />')
		.attr('id', 'pwImage_container')
		.css({width: viewer_width, height: viewer_height});
	var parent = img.parent();
	img.after(container);
	img.remove();

//	var layout=$('<div/>')
//		.attr('id', 'pwImage_layout')
//		.css({width:'100%',height:'100%'});
//	var viewer=$('<div/>')
//		.addClass('ui-layout-center')
//		.css({border:'1px solid #BBBBBB','background-color':'#FFFFFF'});
//	layout.append(viewer);

	var pvjs = $('<div/>')
		.attr('id','pwImage_pvjs')
		.css({width: viewer_width,height: viewer_height});
	container.append(pvjs);

        if (ie) { //Animate gives problems in IE, just change style directly
                parent.css({
                	idth: viewer_width,
                	eight: viewer_height
                });
                afterAnimate();
        } else { //Animate for smooth transition
                parent.animate({
                        width: viewer_width,
                        height: viewer_height
                }, 300, afterAnimate);
        }
	parent.css({
		padding: '3px 6px 30px 3px'
	});
	
      	var afterAnimate = function() {
		container.append(layout);
        	var pvjs=$('<div/>')
        		.attr('id','pwImage_pvjs');
        	layout.append(pvjs);

	};
}); 


// ----------------------------------------------------------
// A short snippet for detecting versions of IE in JavaScript
// without resorting to user-agent sniffing
// ----------------------------------------------------------
// If you're not in IE (or IE version is less than 5) then:
//     ie === undefined
// If you're in IE (>=5) then you can determine which version:
//     ie === 7; // IE7
// Thus, to detect IE:
//     if (ie) {}
// And to detect the version:
//     ie === 6 // IE6
//     ie > 7 // IE8, IE9 ...
//     ie < 9 // Anything less than IE9
// ----------------------------------------------------------

var ie = (function(){

    var undef,
        v = 3,
        div = document.createElement('div'),
        all = div.getElementsByTagName('i');

    while (
        div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
        all[0]
    );

    return v > 4 ? v : undef;

}());
