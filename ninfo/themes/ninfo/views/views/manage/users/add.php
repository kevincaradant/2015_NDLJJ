<?= $this->template->load_view('views/manage/users/_navigation'); ?>
<div class="container">
    <div class="row">
        <h1 class="col-xs-12">Ajouter un client</h1>
        <?= form_open(current_url(), array('role' => 'form','class' => 'form-horizontal col-xs-12')); ?>
            <fieldset>
                <legend>Données primaires</legend>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>">
                    <label for="prenom">Prenom:</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?= set_value('prenom'); ?>">
                    <label for="nom">Nom:</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?= set_value('nom'); ?>">
                    <label for="society">Société:</label>
                    <input type="text" class="form-control" id="society" name="society" value="<?= set_value('society'); ?>">
                </div>
                 <div class="form-group">
                    <select multiple name="entreprises[]" style="min-height: 300px;">
                        <?php foreach ($entreprises as $entreprise) : ?>
                            <option  value="<?= $entreprise->id; ?>"><?= $entreprise->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </fieldset>
            <fieldset>
                <legend>Données falcutatives</legend>
                <div class="form-group">
                    <label for="adress">Adresse:</label>
                    <input type="text" class="form-control" id="adress" name="adress" value="<?= set_value('adress'); ?>">
                    <label for="city">Ville:</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?= set_value('city'); ?>">
                    <label for="code_postal">Code postal:</label>
                    <input type="number" class="form-control" id="code_postal" name="code_postal" value="<?= set_value('code_postal'); ?>">
                    <label for="iso_departement">Departement:</label>
                    <input type="text" class="form-control" id="iso_departement" name="iso_departement" value="<?= set_value('iso_departement'); ?>">
                    <label for="type">Type Client (PF, EF...):</label>
                    <input type="text" class="form-control" id="type" name="type">
                    <label for="telephone">Téléphone:</label>
                    <input type="number" class="form-control" id="telephone" name="telephone" value="<?= set_value('telephone'); ?>">
                    <label for="portable">Portable:</label>
                    <input type="number" class="form-control" id="portable" name="portable" value="<?= set_value('portable'); ?>">
                </div>
            </fieldset>
            <fieldset>
                <legend>Données supplémentaires</legend>
                <div class="form-group">
                    <label for="message_mail">Message personnalisé:</label>
                    <textarea class="form-control" rows="3" id="message_mail" name="message_mail" value="<?= set_value('message_mail'); ?>"></textarea>
                </div>
            </fieldset>
            <div class="col-xs-4 col-xs-offset-4">
                <button type="submit" class="btn btn-block btn-success" name="user_add_form" value="sent">
                    Inscrire
                </button>
            </div>
            <?= form_close(); ?>
    </div>
</div>