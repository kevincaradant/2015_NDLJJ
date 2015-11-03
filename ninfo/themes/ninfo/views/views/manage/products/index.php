<?= $this->template->load_view('views/manage/products/_navigation'); ?>

<div class="container" id="manage_products">
    <div class="row">
        <h1 class="col-xs-12 col-sm-7">Liste des produits</h1>
        <div class="col-xs-12 col-sm-5" style="margin-top: 20px;"><span id="show_all_products" class="btn btn-info">Afficher les produits dévalidés</span></div>
        <table id="table_to_sort" class="col-xs-12 table table-striped table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <!--<th>Photo</th> -->
                    <th>Prix</th>
                    <th>Référence</th>
                    <th>Société</th>
                    <th><span class="glyphicon glyphicon-wrench"></span></th>
                    <th><span class="glyphicon glyphicon-lock"></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product) : ?>

                    <tr class='manage_product_el <?= ( $product->validate == -1 ) ? 'warning' : '' ?>' data-validate = "<?= $product->validate; ?>">
                        <td><?= $product->id; ?></td>
                        <td><?= $product->name; ?></td>
                       <!--  <td><?= $product->name; ?></td> -->
                        <td><?= $product->price; ?></td>
                        <td><?= $product->reference; ?></td>
                        <td><?= $product->society_name; ?></td>
                        <td><a title="Modifier" href="<?= site_url('admin/produits/modifier_produit/' . $product->id) .'/' . slugify($product->name); ?>"><span class="glyphicon glyphicon-cog"></span></a></td>
                        <td><a title="Modifier" href="<?= site_url('admin/produits/valider_produit/' . $product->id); ?>"><span class="validate_item glyphicon <?= ( $product->validate == 1 ) ? 'glyphicon-remove' : 'glyphicon-ok' ?>"></span></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>