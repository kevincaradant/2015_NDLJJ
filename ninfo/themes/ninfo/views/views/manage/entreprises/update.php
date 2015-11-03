<?= $this->template->load_view('views/manage/entreprises/_navigation'); ?>
<div class="container">
    <div class="row">
        <h1 class="col-xs-12">Modifier <?= $entreprise->name; ?></h1>
        <?= form_open(current_url(), array('role' => 'form','class' => 'form-horizontal col-xs-12')); ?>
        <fieldset>
            <legend>Données</legend>
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $entreprise->name; ?>">
            </div>
            <div class="form-group">
                <label for="short_descriptif">Introduction :</label>
                <textarea class="form-control" id="short_descriptif" name="short_descriptif"><?= $entreprise->short_descriptif; ?></textarea>
            </div>
             <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" id="description" name="description"><?= $entreprise->description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="taxe">Taxe:</label>
                <input type="number" step="any" class="form-control" id="taxe" name="taxe" value="<?= $entreprise->taxe; ?>">
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
                            'value' => $entreprise->photo,
                            'data-toggle' => 'help',
                            'data-content' => "Utilisé comme photo principal, merci de ne pas mettre une image trop lourde"
                        )
                    )
                );
                echo $this->template->load_view('views/elfinder/file_select', $file_options);
                ?>
            </div>
            <div class="form-group">
                <label for="photo">Catalogue:</label>
                <?php
                $file_options = array(
                    'file_opts' => array(
                        'input' => array(
                            'class' => 'form-control',
                            'placeholder' => "catalogue",
                            'id' => 'catalogue',
                            'name' => 'catalogue',
                            'value' => $entreprise->catalogue,
                            'data-toggle' => 'help',
                            'data-content' => "Catalogue téléchargeable"
                        )
                    )
                );
                echo $this->template->load_view('views/elfinder/file_select', $file_options);
                ?>
            </div>
        </fieldset>
        <div class="col-xs-4 col-xs-offset-4">
            <button type="submit" class="btn btn-block btn-success" name="entreprise_update_form" value="sent">
                Modifier
            </button>
        </div>
        <?= form_close(); ?>
    </div>
</div>