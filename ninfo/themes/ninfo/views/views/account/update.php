<div class="container" id="page_panier">
    <div class="col-xs-12">
		<h1><?= $page_title; ?></h1>

		<?= form_open(site_url('mon-compte'), array('class' => 'form-horizontal', 'style' => 'margin-bottom:20px;')); ?>

			<fieldset>
			<legend>Informations de connexion</legend>

			<div class="form-group">
				<label for="" class="control-label col-xs-5">Adresse email <sup class="text-danger">*</sup></label>
				<div class="col-xs-7">
					<p class="form-control-static"><?= $this->user_lib->user->email; ?></p>
				</div>
			</div>

			<div class="form-group">
				<label for="" class="control-label col-xs-5">Mot de passe (actuel)</label>
				<div class="col-xs-7">
					<input type="password" class="form-control" id="user_current_password" name="user_current_password" placeholder="Mot de passe actuel" />
				</div>
			</div>

			<div class="form-group">
				<label for="" class="control-label col-xs-5">Nouveau Mot de passe</label>
				<div class="col-xs-7">
					<input type="password" class="form-control" id="user_password" name="user_password" value="<?= set_value('user_password'); ?>" placeholder="Nouveau Mot de passe" />
				</div>
			</div>

			<div class="form-group">
				<label for="" class="control-label col-xs-5">Mot de passe (confirmation)</label>
				<div class="col-xs-7">
					<input type="password" class="form-control" id="user_password_confirm" name="user_password_confirm" value="<?= set_value('user_password_confirm'); ?>" placeholder="Confirmation du mot de passe" />
				</div>
			</div>

			<div class="form-group">
				<div class="col-xs-7 col-xs-offset-5">
					<div class="checkbox">
						<label for="user_update_password">
							<input type="checkbox" name="user_update_password" id="user_update_password" value="1" />
							Changer de mot de passe ?
						</label>
					</div>
				</div>
			</div>
			</fieldset>

			<fieldset>
			<legend>Informations personnelles</legend>

			<div class="form-group">
				<label for="" class="control-label col-xs-3">Nom <sup class="text-danger">*</sup></label>
				<div class="col-xs-4">
					<input type="text" class="form-control" id="user_lastname" name="user_lastname" value="<?= set_value('user_lastname', $this->user_lib->user->lastname); ?>" placeholder="Dupond" />
				</div>
				<label for="" class="control-label col-xs-1">Prénom <sup class="text-danger">*</sup></label>
				<div class="col-xs-4">
					<input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?= set_value('user_firstname', $this->user_lib->user->firstname); ?>" placeholder="Jacques" />
				</div>
			</div>

			<div class="form-group">
				<label for="" class="control-label col-xs-3">Société <sup class="text-danger">*</sup></label>
				<div class="col-xs-4">
					<input type="text" class="form-control" id="user_society" name="user_society" value="<?= set_value('user_society', $this->user_lib->user->society); ?>" placeholder="Jacques" />
				</div>
			</div>

			<div class="form-group">
				<label for="" class="control-label col-xs-3">Adresse <sup class="text-danger">*</sup></label>
				<div class="col-xs-9">
					<input type="text" class="form-control" id="user_address" name="user_address" value="<?= set_value('user_address', $this->user_lib->user->adress); ?>" placeholder="114 Rue des Troènes" />
				</div>
			</div>

			<div class="form-group">
				<label for="" class="control-label col-xs-3">Code postal <sup class="text-danger">*</sup></label>
				<div class="col-xs-4">
					<input type="text" class="form-control" id="user_postal" name="user_postal" value="<?= set_value('user_postal', $this->user_lib->user->code_postal); ?>" placeholder="31200" />
				</div>
				<label for="" class="control-label col-xs-1">Ville <sup class="text-danger">*</sup></label>
				<div class="col-xs-4">
					<input type="text" class="form-control" id="user_city" name="user_city" value="<?= set_value('user_city', $this->user_lib->user->city); ?>" placeholder="Lyon" />
				</div>
			</div>


			<div class="form-group">
				<label for="" class="control-label col-xs-3">Téléphone</label>
				<div class="col-xs-9">
					<input type="text" class="form-control" id="user_telephone" name="user_telephone" value="<?= set_value('user_phone', $this->user_lib->user->telephone); ?>" placeholder="0892693115" />
					<span class="help-block">
						Numéro de téléphone fixe. 10 numéros, sans espaces.
					</span>
				</div>
				<label for="" class="control-label col-xs-3">Portable</label>
				<div class="col-xs-9">
					<input type="text" class="form-control" id="user_phone" name="user_phone" value="<?= set_value('user_phone', $this->user_lib->user->portable); ?>" placeholder="0892693115" />
					<span class="help-block">
						Numéro de téléphone portable, 10 numéros, sans espaces.
					</span>
				</div>
			</div>

			</fieldset>

			<div class="form-group">
				<div class="col-xs-6">
					<p>Les champs marqués d'une  <sup class="text-danger">*</sup> sont obligatoires.</p>
				</div>
				<div class="col-xs-6">
					<button type="submit" class="btn btn-stade btn-danger" name="update_form" value="sent">
						Envoyer
					</button>
					<a class="btn btn-default" href="<?= current_url(); ?>">Annuler</a>
				</div>
			</div>

		<?= form_close(); ?>
	</div>
</div>