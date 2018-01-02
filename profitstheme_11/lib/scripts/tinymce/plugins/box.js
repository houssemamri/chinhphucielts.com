tinyMCEPopup.requireLangPack();

var GpfBoxDialog = {
	init: function() {
		var ed = tinyMCEPopup.editor, f = document.forms[0], dom = ed.dom, n = ed.selection.getNode();

		tinyMCEPopup.resizeToInnerSize();
	},

	insert: function() {
		var ed   = tinyMCEPopup.editor, f = document.forms[0], w = f.gpfjboxwidth.value;
		var ptb  = f.gpfjboxpadtb.value, plr = f.gpfjboxpadlr.value;
		var btn  = f.gpfjboxbtn.value, person = f.gpfjboxperson.value, ecover = f.gpfjboxecover.value;
		var tmpl = f.gpfjboxtemplate.options[f.gpfjboxtemplate.options.selectedIndex].value;
	
		var h = '<!-- PT BOX START HERE -->';
		var template = '';
		var label = '';
		
		if ( tmpl == 'buynow' ) {
			label += 'Limited Offer';

			template += '<div class="jboxprice">Only $XX</div>';
			template += '<p class="jboxsubhead">One Time Payment - Instant Access!</p>';
			template += '<p class="jboxbtn"><img src="' + btn + '" border="0" /></p>';
			template += '<p class="jboxsubhead">Instant Download - Even at 2 am</p>';
			template += '<p class="jboxtext"><small>All Major Credit Card, Paypal, and Online Checks Accepted<br />Order 24 Hours a Day, 7 Days a Week</small></p>';
		} else if ( tmpl == 'testimonial' ) {
			label += 'What People Are Saying...';

			template += '<p class="jboxcommhead">"Your Customer\'s Testimonial Title Here"</p>';
			template += '<p><img src="' + person + '" border="0" class="alignleft" style="margin-right:10px" />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce est eros, commodo quis consequat vitae, lobortis in massa. In ut consequat purus.</p>';
			template += '<p>Nullam vitae odio quam, id tempus ligula. Integer eget quam erat, non viverra sem. Vivamus laoreet accumsan ante sit amet pharetra.</p>';
			template += '<p><strong>- John Doe</strong><br />www.johndoe.com</p>';
		} else if ( tmpl == 'product' ) {
			label += 'Module x';

			template += '<p class="jboxcommhead">"Module x: Product\'s Title Here"</p>';
			template += '<p><img src="' + ecover + '" border="0" class="alignleft" style="margin-right:10px" />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce est eros, commodo quis consequat vitae, lobortis in massa. In ut consequat purus.</p>';
			template += '<p>Nullam vitae odio quam, id tempus ligula. Integer eget quam erat, non viverra sem. Vivamus laoreet accumsan ante sit amet pharetra.</p><br style="clear:left" />';
			template += '<ul class="greencheck"><li>Benefit 1 here...</li><li>Benefit 2 here...</li><li>Benefit 3 here...</li><li>Benefit 4 here...</li></ul>';
		} else {
			label += 'Box Headline Here'; 

			template += '<p>You can type some content here</p>';
		}

		for (var i=0; i < f.gpfjbox.length; i++) {
   			if (f.gpfjbox[i].checked) {

				var v = f.gpfjbox[i].value;

				switch (v) {
					default:
						h += '<div id="jbox" class="' + v + '" style="width:' + w + 'px;padding:' + ptb + 'px ' + plr + 'px;">';
                        h += '<div class="element-box"></div>';
						h += template;
						break;

					case "greybox7":
						h += '<div id="jbox" class="greybox7" style="width:'+ w +'px;">';
						h += '<div class="greybox7-head" style="margin:0;padding:7px '+ plr +'px;"><strong>' + label + '</strong></div>';
						h += '<div class="greybox7-content" style="padding:'+ ptb +'px '+ plr +'px;">';
						h += template;
						h += '</div>';
						break;

					case "bluebox7":
						h += '<div id="jbox" class="bluebox7" style="width:'+ w +'px;padding:0;">';
						h += '<div class="bluebox7-head" style="margin:0;padding:7px '+ plr +'px;"><span style="color:#FFF;"><strong>' + label + '</strong></span></div>';
						h += '<div class="bluebox7-content" style="padding:'+ ptb +'px '+ plr +'px;">';
						h += template;
						h += '</div>';
						break;

					case "greenbox7":
						h += '<div id="jbox" class="greenbox7" style="width:'+ w +'px;">';
						h += '<div class="greenbox7-head" style="margin:0;padding:7px '+ plr +'px;"><span style="color:#FFF;"><strong>' + label + '</strong></span></div>';
						h += '<div class="greenbox7-content" style="padding:'+ ptb +'px '+ plr +'px;">';
						h += template;
						h += '</div>';
						break;

					case "orangebox7":
						h += '<div id="jbox" class="orangebox7" style="width:'+ w +'px;">';
						h += '<div class="orangebox7-head" style="margin:0;padding:7px '+ plr +'px;"><span style="color:#FFF;"><strong>' + label + '</strong></span></div>';
						h += '<div class="orangebox7-content" style="padding:'+ ptb +'px '+ plr +'px;">';
						h += template;
						h += '</div>';
						break;

					case "redbox7":
						h += '<div id="jbox" class="redbox7" style="width:'+ w +'px;">';
						h += '<div class="redbox7-head" style="margin:0;padding:7px '+ plr +'px;"><span style="color:#FFF;"><strong>' + label + '</strong></span></div>';
						h += '<div class="redbox7-content" style="padding:'+ ptb +'px '+ plr +'px;">';
						h += template;
						h += '</div>';
						break;
                    
                    // box 14
                    
                    case "greybox14":
						h += '<div id="jbox" class="greybox14" style="width:'+ w +'px;">';
						h += '<div class="greybox14-head" style="margin:0;padding:7px '+ plr +'px;"><strong>' + label + '</strong></div>';
						h += '<div class="greybox14-content" style="padding:'+ ptb +'px '+ plr +'px;">';
						h += template;
						h += '</div>';
						break;

					case "bluebox14":
						h += '<div id="jbox" class="bluebox14" style="width:'+ w +'px;padding:0;">';
						h += '<div class="bluebox14-head" style="margin:0;padding:7px '+ plr +'px;"><span style="color:#FFF;"><strong>' + label + '</strong></span></div>';
						h += '<div class="bluebox14-content" style="padding:'+ ptb +'px '+ plr +'px;">';
						h += template;
						h += '</div>';
						break;

					case "greenbox14":
						h += '<div id="jbox" class="greenbox14" style="width:'+ w +'px;">';
						h += '<div class="greenbox14-head" style="margin:0;padding:7px '+ plr +'px;"><span style="color:#FFF;"><strong>' + label + '</strong></span></div>';
						h += '<div class="greenbox14-content" style="padding:'+ ptb +'px '+ plr +'px;">';
						h += template;
						h += '</div>';
						break;

					case "orangebox14":
						h += '<div id="jbox" class="orangebox14" style="width:'+ w +'px;">';
						h += '<div class="orangebox14-head" style="margin:0;padding:7px '+ plr +'px;"><span style="color:#FFF;"><strong>' + label + '</strong></span></div>';
						h += '<div class="orangebox14-content" style="padding:'+ ptb +'px '+ plr +'px;">';
						h += template;
						h += '</div>';
						break;

					case "redbox14":
						h += '<div id="jbox" class="redbox14" style="width:'+ w +'px;">';
						h += '<div class="redbox14-head" style="margin:0;padding:7px '+ plr +'px;"><span style="color:#FFF;"><strong>' + label + '</strong></span></div>';
						h += '<div class="redbox14-content" style="padding:'+ ptb +'px '+ plr +'px;">';
						h += template;
						h += '</div>';
						break;
				}		
			}
		}
		
		h += '</div>';
		h += '<!-- PT BOX END HERE -->';
			
		ed.execCommand('mceInsertRawHTML', true, h);

		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(GpfBoxDialog.init, GpfBoxDialog);