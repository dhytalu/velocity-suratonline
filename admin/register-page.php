<?php

/**
 * Velocity Surat Dashboard page.
 */
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

//register product template
add_filter('template_include', function ($template) {
    $page_template = get_post_meta(get_the_ID(), '_wp_page_template', true);
    // if (is_singular('pengajuan_surat')) {
    //     $template = VELOCITY_SURAT_PLUGIN_DIR . 'inc/single-surat.php';
    // }
    // if (is_post_type_archive('pengajuan_surat') || is_tax('jenis_surat')) {
    //     $template = VELOCITY_SURAT_PLUGIN_DIR . 'inc/archive-surat.php';
    // }
    if (is_singular()) {
        if ('velocitysurat-templates_dashboard' === $page_template) {
            $template = VELOCITY_SURAT_PLUGIN_DIR . '/public/page/page-dashboard.php';
        } elseif ('velocitysurat-templates_profil' === $page_template) {
            $template = VELOCITY_SURAT_PLUGIN_DIR . '/public/templates/profile.php';
        }
    }
    return $template;
});

add_filter("theme_page_templates", 'velocitysurat_templates_page');
function velocitysurat_templates_page($post_templates)
{

    $post_templates['velocitysurat-templates_dashboard']   = __('Dashboard Sistem Surat', 'velocity-surat');
    $post_templates['velocitysurat-templates_profil']   = __('My Account', 'velocity-surat');

    return $post_templates;
}


// Register Dashboard Page
add_filter('after_setup_theme', 'velocity_create_dashboard');
function velocity_create_dashboard()
{
    $post_id        = -1;
    $slug           = 'dashboard';
    $title          = 'Dashboard Sistem Surat';
    if (null == get_page_by_path($slug)) {
        $post_id = wp_insert_post(
            array(
                'comment_status'    =>    'closed',
                'ping_status'        =>    'closed',
                'post_author'        =>    '1',
                'post_name'            =>    $slug,
                'post_title'        =>    $title,
                'post_status'        =>    'publish',
                'post_type'            =>    'page',
                'page_template'        =>  'velocitysurat-templates_dashboard'
            )
        );
    } else {
        $post_id = -2;
    }
}

add_filter('after_setup_theme', 'velocity_create_profile');
function velocity_create_profile()
{
    $post_id        = -1;
    $slug           = 'myaccount';
    $title          = 'My Account';
    if (null == get_page_by_path($slug)) {
        $post_id = wp_insert_post(
            array(
                'comment_status'    =>    'closed',
                'ping_status'        =>    'closed',
                'post_author'        =>    '1',
                'post_name'            =>    $slug,
                'post_title'        =>    $title,
                'post_status'        =>    'publish',
                'post_type'            =>    'page',
                'page_template'        =>  'velocitysurat-templates_dashboard'
            )
        );
    } else {
        $post_id = -2;
    }
}
