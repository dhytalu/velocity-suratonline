<?php

/**
 * Template Name: Dashboard Surat System
 *
 * @package velocity
 */

get_header();
$container        = get_theme_mod('justg_container_type', 'container'); ?>
<div class="<?php echo $container; ?>">
    <?php if (is_user_logged_in()) :
        $current_user = wp_get_current_user();
        if (user_can($current_user, 'administrator')) :
            get_velocitysurat_part('/public/templates/profil-admin');
        else :
            get_velocitysurat_part('/public/templates/profil-user');
        endif;
    else :
        get_velocitysurat_part('/public/templates/login');
    endif; ?>
</div>

<?php
get_footer();
