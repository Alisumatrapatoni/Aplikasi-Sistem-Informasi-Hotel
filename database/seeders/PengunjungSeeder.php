<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengunjungs')->insert([
            'noktp' => '312353453467',
            'nama' => 'sukadi',
            'jeniskelamin' => 'cowo',
            'nohp' => '086483248732',
            'alamat' => 'sidoarjo',
            'status' =>  'booked',

        ]);
    }
}
