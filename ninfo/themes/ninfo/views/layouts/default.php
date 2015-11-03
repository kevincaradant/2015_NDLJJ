<!DOCTYPE html>
<html lang="fr">
    <?= $template['partials']['metadata']; ?>
    <body>
     <?= $template['partials']['header']; ?>
        <div id="content">
            <?= $this->template->load_view('partials/alert'); ?>
            <?= $template['body']; ?>
        </div>
        <?= $template['partials']['footer']; ?>
    </body>
</html>