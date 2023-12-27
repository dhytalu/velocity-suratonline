<?php

/**
 * Theme basic setup.
 *
 * @package velocity
 */

//Tambah User
// [form-tambah-user]
add_shortcode('form-tambah-user', 'vd_tambah_user');
function vd_tambah_user()
{
    ob_start();
    if (isset($_POST['tambah_pengguna'])) {
        // Mengambil data dari form
        $nama_lengkap = $_POST['nama_lengkap'];
        $pass = $_POST['password'];
        $nik = $_POST['nik'];
        $no_kk = $_POST['no_kk'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $warga_negara = $_POST['warga_negara'];

        // Memeriksa apakah file foto diunggah
        if ($_FILES['photo']['name']) {
            $photo = $_FILES['photo']['name'];
            $photo_temp = $_FILES['photo']['tmp_name'];
            $photo_path = wp_upload_dir()['path'] . '/' . $photo;
            move_uploaded_file($photo_temp, $photo_path);
        } else {
            $photo = '';
        }

        // Memasukkan data ke dalam database WordPress
        $user_data = array(
            'user_login' => $nik, // Menggunakan Nama Lengkap sebagai username
            'user_pass' => $pass, // Menghasilkan password acak
            'user_email' => '', // Email dapat ditambahkan jika diperlukan
            'display_name' => $nama_lengkap,
            'first_name' => $nama_lengkap,
            'last_name' => '',
            'role' => 'subscriber' // Mengatur peran pengguna sesuai kebutuhan
        );

        $user_id = wp_insert_user($user_data);

        // Menyimpan data tambahan ke dalam meta pengguna
        update_user_meta($user_id, 'no_kk', $no_kk);
        update_user_meta($user_id, 'no_hp', $no_hp);
        update_user_meta($user_id, 'alamat', $alamat);
        update_user_meta($user_id, 'warga_negara', $warga_negara);

        // Menyimpan foto profil
        if (!empty($photo)) {
            update_user_meta($user_id, 'photo', $photo);
        }

        // Pesan sukses
        echo '<div class="alert alert-success" role="alert">Pengguna berhasil ditambahkan!</div>';
    } ?>
    <div class="tambah-user">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="row m-0">
                <div class="col-md-3">
                    <div class="mb-2"><label for="photo">Photo Profil</label>
                        <input class="form-control" type="file" id="photo" name="photo" placeholder="">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group alert alert-primary p-2">
                        <label class="text-right"><strong>DATA DIRI :</strong></label>
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" id="nama_lengkap" name="nama_lengkap" placeholder="" required>
                        <label for="nama_lengkap">Nama Lengkap</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" id="nik" name="nik" placeholder="" required>
                        <label for="nik">NIK</label>
                        <small class="text-warning">Akan digunakan untuk username</small>
                    </div>

                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" id="password" name="password" minlength="6" maxlength="6" placeholder="" onkeypress="return hanyaAngka(event)" required>
                        <label for="password">Password</label>
                        <small class="text-danger fw-bold" id="error" style="display: none;">Harap masukan angka saja.</small>
                    </div>

                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" id="no_kk" name="no_kk" placeholder="" required>
                        <label for="no_kk">No KK</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" id="no_hp" name="no_hp" placeholder="" required>
                        <label for="no_hp">No HP</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" id=" alamat" name="alamat" placeholder="" required>
                        <label for="alamat">Alamat</label>
                    </div>

                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" id="warga_negara" name="warga_negara" placeholder="" required>
                        <label for="warga_negara">Warga Negara</label>
                    </div>

                    <div class="form-floating mb-2">
                        <select class="form-select" id="agama">
                            <option selected>--Pilih Agama--</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="katholik">Katholik</option>
                            <option value="buddha">Buddha</option>
                            <option value="hindu">Hindu</option>
                            <option value="konghuchu">Konghuchu</option>
                        </select>
                        <label for="agama">Pilih Agama</label>
                    </div>
                </div>
            </div>

            <button class="btn rounded-0 text-white btn-flat btn-danger btn-sm" type="reset" name="reset_form"><i class="fa fa-times"></i> Batal</button>
            <button class="btn rounded-0 text-white btn-flat btn-info btn-sm" type="submit" name="tambah_pengguna"><i class="fa fa-check"></i> Simpan</button>
        </form>
    </div>

<?php
    return ob_get_clean();
}
