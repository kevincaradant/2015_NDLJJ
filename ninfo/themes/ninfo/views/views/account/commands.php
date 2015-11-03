<div class="container" id="page_commandes">
    <div class="col-xs-12">
        <h1>Vos commandes</h1>
        <div class="container-fluid">
            <?php if($has_orders) : ?>
                <table class="table table-hover" id="commandes">
                    <thead>
                        <th>Date</th>
                        <th>Prix Total HT</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order): ?>
                            <tr>
                                <td><?= date('d-m-Y  H:i:s',$order->created) ?></td>
                                <td><?= $order->total_price ?> €</td>
                                <td data-id-order="<?= $order->id; ?>" class="voir_detail_commande"><i class="glyphicon glyphicon-plus"></i> Voir détails</td>
                            </tr>
                            <tr class="info detail_order" data-id-order="<?= $order->id; ?>">
                                <td colspan="4">
                                    <table style="width: 100%;">
                                        <thead>
                                            <th>Produit</th>
                                            <th>Quantité</th>
                                            <th>Prix/u HT</th>
                                            <th>Prix total HT</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($order->details as $order_detail): ?>
                                                <tr>
                                                    <td><a href="<?= $order_detail->product->link; ?>" title="Voir le produit <?= $order_detail->product->name; ?>"><?= $order_detail->product->name; ?> (<?= $order_detail->product->entreprise->name ?>)</a></td>
                                                    <td><?= $order_detail->quantity; ?></td>
                                                    <td><?= $order_detail->product->price; ?> €</td>
                                                    <td><?= $order_detail->price; ?> €</td>

                                                </tr>
                                            <?php endforeach; ?>
                                           

                                        </tbody>
                                    </table>
                                </td>
                            <tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="warning">Vous n'avez pas encore passé de commandes. Vous pouvez retrouver vos produits en <a href="/produits" title="Voir mes produits">cliquant ici</a></p>
            <?php endif; ?>
        </div>
    </div>
</div>