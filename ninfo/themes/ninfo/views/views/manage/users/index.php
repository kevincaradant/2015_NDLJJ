<?= $this->template->load_view('views/manage/users/_navigation'); ?>
<div class="container">
    <div class="row">
        <h1 class="col-xs-12">Liste des clients</h1>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="col-xs-12 table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Société</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Portable</th>
                        <th>Code postal</th>
                        <th>Departement</th>
                        <th>Type</th>
                        <th><span class="glyphicon glyphicon-wrench"></span></th>
                        <th>Mail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user) : ?>
                        <?php //var_dump($users);exit; ?>
                        <tr class="<?php if( !$user->active){  echo 'warning'; }?>" >
                            <td><?= $user->id; ?></td>
                            <td><?= $user->firstname; ?></td>
                            <td><?= $user->lastname; ?></td>
                            <td><?= $user->society; ?></td>
                            <td><?= $user->email; ?></td>
                             <td><?= $user->telephone; ?></td>
                            <td><?= $user->portable; ?></td>
                            <td><?= $user->code_postal; ?></td>
                            <td><?= $user->iso_departement; ?></td>
                            <td><?= $user->type; ?></td>
                            <td>
                                <a title="Modifier" href="<?= site_url('admin/clients/modifier_client/' . $user->id) .'/' . slugify($user->fullname); ?>">
                                    <span class="glyphicon glyphicon-cog"></span>
                                </a>
                                <a title="Supprimer" href="<?= site_url('admin/clients/remove_client/' . $user->id ); ?>">
                                    <span style="color: red;" class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                            <td>
                                <a title="Renvoyer mail" href="<?= site_url('admin/clients/send_mail/'.$user->id); ?>">
                                    <span style="color: green;" class="glyphicon glyphicon-envelope"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>