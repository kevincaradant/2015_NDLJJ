<div class="container" id="page_products">
    <div class="col-xs-12 col-sm-8">
        <div class="container-fluid">
            <div  class="row">
                <h1 class="col-xs-12">Mes produits :</h1>
            </div>
            <div class="row" id="liste-produits">
                <?php if($products) : ?>
                    <?php foreach($products as $product) : ?>
                       <div class="produit col-xs-6 col-sm-6 col-md-4" data-id="<?= $product->entreprise->id; ?>" <?= ($product->entreprise->id == $entreprise_filter || $entreprise_filter == false) ? '' : 'style="display: none;"' ?>>
                           <div class="ih-item square effect3 top_to_bottom">
                               <a href="<?= $product->link; ?>">
                                    <div class="img"><img src="<?= $product->img_link; ?>"></div>
                                    <div class="info">
                                        <div class="info-back">
                                            <h3><?= $product->name; ?></h3>
                                            <p><?= $product->price; ?>  €</p>
                                        </div>
                                    </div>
                               </a>
                           </div>
                       </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="col-xs-12">Vous n'avez accès à aucun produits, veuillez contacter Agencora svp.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="container-fluid">
            <h4 class="info"><span class="label label-info">Filtrer les produits par fournisseurs :</span></h4>
            <?php if($entreprises) : ?>
                <div class="col-xs-12 checkbox-design" id="filtre_produits">
                    <?php foreach ($entreprises as $entreprise) : ?>
                        <input type="checkbox" <?= ($entreprise->id == $entreprise_filter || $entreprise_filter == false) ? 'checked="checked"' : '' ?>  class="filtre_produit_check" id="choice_<?= $entreprise->id; ?>" name="choice_<?= $entreprise->id; ?>" value="<?= $entreprise->id; ?>">
                        <label class="filtre_produit_check_label" for="choice_<?= $entreprise->id; ?>"> 
                            <span class="ui-checkbox"></span>
                            <?= $entreprise->name; ?>
                            <?php if($entreprise->catalogue != NULL && !empty($entreprise->catalogue) ) : ?>
                                <a target="_blank" href="<?= site_url('assets/files/'.$entreprise->catalogue); ?>" title="Télécharger le catalogue"><i class="glyphicon glyphicon-download-alt"></i></a>
                            <?php endif; ?>
                        </label><br/>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="col-xs-12">
                    <p>Vous n'avez accès à aucune entreprises, veuillez contacter Agencora svp.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>