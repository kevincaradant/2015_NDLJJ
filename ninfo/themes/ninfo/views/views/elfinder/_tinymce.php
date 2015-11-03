<script type="text/javascript" src="<?php asset_url('elfinder/js/jquery.183.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php asset_url('jquery-ui/css/jquery-ui.min.css'); ?>">
<script type="text/javascript" src="<?php asset_url('jquery-ui/js/jquery-ui.min.js'); ?>"></script>

<link rel="stylesheet" type="text/css" media="screen" href="<?php asset_url('elfinder/css/elfinder.min.css'); ?>">
<link rel="stylesheet" type="text/css" media="screen" href="<?php asset_url('elfinder/css/theme.css'); ?>">
<script type="text/javascript" src="<?php asset_url('elfinder/js/elfinder.min.js'); ?>"></script>
<script type="text/javascript" src="<?php asset_url('elfinder/js/i18n/elfinder.fr.js'); ?>"></script>

<script type="text/javascript" charset="utf-8">
	var FileBrowserDialogue = {
		init: function() {

		},
		mySubmit: function (URL) {
			parent.tinymce.activeEditor.windowManager.getParams().setUrl(URL);
			parent.tinymce.activeEditor.windowManager.close();
		}
	}

	$().ready(function(){
		var elf = $('#elfinder').elfinder({
			url: '/files/connector',
			disabled: ['extract', 'archive', 'search'],
			customData: { "<?= get_csrf_name(); ?>" : "<?= get_csrf(); ?>" },
			uiOptions : {
				toolbar : [
					['back', 'forward'],
					['reload'],
					['home', 'up'],
					['mkdir', 'mkfile', 'upload'],
					['open', 'download', 'getfile'],
					['info'],
					['quicklook'],
					['copy', 'cut', 'paste'],
					['rm'],
					['duplicate', 'rename', 'edit', 'resize'],
					['view']
				]
			},
			getFileCallback: function(file) {
				FileBrowserDialogue.mySubmit(file);
			}
		}).elfinder('instance');
	});
</script>

<div id="elfinder"></div>