<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Demande de contact NINFO - <?= $name; ?></title>
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
                <h2>Demande de contact - <?= $name; ?></h2>

                 <table class="table table-hover">                    
                    <tbody>
                        <tr>
                            <td>
                                <b>Nom:</b><?= $name; ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <b>Email:</b><?= $email; ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <b>Téléphone:</b><?= $telephone; ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <b>Siret:</b><?= $enseigne; ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <b>Département:</b><?= $departement; ?>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <b>Message:</b><br><?= $message; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>