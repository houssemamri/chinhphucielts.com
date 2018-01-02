/*
 * onUserExit jQuery Plugin (http://www.userfirstinteractive.com/)
 * @author Scott D. Brooks 
 * @created by UserFirst Interactive (creations@userfirstinteractive.com)
 * 
 * @version 1.1
 * 
 * @changelog
 * v 1.0 	->	Starting release [Dec. 27, 2008]
 * v 1.1 	->	Added support for detection of page refresh through F5 key and ctrl+r. 
			Added support for forms as well, so submissions don't trigger exit event. [Jan. 25, 2010]
 * 
 */
var movingWithinSite = false;  // this is the var that determines if the unload was caused by a user leaving, or navigating in the site.
var codeToExecute	= function() {};
var textMsg		= "";

function userMovingWithinSite() {
	movingWithinSite = true;
}

function UnPopIt(){ /* nothing to return */ } 

// Code to detect refreshing of the page through keyboard use
var ctrlKeyIsDown = false;
function interceptKeyUp(e) {
	if( !e ) {
		if (window.event)
			e = window.event;
		else 
			return;
	}
	
	keyCode = e.keyCode;	
	if (keyCode == 17){
		ctrlKeyIsDown = false;
	}
}

function interceptKeyDown(e) {
	if( !e ) {
		if (window.event)
			e = window.event;
		else
			return;
	}
	
	keyCode = e.keyCode;
	// F5 detected
	if ( keyCode == 116 ) {
		userMovingWithinSite();
	}
	
	if (keyCode == 17){
		ctrlKeyIsDown = true;
	}

	// then they are pressing Ctrl+R
	if (ctrlKeyIsDown && keyCode == 82){	
		userMovingWithinSite();
	}	
}

function interceptKeyPress(e) {
	if( !e ) {
		if (window.event)
			e = window.event;
		else
			return;
	}

	var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : void 0;
	if(e.charCode == null || e.charCode == 0 ) {
		// F5 pressed
		if ( keyCode == 116 ) {
			userMovingWithinSite();
		}
	}
}

function attachEventListener( obj, type, func, capture ) {
	if(window.addEventListener) {
		//Mozilla, Netscape, Firefox
		obj.addEventListener( type, func, capture );
	} else {
		//IE
		obj.attachEvent( 'on' + type, func );
	}
}

(function($){	
	$.fn.onUserExit = function(options) {		
		var defaults = {
			execute: "", // no function assigned by default
			instruction: "Do you want to leave this site?"
		};
		var options = $.extend(defaults, options);
		
		if (options.execute == "") {
			alert("The onUserExit jQuery Plugin has been misconfigured.  Please add the function you wish to execute.");
		}
		
		codeToExecute = options.execute;
		textMsg = options.instruction;
	
		// add onClick function to all internal links
		jQuery("a").each(function() {
			var obj = jQuery(this);
			if ( obj.attr('target') != '_blank' ) {
				obj.bind("click", function(){
					userMovingWithinSite();
    			});
			}
		});

		jQuery("form").each(function() {
			var obj = jQuery(this);
			currentonSubmit = obj.attr("onSubmit");	
			if (currentonSubmit === undefined) {
				currentonSubmit = "";
			}
			obj.attr("onSubmit", "userMovingWithinSite(); " + currentonSubmit);
		});		

		// for Refresh Detection
		attachEventListener(document, "keydown", interceptKeyDown, true);
		attachEventListener(document, "keyup", interceptKeyUp, true);
		attachEventListener(document, "keypress", interceptKeyPress, true);	
	};
	
	jQuery(window).unbind('beforeunload').bind('beforeunload', function(e) {
		// unloading the page when the user is leaving
		if ( movingWithinSite == false ) {
			e.preventDefault();
			e.stopImmediatePropagation();
			e.stopPropagation();
			
			codeToExecute();
			movingWithinSite = true;
			return textMsg;
		}
	});
	
		
})(jQuery);
