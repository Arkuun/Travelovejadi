<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WisataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wisata')->insert([
         	'id_user'  => '1',
            'name'  => 'Baturaden Hits',
            'email' => 'baturaden@gmail.com',
            'long_titude' => '989,0008',
            'late_titude' => '989,782',
            'phone' =>'082243941676',
            'address'=>'Purwokerto',
            'slug'=>'baturaden-hits',
            'url'=>'www.baturaden.com',
            'htm'=>'15000',
            'description'=>'-',
            'image'  =>'',
            'status' => 1,
         ]);
    }
}
