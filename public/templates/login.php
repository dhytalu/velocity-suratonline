<?php

/**
 * Theme basic setup.
 *
 * @package velocity
 */
?>
<div style="max-width:30em" class="mx-auto w-100 my-4 rounded form-login card">
    <h5 class="card-title text-center p-3 bg-warning rounded-top">Login</h5>
    <div class="card-body">
        <form name="velocity_login" id="login" action="login" method="post">
            <div class="form-floating mb-3">
                <input id="username" type="text" class="form-control" name="username" placeholder="" required>
                <label class="form-label" for="username">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input id="password" type="password" class="form-control" name="password" placeholder="" required>
                <label class="form-label d-flex justify-content-between" for="password">Password</label>
            </div>
            <div class="form-group mb-3">
                <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Forgot password?</a>
                <?php //echo velocitytoko_display_recaptcha(); 
                ?>
            </div>

            <p class="status"></p>

            <input id="redirect" type="hidden" value="<?php echo get_home_url('/dashboard'); ?>">
            <?php wp_nonce_field('ajax-login-nonce', 'security');
            ?>

            <div class="text-center">
                <button class="btn btn-success rounded-pill p-2 mb-3" type="submit" name="submit" style="min-width:180px;">Login</button>
            </div>

            <div class="text-center text-danger">
                Belum punya akun ? Hubungi Admin untuk membuat akun.
            </div>

        </form>
    </div>

</div>