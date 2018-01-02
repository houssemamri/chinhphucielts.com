(function() {

	tinymce.create('tinymce.plugins.GpfSalesTools', {
		init : function(ed, url) {
		  
            // arrow style 1
            ed.addCommand('mceGreenArrow', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'greenarrow');
			});

			ed.addCommand('mceRedArrow', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'redarrow');
			});

			ed.addCommand('mceBlueArrow', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'bluearrow');
			});
            // arrow style 2
            ed.addCommand('mceGreenArrow2', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'greenarrow2');
			});

			ed.addCommand('mceRedArrow2', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'redarrow2');
			});

			ed.addCommand('mceBlueArrow2', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'bluearrow2');
			});

	
			// Check style 1
            ed.addCommand('mceGreenCheck', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'greencheck');
			});

			ed.addCommand('mceRedCheck', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'redcheck');
			});

			ed.addCommand('mceBlueCheck', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'bluecheck');
			});
            
            // Check style 2
            ed.addCommand('mceGreenCheck2', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'greencheck2');
			});

			ed.addCommand('mceRedCheck2', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'redcheck2');
			});

			ed.addCommand('mceBlueCheck2', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'bluecheck2');
			});
            
            // Bullet
			ed.addCommand('mceRedBullets', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'redbullet');
			});
            // Cross
			ed.addCommand('mceGreenCross', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'greencross');
			});
            ed.addCommand('mceRedCross', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'redcross');
			});
            ed.addCommand('mceBlueCross', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('InsertUnorderedList');

				list = dom.getParent(sel.getNode(), 'ul');
				dom.addClass(list, 'bluecross');
			});


			ed.addCommand('mceHighlighter', function() {
				var list, dom = ed.dom, sel = ed.selection;

				ed.execCommand('mceReplaceContent', false, '<span style="background: #FFFF00;">{$selection}</span>');

			});

			ed.addCommand('mceSalesGraphics', function() {
				ed.windowManager.open({
					file : url + '/graphics.php',
					width : 820 + ed.getLang('gpfbox.delta_width', 0),
					height : 520 + ed.getLang('gpfbox.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			ed.addCommand('mceFlashVideo', function() {
				ed.windowManager.open({
					file : url + '/video.php',
					width : 480 + ed.getLang('gpfbox.delta_width', 0),
					height : 230 + ed.getLang('gpfbox.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});
            // arrow
           	ed.addButton('gpfsalestoolspt', {
				title : 'Green Arrow Bullets',
				image : url+'/img/greenarrow.png',
				cmd : 'mceGreenArrow'
			});

			ed.addButton('gpfsalestoolspt2', {
				title : 'Red Arrow Bullets',
				image : url+'/img/redarrow.png',
				cmd : 'mceRedArrow'
			});

			ed.addButton('gpfsalestoolspt3', {
				title : 'Blue Arrow Bullets',
				image : url+'/img/bluearrow.png',
				cmd : 'mceBlueArrow'
			});
            
            
           	ed.addButton('gpfsalestoolspt_2', {
				title : 'Green Arrow Bullets 2',
				image : url+'/img/greenarrow2.png',
				cmd : 'mceGreenArrow2'
			});

			ed.addButton('gpfsalestoolspt2_2', {
				title : 'Red Arrow Bullets 2',
				image : url+'/img/redarrow2.png',
				cmd : 'mceRedArrow2'
			});

			ed.addButton('gpfsalestoolspt3_2', {
				title : 'Blue Arrow Bullets 2',
				image : url+'/img/bluearrow2.png',
				cmd : 'mceBlueArrow2'
			});


            // checklist
			ed.addButton('gpfsalestoolspt4', {
				title : 'Green Checklist Bullets',
				image : url+'/img/greencheck.png',
				cmd : 'mceGreenCheck'
			});

			ed.addButton('gpfsalestoolspt5', {
				title : 'Red Checklist Bullets',
				image : url+'/img/redcheck.png',
				cmd : 'mceRedCheck'
			});

			ed.addButton('gpfsalestoolspt6', {
				title : 'Blue Checklist Bullets',
				image : url+'/img/bluecheck.png',
				cmd : 'mceBlueCheck'
			});
  	         ed.addButton('gpfsalestoolspt4_2', {
				title : 'Green Checklist Bullets 2',
				image : url+'/img/greencheck2.png',
				cmd : 'mceGreenCheck2'
			});

			ed.addButton('gpfsalestoolspt5_2', {
				title : 'Red Checklist Bullets 2',
				image : url+'/img/redcheck2.png',
				cmd : 'mceRedCheck2'
			});

			ed.addButton('gpfsalestoolspt6_2', {
				title : 'Blue Checklist Bullets 2',
				image : url+'/img/bluecheck2.png',
				cmd : 'mceBlueCheck2'
			});
            
            // Cross
			ed.addButton('gpfsalestoolspt8', {
				title : 'Green Stop Cross',
				image : url+'/img/greencross.png',
				cmd : 'mceGreenCross'
			});
            ed.addButton('gpfsalestoolspt9', {
				title : 'Red Stop Cross',
				image : url+'/img/redcross.png',
				cmd : 'mceRedCross'
			});
            ed.addButton('gpfsalestoolspt10', {
				title : 'Blue Stop Cross',
				image : url+'/img/bluecross.png',
				cmd : 'mceBlueCross'
			});

			 // Bullets
			ed.addButton('gpfsalestoolspt7', {
				title : 'Red Stop Bullets',
				image : url+'/img/redstop.png',
				cmd : 'mceRedBullets'
			});
			
            // options
			ed.addButton('gpfsalestoolspt97', {
				title : 'Yellow Highlighter',
				image : url+'/img/highlighter.png',
				cmd : 'mceHighlighter'
			});

			ed.addButton('gpfsalestoolspt98', {
				title : 'Insert Sales Graphics',
				image : url+'/img/graphics.png',
				cmd : 'mceSalesGraphics'
			});

			ed.addButton('gpfsalestoolspt99', {
				title : 'Embed Flash Video',
				image : url+'/img/video.png',
				cmd : 'mceFlashVideo'
			});

		},

		getInfo : function() {
			return {
				longname : "GPF Graphic Bullets",
				author : 'Adi Djohari',
				authorurl : 'http://profitstheme.com/',
				infourl : 'http://profitstheme.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('gpfsalestoolspt', tinymce.plugins.GpfSalesTools);
})();