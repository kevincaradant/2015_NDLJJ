<?php

Asset::css('asset::jquery-ui.min.css', false, 'elfinder_standalone');
Asset::css('finder::elfinder.min.css', false, 'elfinder_standalone');
Asset::css('finder::theme.css', false, 'elfinder_standalone');

Asset::js('finder::jquery-1.11.1.min.js', false, 'elfinder_standalone');
Asset::js('asset::jquery-ui.min.js', false, 'elfinder_standalone');
Asset::js('finder::elfinder.min.js', false, 'elfinder_standalone');
Asset::js('finder::i18n/elfinder.fr.js', false, 'elfinder_standalone');

echo Asset::render_css('elfinder_standalone');
echo Asset::render_js('elfinder_standalone');

?>

<script type="text/javascript" charset="utf-8">
	$().ready(function(){
		var FileBrowserDialogue = {
			init: function() {},
			mySubmit: function (URL) {
				parent.tinymce.activeEditor.windowManager.getParams().setUrl(URL);
				parent.tinymce.activeEditor.windowManager.close();
			}
		};
		var elf = $('#elfinder').elfinder({
			url: '/admin/files/connector',
			lang: 'fr',
			disabled: ['extract', 'archive', 'search'],
			requestType: 'get',
			resizable: false,
			commands : ['open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook',
				'download', 'rm', 'rename', 'mkdir', 'upload', 'info', 'resize', 'sort'],
			onlyMimes: ["image/png", "image/jpeg", , "image/gif", "image/jpg", "application/pdf", "video/mp4", "video/mpeg", "video/quicktime","application/vnd.openxmlformats-officedocument.wordprocessingml.document"],
			uiOptions : {
				toolbar : [
					['back', 'forward'],
					['reload'],
					['home', 'up'],
					['mkdir', 'upload'],
					['open', 'download', 'getfile'],
					['info'],
					['quicklook'],
					['rm', 'rename', 'resize'],
				]
			},
			commandsOptions : {
				getfile: {
					onlyURL: false,
					multiple: false,
					folders: false,
					oncomplete: ''
				}
			},
			customData: {
				"<?= get_csrf_name(); ?>" : "<?= get_csrf(); ?>",
			},
			getFileCallback: function(file) {
				FileBrowserDialogue.mySubmit(file.url);
			}
		}).elfinder('instance');
	});
</script>

<div id="elfinder"></div>