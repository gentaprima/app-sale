<?php

namespace Database\Seeders;

use App\Models\ModelUsers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id_member'=>"1",
                'full_name'=>"Admin",
                'phone_number'=>"0894382948932",
                'email' =>'admin@gmail.com',
                'password'=>Hash::make('admin'),
                'role'=>1
            ],
            [
                'id_member'=>"10",
                'full_name'=>"Genta",
                'phone_number'=>"0894382948932",
                'email' =>'genta@gmail.com',
                'password'=>Hash::make('123'),
                'role'=>0
            ]
            ];
        DB::table('tbl_users')->insert($users);

        $kriteria = [
            [
                'kriteria'  => "Volume Belanja",
                'jenis'     => 'Benefit',
                'bobot'     => '0.4'
            ],
            [
                'kriteria'  => "Total Belanja",
                'jenis'     => 'Benefit',
                'bobot'     => '0.4'
            ],
            [
                'kriteria'  => "Ekspedisi",
                'jenis'     => 'Cost',
                'bobot'     => '0.2'
            ]

        ];
        DB::table('tbl_kriteria')->insert($kriteria);

        $subKriteria = [
            [
                'id_kriteria'   => 1,
                'description'   => '5 kali dalam sebulan',
                'jumlah'   => 5,
                'nilai_bobot'     => 15
            ],
            [
                'id_kriteria'   => 1,
                'description'   => '8 kali dalam sebulan',
                'jumlah'   => 8,
                'nilai_bobot'     => 35
            ],
            [
                'id_kriteria'   => 1,
                'description'   => 'Lebih dari 10 kali dalam sebulan',
                'jumlah'   => 10,
                'nilai_bobot'     => 50
            ],
            [
                'id_kriteria'   => 2,
                'description'   => 'Total belanja sampai 500.000 selama 1 bulan',
                'jumlah'   => 500000,
                'nilai_bobot'     => 15
            ],
            [
                'id_kriteria'   => 2,
                'description'   => 'Total belanja sampai 700.000 selama 1 bulan',
                'jumlah'   => 700000,
                'nilai_bobot'     => 35
            ],
            [
                'id_kriteria'   => 2,
                'description'   => 'Total belanja lebih dari 1.000.000 selama 1 bulan',
                'jumlah'   => 1000000,
                'nilai_bobot'     => 50
            ],
            [
                'id_kriteria'   => 3,
                'description'   => 'Pengiriman Reguler (JNT,JNE,Sicepat)',
                'jumlah'   => 0,
                'nilai_bobot'     => 15
            ],
            [
                'id_kriteria'   => 3,
                'description'   => 'Pengiriman Sameday (Gojek,Grab)',
                'jumlah'   => 1,
                'nilai_bobot'     => 35
            ],
            [
                'id_kriteria'   => 3,
                'description'   => 'Ambil ditoko',
                'jumlah'   => 2,
                'nilai_bobot'     => 50
            ],
        ];

        DB::table('tbl_subkriteria')->insert($subKriteria);

    }
}
