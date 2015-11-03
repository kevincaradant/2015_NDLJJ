<?= $this->template->load_view('views/elfinder/assets'); ?>

<script type="text/javascript" charset="utf-8">
	$().ready(function(){
		var elf = $('#elfinder').elfinder({
			url: '/admin/files/connector',
			lang: 'fr',
			disabled: ['extract', 'archive', 'search'],
			requestType: 'get',
			resizable: false,
			commands : ['open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook', 
    		'download', 'rm', 'rename', 'mkdir', 'upload', 'info', 'resize', 'sort'],
			onlyMimes: ["image/png", "image/jpeg", , "image/gif", "image/jpg", "application/pdf", "video/mp4", "video/mpeg", "video/quicktime","application/vnd.openxmlformats-officedocument.wordprocessingml.document"],
			customData: { "<?= get_csrf_name(); ?>" : "<?= get_csrf(); ?>" },
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
			}
		}).elfinder('instance');
	});
</script>

<div id="elfinder"></div>