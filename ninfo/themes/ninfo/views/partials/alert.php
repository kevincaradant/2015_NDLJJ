<?php if ($this->session->flashdata('alert') !== null) : ?>
    <div id="alert" class="container">
        <div class="alert col-xs-12 <?= $this->session->flashdata('alert-type'); ?>">
            <span><?= $this->session->flashdata('alert'); ?></span>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready( function ($) {
            if($('#alert').length > 0){
                $('html, body').animate({
                    scrollTop: $('#alert').offset().top - 50
                }, 1000);
            }
        });
    </script>
<?php endif; ?>
