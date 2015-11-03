<div class="container" id="page_products" data-price="<?= $product->price*$product->lot; ?>">
    <?php if($product): ?>
        <div class="col-xs-12 col-sm-9">
            
            <div class="container-fluid">
                <div class="row" id="produit">
                   <div class="col-xs-12 col-sm-5" id="img_produit">
                        <div class="img">
                            <img src="<?= $product->img_link; ?>">

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-7" id="description_produit">
                        <h1><?= $product->name; ?></h1> 

                        <p class="label label-info">Prix/u HT : <?= $product->price; ?>  €</p>
                        <p class="label label-primary">Vous avez commandé ce produit <b><?= $cpt_product_bought; ?></b> fois</p>
                        <p class="label label-warning">Ref: <b><?= $product->reference; ?></b></p>
                        <p><?= $product->description; ?></p>

                        <?= form_open(current_url(), array('role' => 'form','class' => 'form-inline col-xs-12')); ?>

                            <div>
                            <p class="input-group label label-info"><b>Vendu par <?= $product->lot; ?> pièces</b></p>
                            </div>
                            <div class="input-group">
                                <label class="input-group-addon" for="quantity">Quantité:</label>
                                <input id="quantity_input" type="number" class="form-control" id="quantity" name="quantity" value="1">
                            </div>
                            <br>
                             <button type="submit" class="btn btn-success input-group" name="buy_product" value="sent">
                                Ajouter au panier (<span class="dynaprice"><?= $product->price * $product->lot; ?> </span> € HT)
                            </button>

                        <?= form_close(); ?>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-3">
            <div class="container-fluid" id="other_products">
                <div class="row">
                    <h3 class="col-xs-12">Autres produits : </h3>
                </div>
                <div class="row">
                    <div>
                        <?php foreach ($other_products as $other_product) : ?>
                            <div class="other_product col-xs-12">
                                <a href="<?= $other_product->link; ?>" title="<?= $other_product->name; ?>">
                                    <img src="<?= $other_product->img_link ?>"/>
                                    <h4><?= $other_product->name; ?> (<?= $other_product->price ?> €)</h4>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
       </div>
    <?php else: ?>
        <p class="warning col-xs-12">Ce produit ou l'entreprise qui le fournit n'est plus disponible. <br> <a href="<?= site_url('produits'); ?>">Cliquez ici pour retourner a la liste des produits.</a></p>
    <?php endif;?>
</div>