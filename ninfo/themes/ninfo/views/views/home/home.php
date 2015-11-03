<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1>Bonjour et bienvenue sur le site d'AGENCORA</h1>

            <p>Cette agence commerciale a été crée par Eric CHAZOTTES, au service du
            commerce de proximité depuis 1985.
            Nous avons sélectionné pour vous des entreprises innovantes, réactives.
            Celles pour lesquelles la satisfaction du client est une priorité.
            Parce que vous n'avez pas de temps à perdre.</p>

            <p>
              Nous intervenons sur les départements 01/07/26/38/39/42/43/63/69/71/73/74 pour la plus part des maisons représentées. <br/>
              N'hésitez pas à venir nous rendre visite, sur ce site créé pour vous.
              Vous pouvez visualiser les produits et passer vos commandes en toute sécurité tout en gardant un historique de celles-ci en ligne.
              <br>
              Nous sommes à votre écoute.<br>
              A bientôt.
            </p>

            <h3>Notre devise:</h3>
            <p>
                <ul>
                    <li>Bien vous servir</li>
                    <li>Vous faire plaisir</li>
                    <li>Vous voir revenir</li>
                </ul>
            </p>
        </div>
    </div>


    </div>

    <div class="container">
      <?php if($this->user_lib->connected()) : ?>

      <div id="home_entreprises" class="row">
          <h2 class="col-xs-12">Nos partenaires :</h2>

           <div id="info_entreprise_hp" class="alert alert-info col-xs-12">
          
         </div>

          
            <?php foreach($entreprises as $entreprise) : ?>
                <?php if( in_array($entreprise->id,$id_entreprises) || $this->user_lib->user->level == 9 ) : ?>
                   <div class="enterprise col-xs-6 col-sm-4 col-md-3">
                       <div class="ih-item circle effect13 from_left_and_right">
                           <a href="#">
                                <div class="img"><img src="<?= $entreprise->img_link; ?>"></div>
                                <div class="info">
                                    <div class="info-back">
                                        <h3><?= $entreprise->name; ?></h3>
                                        <p><?= $entreprise->short_descriptif; ?></p>
                                    </div>
                                </div>
                           </a>
                       </div>

                       <div class="description">
                          <div class="description_wrapper">
                            <?= $entreprise->description; ?>
                            <?php if($this->user_lib->connected()) : ?>
                              <p> <a href="<?= site_url('produits/'.slugify($entreprise->name).'/'.$entreprise->id); ?>">Voir les produits <i class="glyphicon glyphicon-eye-open"></i> </a></p>
                            <?php endif; ?>
                            <?php if($entreprise->catalogue != NULL && !empty($entreprise->catalogue) ) : ?>
                              <p><a target="_blank" href="<?= site_url('assets/files/'.$entreprise->catalogue); ?>" title="Télécharger le catalogue">Télécharger le catalogue <i class="glyphicon glyphicon-download-alt"></i></a></p>
                            <?php endif; ?>
                          </div>
                       </div>
                   </div>
                  <?php endif; ?>
            <?php endforeach; ?>
          
      </div>
      <?php endif; ?>
    </div>
</div>