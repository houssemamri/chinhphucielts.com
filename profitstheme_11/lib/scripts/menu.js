sfHover = function() {
	var sfEls = document.getElementById("nav1").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
}

sfHover1 = function() {
	var sfEls = document.getElementById("nav2").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover1";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover1\\b"), "");
		}
	}
}

if (window.attachEvent) window.attachEvent("onload", sfHover);
if (window.attachEvent) window.attachEvent("onload", sfHover1);