<?php
add_action('wp_head', 'vsstemmart_ajaxurl');
function vsstemmart_ajaxurl()
{
    $html    = '<script type="text/javascript">';
    $html   .= 'var ajaxurl = "' . admin_url('admin-ajax.php') . '"';
    $html   .= '</script>';
    echo $html;
    // echo ' <link rel="preload" href="'.VELOCITY_SURAT_PLUGIN_DIR.'public/css/fonts/slick.woff" as="font" type="font/woff2" crossorigin>';
}

add_action('wp_ajax_ajaxlogin', 'ajax_login');
add_action('wp_ajax_nopriv_ajaxlogin', 'ajax_login');
function ajax_login()
{

    // First check the nonce, if it fails the function will break
    check_ajax_referer('ajax-login-nonce', 'security');

    // Nonce is checked, get the POST data and sign user on
    $info                           = array();
    $info['user_login']             = $_POST['username'];
    $info['user_password']          = $_POST['password'];
    $info['g-recaptcha-response']   = $_POST['g-recaptcha-response'];
    $info['remember']               = true;

    if (is_ssl()) {
        $sll = true;
    } else {
        $sll = false;
    }
    $user_signon = wp_signon($info, $sll);
    if (is_wp_error($user_signon)) {
        echo json_encode(array('loggedin' => false, 'message' => $user_signon->get_error_message()));
    } else {
        echo json_encode(array('loggedin' => true, 'message' => __('Login successful, redirecting...')));
    }

    die();
}
