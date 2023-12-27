<?php

/**
 * Velocity Surat
 */
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Post type Surat.
 */

function pengajuan_surat_setup_post_type()
{
    $args = array(
        'labels' => array(
            'name' => 'Pengajuan Surat',
            'singular_name' => 'pengajuan_surat',
            'add_new' => 'Tambah Pengajuan',
            'add_new_item' => 'Tambah Pengajuan Baru',
            'edit_item' => 'Edit Pengajuan',
            'view_item' => 'Lihat Pengajuan',
            'search_items' => 'Cari Pengajuan',
            'not_found' => 'Tidak ditemukan',
            'not_found_in_trash' => 'Tidak ada Pengajuan di kotak sampah'
        ),
        'supports' => array(
            'title',
            // 'editor',
            // 'thumbnail',
        ),
        'menu_icon'     => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mailbox-flag" viewBox="0 0 16 16"><path d="M10.5 8.5V3.707l.854-.853A.5.5 0 0 0 11.5 2.5v-2A.5.5 0 0 0 11 0H9.5a.5.5 0 0 0-.5.5v8zM5 7c0 .334-.164.264-.415.157C4.42 7.087 4.218 7 4 7c-.218 0-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0"/><path d="M4 3h4v1H6.646A3.99 3.99 0 0 1 8 7v6h7V7a3 3 0 0 0-3-3V3a4 4 0 0 1 4 4v6a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V7a4 4 0 0 1 4-4m0 1a3 3 0 0 0-3 3v6h6V7a3 3 0 0 0-3-3"/></svg>'),
        'has_archive'   => 'pengajuan_surat',
        'show_in_rest'  => false,
        'publicly_queryable'  => false,
        'public'        => true,
        'taxonomies' => array('jenis_pengajuan'),
    );
    register_post_type('pengajuan_surat', $args);
}
add_action('init', 'pengajuan_surat_setup_post_type');

/**
 * Register taxonomy jenis_pengajuan.
 */
add_action('init', 'velocity_surat_jenis_pengajuan');
function velocity_surat_jenis_pengajuan()
{
    $labels = [
        'name'              => 'Jenis Pengajuan',
        'singular_name'     => 'jenis_pengajuan',
        'search_items'      => 'Search Jenis Pengajuan',
        'all_items'         => 'All Jenis Pengajuan',
        'view_item '        => 'View Jenis Pengajuan',
        'parent_item'       => 'Parent Jenis Pengajuan',
        'parent_item_colon' => 'Parent Jenis Pengajuan:',
        'edit_item'         => 'Edit Jenis Pengajuan',
        'update_item'       => 'Update Jenis Pengajuan',
        'add_new_item'      => 'Add New Jenis Pengajuan',
        'new_item_name'     => 'New Jenis Pengajuan Name',
        'menu_name'         => 'Jenis Pengajuan',
        'back_to_items'     => '← Back to Jenis Pengajuan',
    ];
    register_taxonomy(
        'jenis_pengajuan',
        'pengajuan_surat',
        [
            'labels' => $labels,
            'rewrite' => array('slug' => 'jenis_pengajuan'),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
        ],
    );
}
