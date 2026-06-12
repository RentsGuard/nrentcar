<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'nama_customer' => 'Budi Santoso', 'email' => 'budi@gmail.com', 'no_hp' => '081234567890',
                'nik' => '3174010101900001', 'alamat_customer' => 'Jl. Merdeka No. 45',
                'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '1990-01-01', 'jenis_kelamin' => 'L',
                'golongan_darah' => 'O', 'rt_rw' => '001/005', 'kelurahan' => 'Menteng',
                'kecamatan' => 'Menteng', 'kota_kabupaten' => 'Jakarta Pusat', 'provinsi' => 'DKI Jakarta',
                'agama' => 'Islam', 'status_perkawinan' => 'Kawin', 'pekerjaan' => 'PNS',
                'kewarganegaraan' => 'WNI', 'berlaku_hingga' => '2030-01-01',
            ],
            [
                'nama_customer' => 'Siti Nurhaliza', 'email' => 'siti@gmail.com', 'no_hp' => '081234567891',
                'nik' => '3273010202900002', 'alamat_customer' => 'Jl. Braga No. 78',
                'tempat_lahir' => 'Bandung', 'tanggal_lahir' => '1992-02-02', 'jenis_kelamin' => 'P',
                'golongan_darah' => 'A', 'rt_rw' => '002/003', 'kelurahan' => 'Braga',
                'kecamatan' => 'Sumur Bandung', 'kota_kabupaten' => 'Bandung', 'provinsi' => 'Jawa Barat',
                'agama' => 'Islam', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Karyawan Swasta',
                'kewarganegaraan' => 'WNI', 'berlaku_hingga' => '2032-02-02',
            ],
            [
                'nama_customer' => 'Agus Wijaya', 'email' => 'agus@gmail.com', 'no_hp' => '081234567892',
                'nik' => '3578030303900003', 'alamat_customer' => 'Jl. Tunjungan No. 12',
                'tempat_lahir' => 'Surabaya', 'tanggal_lahir' => '1985-03-03', 'jenis_kelamin' => 'L',
                'golongan_darah' => 'B', 'rt_rw' => '003/002', 'kelurahan' => 'Genteng',
                'kecamatan' => 'Genteng', 'kota_kabupaten' => 'Surabaya', 'provinsi' => 'Jawa Timur',
                'agama' => 'Kristen', 'status_perkawinan' => 'Kawin', 'pekerjaan' => 'Wirausaha',
                'kewarganegaraan' => 'WNI', 'berlaku_hingga' => '2029-03-03',
            ],
            [
                'nama_customer' => 'Dewi Lestari', 'email' => 'dewi@gmail.com', 'no_hp' => '081234567893',
                'nik' => '3471010404900004', 'alamat_customer' => 'Jl. Malioboro No. 33',
                'tempat_lahir' => 'Yogyakarta', 'tanggal_lahir' => '1995-04-04', 'jenis_kelamin' => 'P',
                'golongan_darah' => 'AB', 'rt_rw' => '001/001', 'kelurahan' => 'Sosromenduran',
                'kecamatan' => 'Gedongtengen', 'kota_kabupaten' => 'Yogyakarta', 'provinsi' => 'DI Yogyakarta',
                'agama' => 'Katolik', 'status_perkawinan' => 'Belum Kawin', 'pekerjaan' => 'Mahasiswa',
                'kewarganegaraan' => 'WNI', 'berlaku_hingga' => '2035-04-04',
            ],
            [
                'nama_customer' => 'Eko Prasetyo', 'email' => 'eko@gmail.com', 'no_hp' => '081234567894',
                'nik' => '3321050505900005', 'alamat_customer' => 'Jl. Pandanaran No. 56',
                'tempat_lahir' => 'Semarang', 'tanggal_lahir' => '1988-05-05', 'jenis_kelamin' => 'L',
                'golongan_darah' => 'O', 'rt_rw' => '005/004', 'kelurahan' => 'Pekunden',
                'kecamatan' => 'Semarang Tengah', 'kota_kabupaten' => 'Semarang', 'provinsi' => 'Jawa Tengah',
                'agama' => 'Islam', 'status_perkawinan' => 'Cerai', 'pekerjaan' => 'Dokter',
                'kewarganegaraan' => 'WNI', 'berlaku_hingga' => '2033-05-05',
            ],
        ];

        foreach ($customers as $c) {
            Customer::create($c);
        }
    }
}
