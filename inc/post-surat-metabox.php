<?php

/**
 * Register meta boxes for post pengajuan_surat.
 *
 * @package Velocity Surat
 */

add_filter('rwmb_meta_boxes', 'pengajuan_surat_register_meta_boxes');
function pengajuan_surat_register_meta_boxes($meta_boxes)
{
    $meta_boxes[] = [
        'title'   => esc_html__('Detail Pengajuan Surat', 'velocity'),
        'id'      => 'details',
        'context' => 'normal',
        'post_types'    => 'post',
        'priority'  => 'hight',
        'fields'  => [
            [
                'type' => 'heading',
                'name' => esc_html__('Data Umum', 'velocity'),
            ],
            [
                'type' => 'text',
                'name' => esc_html__('NIK', 'velocity'),
                'id'   => 'nik',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('No KK', 'velocity'),
                'id'   => 'no_kk',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Dipergunakan Untuk', 'velocity'),
                'id'   => 'dipergunakan_untuk',
            ],
            [
                'type' => 'heading',
                'name' => esc_html__('Keterangan Usaha', 'velocity'),
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Jenis Usaha', 'velocity'),
                'id'   => 'jenis_usaha',
            ],
            [
                'type' => 'heading',
                'name' => esc_html__('Keterangan Kepemilikan Lahan', 'velocity'),
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Luas Lahan', 'velocity'),
                'id'   => 'luas_lahan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Lokasi Lahan', 'velocity'),
                'id'   => 'lokasi_lahan',
            ],
            [
                'type' => 'heading',
                'name' => esc_html__('Permohonan Akta Lahir', 'velocity'),
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Nama Bayi', 'velocity'),
                'id'   => 'nama_bayi',
            ],
            [
                'type' => 'date',
                'name' => esc_html__('Tanggal Lahir', 'velocity'),
                'id'   => 'tanggal_lahir',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Tempat Lahir', 'velocity'),
                'id'   => 'tempat_lahir',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Berat', 'velocity'),
                'id'   => 'berat',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Panjang', 'velocity'),
                'id'   => 'panjang',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('NIK Ayah', 'velocity'),
                'id'   => 'nik_ayah',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('NIK Ibu', 'velocity'),
                'id'   => 'nik_ibu',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Nama Lengkap Saksi1', 'velocity'),
                'id'   => 'nama_lengkap_saksi1',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Nama Lengkap Saksi2', 'velocity'),
                'id'   => 'nama_lengkap_saksi2',
            ],
            [
                'type' => 'heading',
                'name' => esc_html__('Keterangan Kematian', 'velocity'),
            ],
            [
                'type' => 'date',
                'name' => esc_html__('Tanggal Meninggal', 'velocity'),
                'id'   => 'tanggal_meninggal',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Tempat Pemakaman', 'velocity'),
                'id'   => 'tempat_pemakaman',
            ],
            [
                'type' => 'heading',
                'name' => esc_html__('Keterangan Domisili', 'velocity'),
            ],
            [
                'type' => 'text_list',
                'name' => esc_html__('Alamat KTP', 'velocity'),
                'id'   => 'alamat_ktp',
            ],
            [
                'type' => 'heading',
                'name' => esc_html__('Keterangan Penghasilan Orangtua', 'velocity'),
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Tempat Pendidikan Pemohon', 'velocity'),
                'id'   => 'tempat_pendidikan_pemohon',
            ],
            [
                'type' => 'number',
                'name' => esc_html__('Penghasilan Ayah', 'velocity'),
                'id'   => 'penghasilan_ayah',
            ],
            [
                'type' => 'number',
                'name' => esc_html__('Penghasilan Ibu', 'velocity'),
                'id'   => 'penghasilan_ibu',
            ],
            [
                'type'    => 'select_advanced',
                'name'    => esc_html__('Status', 'velocity'),
                'id'      => 'status',
                'options' => [
                    'Dalam Antrian' => esc_html__('Dalam Antrian', 'velocity'),
                    'Diproses'      => esc_html__('Diproses', 'velocity'),
                    'Selesai'       => esc_html__('Selesai', 'velocity'),
                ],
            ],
        ],
    ];

    return $meta_boxes;
}
