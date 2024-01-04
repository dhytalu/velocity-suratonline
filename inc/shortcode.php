<?php

/**
 * Theme basic setup.
 *
 * @package velocity
 */

// [data-penduduk]
add_shortcode('data-penduduk', 'vd_data_penduduk');
function vd_data_penduduk()
{
    ob_start();
    $args = array(
        'role'    => 'subscriber',
        'orderby' => 'user_nicename',
        'order'   => 'ASC'
    );

    $subscribers = get_users($args);

    if (!empty($subscribers)) {
        foreach ($subscribers as $subscriber) {
            $user_id = $subscriber->ID;
            $user_login = $subscriber->user_login;
            $user_email = $subscriber->user_email;
            $photo  =  get_user_meta($user_id, 'photo', true);
            if (!empty($photo)) {
                $photo_url = wp_get_upload_dir()['url'] . '/' . $photo; // Mendapatkan URL foto
                $photo = '<img src="' . $photo_url . '" alt="Photo Profil">';
            } else {
                $photo = 'Foto profil tidak tersedia.';
            }
            // Lakukan sesuatu dengan data pengguna subscriber
            echo "User ID: " . $user_id . "<br>";
            echo "Username: " . $user_login . "<br>";
            echo "Email: " . $user_email . "<br>";
            echo "Photo:" . $photo;
        }
    } else {
        echo 'Tidak ada pengguna subscriber.';
    }
    return ob_get_clean();
}
