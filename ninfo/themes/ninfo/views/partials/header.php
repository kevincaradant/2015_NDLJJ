<header id="header" class="container">

    <div class="row">
        <div id="logo" class="col-xs-12 col-sm-5">
            <a href="<?= site_url(); ?>"> <img src="<?= img_path('logo-agencora.png'); ?>"/></a>
        </div>
        <nav class="navbar col-sm-7">
            <div class="navbar-right">
                <ul class="nav nav-pills" data-action="hoverify-bootnav">
                    <?php if($this->user_lib->connected()) : ?>
                        <?php if( $this->user_lib->is_admin() ) : ?>
                            <li>
                                <a href="<?= site_url('admin'); ?>" title="accès à l'admin">
                                    <i class="glyphicon glyphicon-tower"></i> Admin
                                </a>
                            </li>
                        <?php endif; ?>
                        <li <?= ($id_nav==0) ? 'class="active"' : ''; ?>>
                            <a href="<?= site_url('produits'); ?>" title="Mes produits">
                                 <i class="glyphicon glyphicon-th"></i> Mes produits
                            </a>
                        </li>
                         <li <?= ($id_nav==1) ? 'class="active"' : ''; ?>>
                            <a href="<?= site_url('mes-commandes'); ?>" title="Mes commandes">
                                 <i class="glyphicon glyphicon-list-alt"></i> Mes commandes
                            </a>
                        </li>
                       <li <?= ($id_nav==2) ? 'class="active"' : ''; ?>>
                            <a href="<?= site_url('mon-compte'); ?>" title="Mon compte">
                                 <i class="glyphicon glyphicon-user"></i> Mon compte
                            </a>
                        </li>
                        <li <?= ($id_nav==3) ? 'class="active"' : ''; ?>>
                            <a href="<?= site_url('mon-panier'); ?>" title="Mon panier">
                                 <i class="glyphicon glyphicon-shopping-cart"></i> Mon panier
                            </a>
                        </li>

                        <li>
                            <a id="btn_deconnexion" href="<?= site_url('deconnexion/'.get_csrf()); ?>" title="Deconnexion">
                                 <i class="glyphicon glyphicon-off"></i> Deconnexion
                            </a>
                        </li>

                    <?php else : ?>
                        <li>
                            <a href="<?= site_url('connexion'); ?>" title="Connectez-vous">
                                <i class="glyphicon glyphicon-user"></i> Connexion
                             </a>
                         </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</header>