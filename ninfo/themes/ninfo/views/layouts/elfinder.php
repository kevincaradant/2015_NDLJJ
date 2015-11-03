<!DOCTYPE html>
<html lang="fr">
	<head>
		<title><?= $template['title']; ?></title>
		<base href="<?=base_url();?>">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<script type="text/javascript">
			var SITE_URL = <?= '"'.base_url().'"'; ?>;
		</script>
	</head>
	<body>

	<?php echo $template['body']; ?>

	</body>
</html>