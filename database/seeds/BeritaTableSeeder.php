<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeritaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('berita')->insert([
        	'id_user'		=>	'2',
        	'id_kat'		=>	'1',
        	'title'			=>	'Baturaden Memiliki Wahana Baru',
        	'description'	=>	'Baturaden sebagai salah satu destinasi wisata di Kota Purwokerto, memiliki wahana baru yaitu Wahana Terjun Payung yang terletak di Curug 7.',
        	'image'			=>	'',
        	'slug'			=>	'baturaden-memiliki-wahana-baru',
        	'view'			=>	203,
        	'love'			=>	1,
        	'tag'			=>	'baturaden'

        ]);
    }
}
