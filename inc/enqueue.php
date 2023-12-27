<?php

/**
 * function register asset css and sj to frontend public.
 *
 * @package Velocity Toko
 */

if (!function_exists('velocitysurat_register_scripts')) {
    /**
     * Load theme's JavaScript and Style sources.
     */
    function velocitysurat_register_scripts()
    {

        // Get the version.
        $the_version = VELOCITY_SURAT_VERSION;
        if (defined('WP_DEBUG') && true === WP_DEBUG) {
            $the_version = $the_version . '.' . time();
        }

        // wp_enqueue_style('velocitytoko-store-style', VELOCITY_SURAT_PLUGIN_URL . 'public/css/style-store.css', array(), $the_version, false);

        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-slider');
        wp_enqueue_script('jquery-ui');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('velocitysurat-script', VELOCITY_SURAT_PLUGIN_URL . 'public/js/surat.js', array('jquery', 'justg-scripts'), $the_version, true);
    }
    add_action('wp_enqueue_scripts', 'velocitysurat_register_scripts', 25);
}
