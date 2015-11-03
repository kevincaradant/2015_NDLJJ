<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <?php
        /*Asset::css('asset::bootstrap.min.css', false, 'admin');
        Asset::css('asset::animate.css', false, 'admin');
        Asset::css('theme::manage.css', false, 'admin');

        Asset::js('asset::jquery.1.11.1.min.js', false, 'admin');
        Asset::js('asset::bootstrap.min.js', false, 'admin');
        echo Asset::render_css('admin');
        echo Asset::render_js('admin'); */
    ?>
    <link rel="stylesheet" href="<?= css_asset_url('bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= css_asset_url('animate.css'); ?>">
    <link rel="stylesheet" href="<?= css_asset_url('chosen.min.css'); ?>">
    <link rel="stylesheet" href="<?= css_path('manage.css'); ?>">

    <script type="text/javascript" src="<?= js_asset_url('jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?=js_asset_url('jquery.tablesorter.min.js'); ?>"></script>
    <script type="text/javascript" src="<?=js_asset_url('bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?=js_asset_url('chosen.jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?=js_path('manage.js'); ?>"></script>




</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav nav-pills">
                    <li>
                        <a href="<?= site_url(); ?>admin/clients">Clients</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="content">
        <?= $this->template->load_view('partials/alert'); ?>
        <?= $template['body']; ?>
    </div>
</body>
</html>