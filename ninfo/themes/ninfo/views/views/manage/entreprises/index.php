<?= $this->template->load_view('views/manage/entreprises/_navigation'); ?>
<h1>Liste des entreprises</h1>
<div class="container">
    <div class="row">
        <table class="col-xs-12 table table-striped table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Descriptif</th>
                    <!--<th>Photo</th> -->
                    <th><span class="glyphicon glyphicon-wrench"></span></th>
                    <th><span class="glyphicon glyphicon-lock"></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($entreprises as $entreprise) : ?>
                    <tr class='<?= ( $entreprise->validate == -1 ) ? 'warning' : '' ?>'>
                        <td><?= $entreprise->id; ?></td>
                        <td><?= $entreprise->name; ?></td>
                        <td><?= $entreprise->short_descriptif; ?></td>
                        <td><a title="Modifier" href="<?= site_url('admin/entreprises/modifier_entreprise/' . $entreprise->id) .'/' . slugify($entreprise->name); ?>"><span class="glyphicon glyphicon-cog"></span></a></td>
                        <td><a title="Modifier" href="<?= site_url('admin/entreprises/valider_entreprise/' . $entreprise->id); ?>"><span class="validate_item glyphicon <?= ( $entreprise->validate == 1 ) ? 'glyphicon-remove' : 'glyphicon-ok' ?>"></span></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>