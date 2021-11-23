<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kamars')->insert([
            'namapemesan' => 'ali suma trapatoni',
            'tipekamar' => 'standart',
            'keterangan' => 'ini adalah tipe kamar standart',
        ]);
    }
}
