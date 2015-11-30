<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Inscription sur le site NINFO</title>
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
                <h2>Bonjour <?= $firstname . ' ' . $lastname; ?></h2>
                <p>Un compte vous a été créé par NINFO pour pouvoir accéder à son site.</p>
                <hr>
                <p><?= $message_mail; ?></p>
                <p>Vos identifiants:</p>
                <ul>
                    <li>Email : <?= $email; ?></li>
                    <li>Mdp : <?= $temp_password; ?></li>
                </ul>

                <p><a href='<?= site_url("connexion/$id/$temp_password"); ?>'>Cliquez ici pour vous connecter !</a></p>
                <p style="color: #FF0000">Il vous sera demandé de changer votre mot de passe à votre première connexion par soucis
                de sécurité.</p>
                <hr>
                <p>A tout de suite!</p>
            </td>
        </tr>
    </table>
</body>
</html>