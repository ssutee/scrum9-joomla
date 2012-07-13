//JS script for Joomla template
var siteurl = '';

function fixIEPNG(el, bgimgdf, sizingMethod, type, offset){
	var objs = el;
	if(!objs) return;
	if ($type(objs) != 'array') objs = [objs];
	if(!sizingMethod) sizingMethod = 'crop';
	if(!offset) offset = 0;
	var blankimg = siteurl + 'images/blank.png';
	objs.each(function(obj) {
		var bgimg = bgimgdf;
		if (obj.tagName == 'IMG') {
			//This is an image
			if (!bgimg) bgimg = obj.src;
			if (!(/\.png$/i).test(bgimg) || (/blank\.png$/i).test(bgimg)) return;

			obj.setStyle('height',obj.offsetHeight);
			obj.setStyle('width',obj.offsetWidth);
			obj.src = blankimg;
			obj.setStyle ('visibility', 'visible');
			obj.setStyle('filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src="+bgimg+", sizingMethod='"+sizingMethod+"')");
		}else{
			//Background
			if (!bgimg) bgimg = obj.getStyle('backgroundImage');
			var pattern = new RegExp('url\s*[\(\"\']*([^\'\"\)]*)[\'\"\)]*');
			if ((m = pattern.exec(bgimg))) bgimg = m[1];
			if (!(/\.png$/i).test(bgimg) || (/blank\.png$/i).test(bgimg)) return;
			if (!type)
			{
				obj.setStyle('background', 'none');
				//if(!obj.getStyle('position'))
				if(obj.getStyle('position')!='absolute' && obj.getStyle('position')!='relative') {
					obj.setStyle('position', 'relative');
				}

				//Get all child
				var childnodes = obj.childNodes;
				for(var j=0;j<childnodes.length;j++){
					if((child = $(childnodes[j]))) {
						if(child.getStyle('position')!='absolute' && child.getStyle('position')!='relative') {
							child.setStyle('position', 'relative');
						}
						child.setStyle('z-index',2);
					}
				}
				//Create background layer:
				var bgdiv = new Element('IMG');
				bgdiv.src = blankimg;
				bgdiv.width = obj.offsetWidth - offset;
				bgdiv.height = obj.offsetHeight - offset;
				bgdiv.setStyles({
					'position': 'absolute',
					'top': 0,
					'left': 0
				});

				bgdiv.className = 'TransBG';

				bgdiv.setStyle('filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src="+bgimg+", sizingMethod='"+sizingMethod+"')");
				bgdiv.inject(obj, 'top');
				//alert(obj.innerHTML + '\n' + bgdiv.innerHTML);
			} else {
				obj.setStyle('filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src="+bgimg+", sizingMethod='"+sizingMethod+"')");
			}
		}
	}.bind(this));

}

function isIE6() {
	version=0
	if (navigator.appVersion.indexOf("MSIE")!=-1){
		temp=navigator.appVersion.split("MSIE")
		version=parseFloat(temp[1])
	}
	return (version && (version < 7));
}


function getElementsByClass(searchClass,node,tag) {
	var classElements = new Array();
	var j = 0;
	if ( node == null )
		node = document;
	if ( tag == null )
		tag = '*';
	var els = node.getElementsByTagName(tag);
	var elsLen = els.length;
	var pattern = new RegExp('(^|\\s)'+searchClass+'(\\s|$)');
	for (var i = 0; i < elsLen; i++) {
		if ( pattern.test(els[i].className) ) {
			classElements[j] = els[i];
			j++;
		}
	}
	return classElements;
}

/* Add class to tag LI */
jvAddClassToMainmenu = function() {
	lis = $E('#menusys_moo li');
	if(lis) {
		lis.addClass('li-first');
	}
}

window.addEvent ('load', function() {
	if($('jvbacktotop')) {
		var winScroller = new Fx.Scroll(window);
		$('jvbacktotop').addEvent('click', function(e) {
			e = new Event(e).stop();
			winScroller.toTop();
		});
	}
});

function trim(str)
{
    if(!str || typeof str != 'string')
        return null;

    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
}

window.addEvent('load', function(){

	var StyleCookie = new Hash.Cookie('JVEotyStyleCookieSite');
	var settings = { colors: '' };
	var style_1, style_2, style_3;
	new Asset.css(StyleCookie.get('colors'));

	/* Style 1 */
	if($('jvcolor1')){$('jvcolor1').addEvent('click', function(e) {
		e = new Event(e).stop();
		if (style_1) style_1.remove();
		new Asset.css(jvpathcolor + 'green.css', {id: 'green'});
		style_1 = $('green');
		settings['colors'] = jvpathcolor + 'green.css';
		StyleCookie.empty();
		StyleCookie.extend(settings);
	});}

	/* Style 2 */
	if($('jvcolor2')){$('jvcolor2').addEvent('click', function(e) {
		e = new Event(e).stop();
		if (style_2) style_2.remove();
		new Asset.css(jvpathcolor + 'blue.css', {id: 'blue'});
		style_2 = $('blue');
		settings['colors'] = jvpathcolor + 'blue.css';
		StyleCookie.empty();
		StyleCookie.extend(settings);
	});}

	/* Style 3 */
	if($('jvcolor3')){$('jvcolor3').addEvent('click', function(e) {
		e = new Event(e).stop();
		if (style_3) style_3.remove();
		new Asset.css(jvpathcolor + 'red.css', {id: 'red'});
		style_3 = $('red');
		settings['colors'] = jvpathcolor + 'red.css';
		StyleCookie.empty();
		StyleCookie.extend(settings);
	});}

});

function hide_nocontent(){
	var title = $('jv-maincontent');
	if (title) {
		var titlestring = "a" + trim(title.innerHTML);
		if (titlestring.length <= 15) {
			$('mdl-content').setStyle('display','none');
		}
	}
}

