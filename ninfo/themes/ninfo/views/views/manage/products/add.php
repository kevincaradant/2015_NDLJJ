<?= $this->template->load_view('views/elfinder/assets'); ?>
<?= $this->template->load_view('views/manage/products/_navigation'); ?>
<div class="container">
    <div class="row">
        <h1 class="col-xs-12">Ajouter un produit</h1>
        <?= form_open(current_url(), array('role' => 'form','class' => 'form-horizontal col-xs-12')); ?>
        <fieldset>
            <legend>Données requises</legend>
            <div class="form-group">
                <label for="name">Nom *:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>">
                <label for="price">Prix HT *:</label>
                <input type="number" step="any" class="form-control" id="price" name="price" value="<?= set_value('price'); ?>">
                <label for="price_ttc">Prix TTC *:</label>
                <input type="number" step="any" class="form-control" id="price_ttc" name="price_ttc" value="<?= set_value('price_ttc'); ?>">
                <label for="lot">Lot:</label>
                <input type="number" step="any" class="form-control" id="lot" name="lot" value="<?= set_value('lot'); ?>">
                <label for="reference">Référence:</label>
                <input type="text" class="form-control" id="reference" name="reference" value="<?= set_value('reference'); ?>">
                <br/>
                <label for="entreprise">Société:</label>
                <select name="entreprise" id="entreprise">
                    <?php foreach($entreprises as $entreprise) : ?>
                        <option value="<?= $entreprise->id; ?>"><?= $entreprise->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <?= $this->template->load_view('views/tinymce/full'); ?>
                <textarea class="form-control tinymce" id="description" name="description"><?= set_value('description'); ?></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <?php
                $file_options = array(
                    'file_opts' => array(
                        'input' => array(
                            'class' => 'form-control',
                            'placeholder' => "photo",
                            'id' => 'photo',
                            'name' => 'photo',
                            'value' => set_value('photo'),
                            'data-toggle' => 'help',
                            'data-content' => "Utilisé comme photo principal, merci de ne pas mettre une image trop lourde"
                        )
                    )
                );
                echo $this->template->load_view('views/elfinder/file_select', $file_options);
                ?>
            </div>
            <div class="form-group">
                <label for="is_vedette">Mise en avant:</label>
                <select name="is_vedette" id="is_vedette">
                    <option value="0">Non</option>
                    <option value="1">Oui</option>
                </select>
            </div>
        </fieldset>


        <div class="col-xs-4 col-xs-offset-4">
            <button type="submit" class="btn btn-block btn-success" name="product_add_form" value="sent">
                Créer produit
            </button>
        </div>
        <?= form_close(); ?>
    </div>
</div>