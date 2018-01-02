(function() {
	tinymce.create('tinymce.plugins.ActionButtons', {
		init : function(ed, url) {
			ed.addCommand('mceActionButtons', function() {
				ed.windowManager.open({
					file : url + '/actionbuttons.php',
					width : 750 + ed.getLang('actionbuttons.delta_width', 0),
					height : 650 + ed.getLang('actionbuttons.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			ed.addButton('actionbuttons', {
				title : 'Insert Buttons',
				cmd : 'mceActionButtons',
				image : url+'/img/actionbuttons.png'
				
			});

			ed.onNodeChange.add(function(ed, cm, n) {
				
			});

		},

		getInfo : function() {
			return {
				longname : "GPF Action Buttons",
				author : 'Adi Djohari',
				authorurl : 'http://profitstheme.com/',
				infourl : 'http://profitstheme.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('actionbuttons', tinymce.plugins.ActionButtons);
})();