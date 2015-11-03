<div class="container">
	<div class="row">
		<h1 class="col-xs-12">Changer le mot de passe temporaire</h1>

		<p class="col-xs-12">Pour pouvoir accéder à votre espace personnel, nous avons besoin que vous changiez votre mot de passe temporaire.<br/>
			Ce mots de passe temporaire vous a été donné par mail lors de votre inscription par Agencora.</p>

		<?= form_open(current_url(), array('class' => 'form-horizontal col-xs-12 col-sm-10')); ?>

		<div class="form-group">
			<label class="control-label col-xs-4" for="password_acces">Mot de passe temporaire</label>
			<div class="col-xs-8 col-sm-6">
				<input type="password" class="form-control" id="password_acces" name="password_acces" placeholder="Mot de passe temporaire" />
			</div>
			<hr>
			<label class="control-label col-xs-4" for="password">Nouveau mot de passe</label>
			<div class="col-xs-8 col-sm-6">
				<input type="password" class="form-control" id="password" name="password" placeholder="Nouveau mot de passe" />
			</div>
			<label class="control-label col-xs-4" for="password_repeat">Répetez le nouveau mot de passe</label>
			<div class="col-xs-8 col-sm-6">
				<input type="password" class="form-control" id="password_repeat" name="password_repeat" placeholder="Répetez le nouveau mot de passe" />
			</div>
		</div>

		
		<div class="form-froup">
			<div class="col-xs-8 col-xs-offset-4">
				<button type="submit" class="btn btn-success" name="change_mdp_temps_form" value="sent">Changer mon mots de passe</button>
			</div>
		</div>

		<?= form_close(); ?>

	</div>
</div>
