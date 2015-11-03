<div class="container">
    <div class="row">
        <h1 class="col-xs-12">Contactez-nous</h1>
        <?= form_open(current_url(), array('role' => 'form','class' => 'form-horizontal col-xs-12')); ?>
        <fieldset>
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" class="form-control" id="name" name="name" value="">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>">
                <label for="telephone">Téléphone:</label>
                <input type="number" class="form-control" id="telephone" name="telephone" value="<?= set_value('telephone'); ?>">
                <label for="enseigne">Enseigne:</label>
                <input type="text" class="form-control" id="enseigne" name="enseigne" value="">
                <label for="siret">Siret:</label>
                <input type="text" class="form-control" id="siret" name="siret" value="">
                <label for="departement">Departement:</label>
                <input type="text" class="form-control" id="departement" name="departement" value="">
            </div>
             <div class="form-group">
                <label for="message">Message :</label>
                <textarea class="form-control" id="message" name="message"></textarea>
            </div>
        </fieldset>
        <div class="col-xs-4 col-xs-offset-4">
            <button type="submit" class="btn btn-block btn-success" name="do_contact" value="sent">
                Envoyer la demande
            </button>
        </div>
        <?= form_close(); ?>
    </div>
</div>