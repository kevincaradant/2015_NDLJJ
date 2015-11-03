<?php $fid = md5(uniqid().time()); // Chaine aléatoire pour créer des instances uniques ?>

<?php

switch (@$file_opts['finder_type'])
{
	default :
		$type = 'default';
	break;
}

switch (@$file_opts['finder_select'])
{
	case 'folder' :
		$select = 'folder';
	break;

	default :
		$select = 'default';
	break;
}





?>
<link rel="stylesheet" href="<?= css_asset_url('jquery-ui.min.css'); ?>">
<link rel="stylesheet" href="<?= elfinder_css_url('elfinder.min.css'); ?>">
<link rel="stylesheet" href="<?= elfinder_css_url('theme.css'); ?>">

<script type="text/javascript" src="<?=elfinder_js_url('jquery-1.11.1.min.js'); ?>"></script>

<script type="text/javascript" src="<?= js_asset_url('jquery-ui.min.js'); ?>"></script>
<script type="text/javascript" src="<?=elfinder_js_url('elfinder.min.js'); ?>"></script>
<script type="text/javascript" src="<?=elfinder_js_url('i18n/elfinder.fr.js'); ?>"></script>


<script type="text/javascript">
$(function($){
	$('button#choose_<?= $fid; ?>').on('click', function(){
		// Si une insctance d'elFinder existe déjà on l'ouvre
		if ($('#finder_<?= $fid; ?> div.elfinder-workzone').length > 0) {
			$('#finder_<?= $fid; ?>').elfinder('open');
		} else {
			var elf = $('#finder_<?= $fid; ?>').elfinder({
				url: '/admin/files/connector',
				lang: 'fr',
				disabled: ['extract', 'archive', 'search'],
				requestType: 'get',
				resizable: false,
				commands : ['open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook', 
	    		'download', 'rm', 'rename', 'mkdir', 'upload', 'info', 'resize', 'sort'],
				onlyMimes: ["image/png", "image/jpeg", "image/gif", "image/jpg", "application/pdf", "video/mp4", "video/mpeg", "video/quicktime","application/vnd.openxmlformats-officedocument.wordprocessingml.document"],
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
				customData: {
					'<?= get_csrf_name(); ?>' : '<?= get_csrf(); ?>'
				},
				commandsOptions : {
					getfile: {
						onlyURL: false,
						multiple: false,
						folders: true,
					}
				},
				getFileCallback: function(url) {
					var image_url  = url.url;
					var image_uri  = image_url.replace(url.baseUrl, '');
					$('div#input_<?= $fid; ?> input').attr('value', image_uri);
					$('div#input_<?= $fid; ?> #preview_<?= $fid; ?>').data('content', image_uri);
					$('#view_<?= $fid; ?>').hide();
					$('#finder_<?= $fid; ?>').hide();
				}
			}).elfinder('instance');
		}
	});
	<?php if ($type == 'default') : ?>
	$('button#preview_<?= $fid; ?>').on('click', function(e){
		e.preventDefault();
		if ($(this).data('content').length > 0) {
			var image_html = '<img src="<?= base_url(); ?>assets/files/' + $(this).data('content') + '" style="max-height:300px;" />';
			$('#view_<?= $fid; ?>').html(image_html).toggle();
		} else {
			alert("Veuillez sélectionner une image...");
		}
		return false;
	});
	$('button#delete_<?= $fid; ?>').on('click', function(e){
		e.preventDefault();
		if ($('div#input_<?= $fid; ?> input').val().length > 0) {
			if (confirm("Etes-vous sûr de vouloir retirer l'image ?")) {
				$('div#input_<?= $fid; ?> input').val('');
				$('div#input_<?= $fid; ?> #preview_<?= $fid; ?>').data('content', '');
			}
		} else {
			alert("Il n'y a pas d'image à retirer");
		}
		return false;
	});
	<?php endif; ?>
});
</script>

<div class="input-group" id="input_<?= $fid; ?>">
	<?= form_input($file_opts['input']); ?>
	<div class="input-group-btn">
		<?php if ($type == 'default') : ?>
		<button type="button" class="btn btn-default" id="choose_<?= $fid; ?>" tabindex="-1">
			Choisir un fichier <span class="caret"></span>
		</button>
		<?php else : ?>
		<button type="button" class="btn btn-default" id="choose_<?= $fid; ?>" tabindex="-1">
			Choisir un dossier <span class="caret"></span>
		</button>
		<?php endif; ?>
	</div>
</div>

<div class="row" style="margin-top:10px;">
	<div class="col-xs-12">
		<div id="view_<?= $fid; ?>" style="max-width:100%;display:none;margin:0 auto;text-align:center;"></div>
		<div id="finder_<?= $fid; ?>"></div>	
	</div>
</div>