<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Nouvelle commande sur Agencora</title>
</head>
<body>
    <table border="0" align="center" cellpadding="0" cellspacing="0" style="width:640px;font-family:Century Gothic,Verdana, Geneva, sans-serif;">
        <tr>
            <td align="center" style="text-align: center;">
                <a href=""><img width="445" height="57" src="<?= img_path('logo-agencora.png'); ?>"/></a>
            </td>
        </tr>
        <tr>
            <td>
                <br/><br/>
                <h2>Bonjour <?= $firstname . ' ' . $lastname; ?> (  )</h2>
                <p>Vous venez de passer commande, nous vous en remercions et allons la traiter dans les meilleurs délais.<br>
                 Veuillez trouver ci dessous les détails de la commande.:</p>
                 <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="padding-bottom: 10px;">Produit</th>
                            <th style="padding-bottom: 10px;">Quantité</th>
                            <th style="padding-bottom: 10px;">Prix/u </th>
                            <th style="padding-bottom: 10px;">Prix total</th>
                            <!--<th style="padding-bottom: 10px;"></th>-->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr > 
                            <td colspan="2"></td>
                            <td class="info">Total commande</td>
                            <td class="info"><?= $total_price_command; ?> €</td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td style="text-align: center;"><?= $product->name; ?> (<?= $product->entreprise->name ?>) </td>
                                <td style="text-align: center;"><?= $product->quantity; ?></td>
                                <td style="text-align: center;"><?= $product->price; ?> €</td>
                                <td style="text-align: center;"><?= $product->total_price; ?> €</td>
                                <!--<td><a href="<?= site_url('') ?>"><i class="glyphicon glyphicon-trash"></i></a></td>-->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>