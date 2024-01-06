<?php

/**
 * Theme basic setup.
 *
 * @package velocity
 */
// [myprofile]
add_shortcode('myprofile', 'myprofile');
function myprofile($atts)
{
    ob_start();
    $atribut = shortcode_atts(array(
        'user_id'   => get_current_user_id(), // id user
    ), $atts);
    $user_id    = $atribut['user_id'];
    $nama_lengkap   = wp_get_current_user()->display_name;
    $photo  =  get_user_meta($user_id, 'profile_picture', true);
    if (!empty($photo)) {
        $photo_url = wp_get_upload_dir()['url'] . '/' . $photo; // Mendapatkan URL foto
        $photo = '<img src="' . $photo_url . '"  alt="Photo Profil" width="28" height="28" class="rounded-circle">';
    } else {
        $urlimg = VELOCITY_SURAT_PLUGIN_URL . 'public/assets/user-profile.png';
        $photo = '<img src="' . $urlimg . '"  alt="Photo Profil" width="28" height="28" class="bg-white rounded-circle">';
    }
    echo $photo . '<span class="d-none d-sm-inline mx-1">' . $nama_lengkap . '</span>';
    return ob_get_clean();
}

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
            $photo  =  get_user_meta($user_id, 'profile_picture', true);
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
