<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
class MatakuliahsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matakuliahs')->insert([
            'nama' => 'Pemrograman Dasar'
        ]);
        DB::table('matakuliahs')->insert([
            'nama' => 'Pemrograman Lanjut'
        ]);
        DB::table('matakuliahs')->insert([
            'nama' => 'Algoritma dan Struktur Data'
        ]);
        DB::table('matakuliahs')->insert([
            'nama' => 'Sistem Basis Data'
        ]);
        DB::table('matakuliahs')->insert([
            'nama' => 'Jaringan Komputer Dasar'
        ]);
    }
}
