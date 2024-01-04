jQuery(function ($) {
    // Perform AJAX login on form submit
    $('form#login').on('submit', function (e) {
        var redirect        = $('form#login #redirect').val();
        var grecaptchares   = $('form#login textarea[name="g-recaptcha-response"]').val();

        if ($('form#login textarea[name="g-recaptcha-response"]').length && grecaptchares == '') {
            alert('Captcha Harus Diisi');
            return false;
        }

        $('form#login p.status').show().html('<div class="spinner-grow spinner-grow-sm" role="status"> <span class="visually-hidden">Loading...</span></div> Sending user info, please wait...');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxurl,
            data: {
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(),
                'password': $('form#login #password').val(),
                'security': $('form#login #security').val(),
                'g-recaptcha-response': grecaptchares
            },
            success: function (data) {
                $('form#login p.status').html(data.message);
                if (data.loggedin == true) {
                    document.location.href = redirect;
                } else {
                    reloadCaptcha();
                }
            }
        });

        e.preventDefault();
    });

    document.getElementById('profile_picture').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('preview_image').src = e.target.result;
        }

        reader.readAsDataURL(file);
    });

    $(document).ready(function() {
        $('input[type="text"]').on('input', function() {
            var inputValue = $(this).val();
            var numericValue = $.isNumeric(inputValue);
            var inputId = $(this).attr('id');
            var errorContainerId = 'errorContainer' + inputId.slice(-1);

            if (!numericValue) {
                var errorMessage = 'Masukkan hanya angka untuk ' + inputId + '!';
                $('#' + errorContainerId).text(errorMessage);
            } else {
                $('#' + errorContainerId).text('');
            }
        });
    });

    $(document).on('change', '#perkawinan', function() {
        var nilai = $(this).val();
        if (nilai != 'BELUM KAWIN' && nilai != 'CERAI HIDUP') {
            $('#noakta_nikah').attr({readonly:false, required:true});
            $('#noakta_cerai').attr({readonly:true, required:false, value:' '});

            // reset value
            $('#noakta_cerai').val('');
        } else if (nilai == 'CERAI HIDUP') {
            $('#noakta_nikah').attr({readonly:false, required:true});
            $('#noakta_cerai').attr({readonly:false, required:true});
        } else {
            // add read only & required
            $('#noakta_nikah').attr({readonly:true, required:false});
            $('#noakta_cerai').attr({readonly:true, required:false});

            // reset value
            $('#noakta_nikah').val('');
            $('#noakta_cerai').val('');
        }
    });
});

function hanyaAngka(event) {
    var errorMSG = document.getElementById("error");
    var angka = (event.which) ? event.which : event.keyCode;
    if (angka != 46 && angka > 31 && (angka < 48 || angka > 57)) {
        // errorMSG.style.display = 'block';
        alert('Hanya Masukkan Angka!');
        return false;
    } else{
        // errorMSG.style.display = 'none';
        return true;
    }
}