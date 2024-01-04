<?php

/**
 * Theme basic setup.
 *
 * @package velocity
 */
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
        $email = $_POST['email'];
        $warga_negara = $_POST['warga_negara'];

        // Memeriksa apakah file foto diunggah
        if ($_FILES['profile_picture']['name']) {
            $photo = $_FILES['profile_picture']['name'];
            $photo_temp = $_FILES['profile_picture']['tmp_name'];
            $photo_size = $_FILES['profile_picture']['size'];
            // Memeriksa ukuran file foto
            if ($photo_size > 500000) {
                echo 'Ukuran foto melebihi batas maksimum (500KB).';
                exit;
            }

            $photo_path = wp_upload_dir()['path'] . '/' . $photo;
            move_uploaded_file($photo_temp, $photo_path);
        } else {
            $photo = '';
        }

        // Memasukkan data ke dalam database WordPress
        $user_data = array(
            'user_login' => $nik, // Menggunakan Nama Lengkap sebagai username
            'user_pass' => $pass, // Menghasilkan password acak
            'user_email' => $email, // Email dapat ditambahkan jika diperlukan
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
            update_user_meta($user_id, 'profile_picture', $photo);
        }

        // Pesan sukses
        echo '<div class="alert alert-success" role="alert">Pengguna berhasil ditambahkan!</div>';
    } ?>
    <div class="tambah-user">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="row m-0">
                <div class="col-md-3 p-2">
                    <div class="card border-3 border-top border-0 rounded border-info p-2">
                        <div class="form-group alert alert-primary p-2">
                            <label class="text-right"><strong>PHOTO PROFILE & PIN :</strong></label>
                        </div>
                        <div class="box-photo p-2 m-2 border-3 border rounded-4">
                            <?php $urlimg = VELOCITY_SURAT_PLUGIN_URL . 'public/assets/user-profile.png'; ?>
                            <img class="penduduk" id="preview_image" src="<?php echo $urlimg; ?>" alt="Foto Penduduk">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="file" id="profile_picture" name="profile_picture" placeholder="">
                            <small class="text-muted">Max. Upload : 500Kb</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 p-2">
                    <div class="card border-3 border-top border-0 rounded border-info p-2">
                        <div class="form-group alert alert-primary p-2">
                            <label class="text-right"><strong>DATA DIRI :</strong></label>
                        </div>

                        <div class="row m-0">
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="text" id="nik" name="nik" minlength="16" maxlength="16" placeholder="" onkeypress="return hanyaAngka(event)" required>
                                    <label for="nik">NIK</label>
                                    <small class="text-warning">Akan digunakan untuk username login</small>
                                </div>
                            </div>
                            <div class="col-md-8 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="text" id="nama_lengkap" name="nama_lengkap" placeholder="" required>
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="text" id="no_kk" name="no_kk" minlength="16" maxlength="16" placeholder="" onkeypress="return hanyaAngka(event)" required>
                                    <label for="no_kk">No KK</label>
                                </div>
                            </div>
                            <div class="col-md-4 p-1">
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
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <select class="form-select" id="jenis_kelamin">
                                        <option selected>--Pilih Agama--</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <label for="jenis_kelamin">Pilih Jenis Kelamin</label>
                                </div>
                            </div>

                            <div class="col-md-6 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="text" id="warga_negara" name="warga_negara" placeholder="" required>
                                    <label for="warga_negara">Warga Negara</label>
                                </div>
                            </div>
                            <div class="col-md-6 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="text" id="password" name="password" minlength="6" maxlength="6" placeholder="" onkeypress="return hanyaAngka(event)" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group alert alert-primary p-2">
                            <label class="text-right"><strong>DATA KELAHIRAN :</strong></label>
                        </div>

                        <div class="row m-0">
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="text" id="no_akta_lahir" name="no_akta_lahir" placeholder="" required>
                                    <label for="no_akta_lahir">No Akta Kelahiran</label>
                                </div>
                            </div>
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="text" id="tmpt_lahir" name="tmpt_lahir" placeholder="" required>
                                    <label for="tmpt_lahir">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="date" id="tgl_lahir" name="tgl_lahir" placeholder="" required>
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group alert alert-primary p-2">
                            <label class="text-right"><strong>PENDIDIKAN DAN PEKERJAAN :</strong></label>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <select class="form-select" id="pend_kk">
                                        <option selected>--Pilih Pendidikan (Dalam KK)--</option>
                                        <option value="TIDAK / BELUM SEKOLAH">TIDAK / BELUM SEKOLAH</option>
                                        <option value="BELUM TAMAT SD/SEDERAJAT">BELUM TAMAT SD/SEDERAJAT</option>
                                        <option value="TAMAT SD / SEDERAJAT">TAMAT SD / SEDERAJAT</option>
                                        <option value="SLTP/SEDERAJAT">SLTP/SEDERAJAT</option>
                                        <option value="SLTA / SEDERAJAT">SLTA / SEDERAJAT</option>
                                        <option value=">DIPLOMA I / II">DIPLOMA I / II</option>
                                        <option value="AKADEMI/ DIPLOMA III/S. MUDA">AKADEMI/ DIPLOMA III/S. MUDA</option>
                                        <option value="DIPLOMA IV/ STRATA I">DIPLOMA IV/ STRATA I</option>
                                        <option value="STRATA II">STRATA II</option>
                                        <option value="STRATA III">STRATA III</option>
                                    </select>
                                    <label for="pend_kk">Pendidikan dalam KK</label>
                                </div>
                            </div>
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <select class="form-control input-sm" name="pend_sedang_ditempuh">
                                        <option value="">--Pilih Pendidikan--</option>
                                        <option value="BELUM MASUK TK/KELOMPOK BERMAIN">BELUM MASUK TK/KELOMPOK BERMAIN</option>
                                        <option value="SEDANG TK/KELOMPOK BERMAIN">SEDANG TK/KELOMPOK BERMAIN</option>
                                        <option value="TIDAK PERNAH SEKOLAH">TIDAK PERNAH SEKOLAH</option>
                                        <option value="SEDANG SD/SEDERAJAT">SEDANG SD/SEDERAJAT</option>
                                        <option value="TIDAK TAMAT SD/SEDERAJAT">TIDAK TAMAT SD/SEDERAJAT</option>
                                        <option value="SEDANG SLTP/SEDERAJAT">SEDANG SLTP/SEDERAJAT</option>
                                        <option value="SEDANG SLTA/SEDERAJAT">SEDANG SLTA/SEDERAJAT</option>
                                        <option value="SEDANG D-1/SEDERAJAT">SEDANG D-1/SEDERAJAT</option>
                                        <option value="SEDANG D-2/SEDERAJAT">SEDANG D-2/SEDERAJAT</option>
                                        <option value="SEDANG D-3/SEDERAJAT">SEDANG D-3/SEDERAJAT</option>
                                        <option value="SEDANG S-1/SEDERAJAT">SEDANG S-1/SEDERAJAT</option>
                                        <option value="SEDANG S-2/SEDERAJAT">SEDANG S-2/SEDERAJAT</option>
                                        <option value="SEDANG S-3/SEDERAJAT">SEDANG S-3/SEDERAJAT</option>
                                        <option value="SEDANG SLB A/SEDERAJAT">SEDANG SLB A/SEDERAJAT</option>
                                        <option value="SEDANG SLB B/SEDERAJAT">SEDANG SLB B/SEDERAJAT</option>
                                        <option value="SEDANG SLB C/SEDERAJAT">SEDANG SLB C/SEDERAJAT</option>
                                        <option value="TIDAK DAPAT MEMBACA DAN MENULIS HURUF LATIN/ARAB">TIDAK DAPAT MEMBACA DAN MENULIS HURUF LATIN/ARAB</option>
                                        <option value="TIDAK SEDANG SEKOLAH">TIDAK SEDANG SEKOLAH</option>
                                    </select>
                                    <label for="pend_sedang_ditempuh">Pendidikan Sedang Ditempuh</label>
                                </div>
                            </div>
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <select class="form-control input-sm required" name="pekerjaan">
                                        <option value="">--Pilih Pekerjaan--</option>
                                        <option value="BELUM/TIDAK BEKERJA">BELUM/TIDAK BEKERJA</option>
                                        <option value="MENGURUS RUMAH TANGGA">MENGURUS RUMAH TANGGA</option>
                                        <option value="PELAJAR/MAHASISWA">PELAJAR/MAHASISWA</option>
                                        <option value="PENSIUNAN">PENSIUNAN</option>
                                        <option value="PEGAWAI NEGERI SIPIL (PNS)">PEGAWAI NEGERI SIPIL (PNS)</option>
                                        <option value="TENTARA NASIONAL INDONESIA (TNI)">TENTARA NASIONAL INDONESIA (TNI)</option>
                                        <option value="KEPOLISIAN RI (POLRI)">KEPOLISIAN RI (POLRI)</option>
                                        <option value="PERDAGANGAN">PERDAGANGAN</option>
                                        <option value="PETANI/PEKEBUN">PETANI/PEKEBUN</option>
                                        <option value="PETERNAK">PETERNAK</option>
                                        <option value="NELAYAN/PERIKANAN">NELAYAN/PERIKANAN</option>
                                        <option value="INDUSTRI">INDUSTRI</option>
                                        <option value="KONSTRUKSI">KONSTRUKSI</option>
                                        <option value="TRANSPORTASI">TRANSPORTASI</option>
                                        <option value="KARYAWAN SWASTA">KARYAWAN SWASTA</option>
                                        <option value="KARYAWAN BUMN">KARYAWAN BUMN</option>
                                        <option value="KARYAWAN BUMD">KARYAWAN BUMD</option>
                                        <option value="KARYAWAN HONORER">KARYAWAN HONORER</option>
                                        <option value="BURUH HARIAN LEPAS">BURUH HARIAN LEPAS</option>
                                        <option value="BURUH TANI/PERKEBUNA">BURUH TANI/PERKEBUNAN</option>
                                        <option value="BURUH NELAYAN/PERIKANAN">BURUH NELAYAN/PERIKANAN</option>
                                        <option value="BURUH PETERNAKAN">BURUH PETERNAKAN</option>
                                        <option value="PEMBANTU RUMAH TANGGA">PEMBANTU RUMAH TANGGA</option>
                                        <option value="TUKANG CUKUR">TUKANG CUKUR</option>
                                        <option value="TUKANG LISTRIK">TUKANG LISTRIK</option>
                                        <option value="TUKANG BATU">TUKANG BATU</option>
                                        <option value="TUKANG KAYU">TUKANG KAYU</option>
                                        <option value="TUKANG SOL SEPATU">TUKANG SOL SEPATU</option>
                                        <option value="TUKANG LAS/PANDAI BESI">TUKANG LAS/PANDAI BESI</option>
                                        <option value="TUKANG JAHIT">TUKANG JAHIT</option>
                                        <option value="TUKANG GIGI">TUKANG GIGI</option>
                                        <option value="PENATA RIAS">PENATA RIAS</option>
                                        <option value="PENATA BUSANA">PENATA BUSANA</option>
                                        <option value="PENATA RAMBUT">PENATA RAMBUT</option>
                                        <option value="MEKANIK">MEKANIK</option>
                                        <option value="SENIMAN">SENIMAN</option>
                                        <option value="TABIB">TABIB</option>
                                        <option value="PARAJI">PARAJI</option>
                                        <option value="PERANCANG BUSANA">PERANCANG BUSANA</option>
                                        <option value="PENTERJEMAH">PENTERJEMAH</option>
                                        <option value="IMAM MASJID">IMAM MASJID</option>
                                        <option value="PENDETA">PENDETA</option>
                                        <option value="PASTOR">PASTOR</option>
                                        <option value="WARTAWAN">WARTAWAN</option>
                                        <option value="USTADZ/MUBALIGH">USTADZ/MUBALIGH</option>
                                        <option value="JURU MASAK">JURU MASAK</option>
                                        <option value="PROMOTOR ACARA">PROMOTOR ACARA</option>
                                        <option value="ANGGOTA DPR-RI">ANGGOTA DPR-RI</option>
                                        <option value="ANGGOTA DPD">ANGGOTA DPD</option>
                                        <option value="ANGGOTA BP">ANGGOTA BPK</option>
                                        <option value="PRESIDEN">PRESIDEN</option>
                                        <option value="WAKIL PRESIDEN">WAKIL PRESIDEN</option>
                                        <option value="ANGGOTA MAHKAMAH KONSTITUSI">ANGGOTA MAHKAMAH KONSTITUSI</option>
                                        <option value="ANGGOTA KABINET KEMENTERIAN">ANGGOTA KABINET KEMENTERIAN</option>
                                        <option value="DUTA BESAR">DUTA BESAR</option>
                                        <option value="GUBERNUR">GUBERNUR</option>
                                        <option value="WAKIL GUBERNUR">WAKIL GUBERNUR</option>
                                        <option value="BUPATI">BUPATI</option>
                                        <option value="WAKIL BUPATI">WAKIL BUPATI</option>
                                        <option value="WALIKOTA">WALIKOTA</option>
                                        <option value="WAKIL WALIKOTA">WAKIL WALIKOTA</option>
                                        <option value="ANGGOTA DPRD PROVINSI">ANGGOTA DPRD PROVINSI</option>
                                        <option value="ANGGOTA DPRD KABUPATEN/KOTA">ANGGOTA DPRD KABUPATEN/KOTA</option>
                                        <option value="DOSEN">DOSEN</option>
                                        <option value="GURU">GURU</option>
                                        <option value="PILOT">PILOT</option>
                                        <option value="PENGACARA">PENGACARA</option>
                                        <option value="NOTARIS">NOTARIS</option>
                                        <option value="ARSITEK">ARSITEK</option>
                                        <option value="AKUNTAN">AKUNTAN</option>
                                        <option value="KONSULTAN">KONSULTAN</option>
                                        <option value="DOKTER">DOKTER</option>
                                        <option value="BIDAN">BIDAN</option>
                                        <option value="PERAWAT">PERAWAT</option>
                                        <option value="APOTEKER">APOTEKER</option>
                                        <option value="PSIKIATER/PSIKOLOG">PSIKIATER/PSIKOLOG</option>
                                        <option value="PENYIAR TELEVISI">PENYIAR TELEVISI</option>
                                        <option value="PENYIAR RADIO">PENYIAR RADIO</option>
                                        <option value="PELAUT">PELAUT</option>
                                        <option value="PENELITI">PENELITI</option>
                                        <option value="SOPIR">SOPIR</option>
                                        <option value="PIALANG">PIALANG</option>
                                        <option value="PARANORMAL">PARANORMAL</option>
                                        <option value="PEDAGANG">PEDAGANG</option>
                                        <option value="PERANGKAT DESA">PERANGKAT DESA</option>
                                        <option value="KEPALA DESA">KEPALA DESA</option>
                                        <option value="BIARAWATI">BIARAWATI</option>
                                        <option value="WIRASWASTA">WIRASWASTA</option>
                                        <option value="LAINNYA">LAINNYA</option>
                                    </select>
                                    <label for="pekerjaan">Pekerjaaan</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group alert alert-primary p-2">
                            <label class="text-right"><strong>ALAMAT :</strong></label>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-12 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="text" id=" alamat" name="alamat" placeholder="" required>
                                    <label for="alamat">Alamat</label>
                                </div>
                            </div>
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="text" id="no_hp" name="no_hp" placeholder="" required>
                                    <label for="no_hp">No HP</label>
                                </div>
                            </div>
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="email" id="email" name="email" placeholder="" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-4 p-1">
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="text" id="telegram" name="telegram" placeholder="" required>
                                    <label for="telegram">Telegram</label>
                                </div>
                            </div>
                        </div>
                        <!-- 
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="flex-fill text-start">
                                <button class="btn rounded-0 text-white btn-flat btn-danger btn-sm" type="reset" name="reset_form"><i class="fa fa-times"></i> Batal</button>
                            </div> -->
                        <div class="flex-fill text-start">
                            <button class="btn rounded-0 text-white btn-flat btn-dark btn-sm" type="reset" name="reset_form"><i class="fa fa-undo"></i> Reset</button>
                        </div>
                        <div class="flex-fill text-end">
                            <button class="btn rounded-0 text-white btn-flat btn-info btn-sm" type="submit" name="tambah_pengguna"><i class="fa fa-check"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>

<?php
    return ob_get_clean();
}
