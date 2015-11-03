<?= $this->template->load_view('views/manage/users/_navigation'); ?>
<div class="container">
    <div class="row">
        <h1 class="col-xs-12">Modifier <?= $user->fullname; ?></h1>
        <?= form_open(current_url(), array('role' => 'form','class' => 'form-horizontal col-xs-12')); ?>
        <fieldset>
            <legend>Données requises</legend>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user->email; ?>">
                <label for="prenom">Prenom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $user->firstname; ?>">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= $user->lastname; ?>">
                <label for="society">Société:</label>
                <input type="text" class="form-control" id="society" name="society" value="<?= $user->society; ?>">
            </div>
             <div class="form-group">
                <select multiple name="entreprises[]" style="min-height: 300px;">
                    <?php foreach ($entreprises as $entreprise) : ?>

                        <option  value="<?= $entreprise->id; ?>" <?= (in_array($entreprise->id, $user->id_entreprises)) ? 'selected="selected"' : '' ?> ><?= $entreprise->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <legend>Données falcutatives</legend>
            <div class="form-group">
                <label for="adress">Adresse:</label>
                <input type="text" class="form-control" id="adress" name="adress" value="<?= $user->adress; ?>">
                <label for="city">Ville:</label>
                <input type="text" class="form-control" id="city" name="city" value="<?= $user->city; ?>">
                <label for="code_postal">Code postal:</label>
                <input type="number" class="form-control" id="code_postal" name="code_postal" value="<?= $user->code_postal; ?>">
                <label for="iso_departement">Departement:</label>
                <input type="text" class="form-control" id="iso_departement" name="iso_departement" value="<?= $user->iso_departement; ?>">
                <label for="type">Type Client (PF, EF...):</label>
                <input type="text" class="form-control" id="type" name="type" value="<?= $user->type; ?>">
                <label for="telephone">Téléphone:</label>
                <input type="number" class="form-control" id="telephone" name="telephone" value="<?= $user->telephone; ?>">
                <label for="portable">Portable:</label>
                <input type="number" class="form-control" id="portable" name="portable" value="<?= $user->portable; ?>">
            </div>
        </fieldset>
        <div class="col-xs-4 col-xs-offset-4">
            <button type="submit" class="btn btn-block btn-success" name="user_update_form" value="sent">
                Modifier
            </button>
        </div>
        <?= form_close(); ?>
    </div>
</div>