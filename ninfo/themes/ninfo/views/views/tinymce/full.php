<script type="text/javascript" src="<?php echo asset_url('tinymce/tinymce.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	function elFinderBrowser (field_name, url, type, win) {
		tinymce.activeEditor.windowManager.open({
			file: '/admin/files/tinymce',
			title: 'Gestionnaire de fichier',
			width: 900,  
			height: 450,
			resizable: 'yes'
		}, {
			setUrl: function (url) {
				win.document.getElementById(field_name).value = url;
			}
		});
		return false;
	}

	tinymce.init({
	    selector: "textarea.tinymce",
	    language: 'fr_FR',
	    height: 300,
	    file_browser_callback : elFinderBrowser,
	    removed_menuitems: 'newdocument',
	    extended_valid_elements: 'i[class],div[id|class],a[target|class|id|href|title]',
	    plugins: [
         "advlist image autolink link lists charmap print preview hr anchor",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality paste textcolor colorpicker"
		],
	    toolbar: "undo redo | styleselect | bold underline italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | fullpage | forecolor backcolor",
		/*content_css: '<?= css_path('style.css'); ?>',*/
		style_formats: [
			{title: 'Titres', items: [
				{title: 'h1', block: 'h1'},
				{title: 'h2', block: 'h2'},
				{title: 'h3', block: 'h3'},
				{title: 'h4', block: 'h4'},
				{title: 'h5', block: 'h5'},
				{title: 'h6', block: 'h6'}
			]},
			{title: 'Blocs', items: [
				{title: 'p', block: 'p'},
				{title: 'div', block: 'div'},
				{title: 'pre', block: 'pre'}
			]}
		]
	});
});
</script>
