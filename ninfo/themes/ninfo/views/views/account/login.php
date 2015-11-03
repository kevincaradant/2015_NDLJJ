<div class="container">
	<div class="row">
		<h1 class="col-xs-12">Connexion</h1>

		<?= form_open(current_url(), array('class' => 'form-horizontal col-xs-12 col-sm-10')); ?>

		<div class="form-group">
			<label class="control-label col-xs-4" for="user_email">Adresse email</label>
			<div class="col-xs-8">
				<input type="text" class="form-control" id="user_email" name="user_email" placeholder="Email" value="<?= set_value('user_email'); ?>" />
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-xs-4" for="user_password">Mot de passe</label>
			<div class="col-xs-8">
				<input type="password" class="form-control" id="user_password" name="user_password" placeholder="Mot de passe" value="<?= set_value('user_password'); ?>" />
			</div>
		</div>

		<div class="form-group">
			<div class="col-xs-8 col-xs-offset-4">
				<div class="checkbox">
					<label for="user_persist">
						<input type="checkbox" value="1" name="user_persist" id="user_persist" checked="checked" />
						Rester connecté
					</label>
				</div>
			</div>
		</div>

		<div class="form-froup">
			<div class="col-xs-8 col-xs-offset-4">
				<button type="submit" class="btn btn-success">Se connecter</button>
			</div>
		</div>

		<?= form_close(); ?>

		<div class="row">
			<div class="col-xs-12">
				<h1>Pas encore de compte ?</h1>

				<a class="btn btn-block btn-default btn-info" href="<?= site_url('contact'); ?>">Faites-nous la demande par mail</a>
			</div>
		</div>
	</div>
</div>
