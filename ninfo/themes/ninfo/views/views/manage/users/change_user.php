<div class="container">
    <?= form_open(current_url(), array('role' => 'form','class' => 'form-horizontal col-xs-12')); ?>

        <div class="row">
           <div class="col-xs-12">
                <h1>Prendre la main sur un client</h1>
               <select class="do-chosen" data-placeholder="Choisissez un client" style="width: 300px;" name="id_user_to_control">
                    <?php foreach ($users as $user) : ?>
                        <option value="<?= $user->id ?>" ><?= $user->fullname; ?>
                    <?php endforeach; ?>
               </select>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-xs-4">
                <button type="submit" class="btn btn-block btn-success" name="prendre-main" value="sent">
                    Prendre la main
                </button>
            </div>
        </div>

    <?= form_close(); ?>
</div>