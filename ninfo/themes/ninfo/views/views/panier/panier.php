<div class="container" id="page_panier">
    <div class="col-xs-12">
        <div class="container-fluid">
            <?php if($has_panier) : ?>
                <?php foreach ($products as $product) : ?>
                <?php
                    if(!isset($taxes_products[$product->entreprise->taxe])){
                        $taxes_products[$product->entreprise->taxe] = 0;
                    }
                    $taxes_products[$product->entreprise->taxe] += ($product->lot*$product->quantity)*($product->price/100*$product->entreprise->taxe);
                ?>
            <?php endforeach; ?>
            <?php $total_taxe_products = 0; ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Vendu par pièce de</th>
                            <th>Quantité</th>
                            <th>Prix/u HT</th>
                            <th>Total HT</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr > 
                            <td colspan="3"></td>
                            <td class="info">Total commande HT</td>
                            <td class="info"><?= $total_price_command; ?> <i class="glyphicon glyphicon-euro"></td>
                        </tr>
                        <?php foreach($taxes_products as $key_taxe => $value_taxe) : ?>
                            <tr>
                                <td colspan="3"></td>
                                <td>Total Taxe <?= $key_taxe ?> %</td>
                                <td><?= round($value_taxe,2); ?></td>
                            </tr>
                            <?php $total_taxe_products += $value_taxe; ?>
                        <?php endforeach; ?>
                         <tr > 
                            <td colspan="3"></td>
                            <td class="info">Total commande TTC</td>
                            <td class="info"><?= $total_price_command + $total_taxe_products ;  ?> <i class="glyphicon glyphicon-euro"></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $taxes_products = array(); ?>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td><a href="<?= $product->link; ?>"><?= $product->name; ?></a></td>
                                <td><?= $product->lot; ?></td>
                                <td><?= $product->quantity; ?></td>
                                <td><?= $product->price; ?><i class="glyphicon glyphicon-euro"></i></td>
                                <td><?= $product->total_price; ?><i class="glyphicon glyphicon-euro"></i></td>
                                <td><a href="<?= site_url('panier/remove_product/'.$product->id); ?>"><i class="glyphicon glyphicon-trash"></i></a></td> 
                            </tr>

                            
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>

                <?= form_open(current_url(), array('role' => 'form','class' => 'form-horizontal col-xs-12')); ?>
                     <button type="submit" class="btn btn-success" name="take_command" value="sent">
                        Passer commande
                    </button>
                <?= form_close(); ?>
            <?php else: ?>
                <p class="alert alert-warning">Votre panier est vide</p>
            <?php endif; ?>
            <p style="text-align: right;"><a class="label label-warning" href="<?= site_url('produits'); ?>">Continuer ma commande</a></p>
        </div>
    </div>
</div>