(function() {
	tinymce.create('tinymce.plugins.GpfBox', {
		init : function(ed, url) {
			var t = this;

			ed.addCommand('mceGpfBox', function() {
				ed.windowManager.open({
					file : url + '/box.php',
					width : 780 + ed.getLang('gpfbox.delta_width', 0),
					height : 650 + ed.getLang('gpfbox.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			ed.addButton('gpfbox', {
				title : 'Insert Box',
				cmd : 'mceGpfBox',
				image : url+'/img/box.png'
				
			});

		},

		getInfo : function() {
			return {
				longname : "GPF Box",
				author : 'Adi Djohari',
				authorurl : 'http://profitstheme.com/',
				infourl : 'http://profitstheme.com/',
				version : "1.0"
			};
		}

	});
	tinymce.PluginManager.add('gpfbox', tinymce.plugins.GpfBox);
})();