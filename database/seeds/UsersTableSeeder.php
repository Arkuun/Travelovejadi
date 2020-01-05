<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
         [
            'name'  => 'bawor',
            'email' => 'bawor@gmail.com',
            'tipe'  => 0,
            'no_hp' =>'082243941676',
            'alamat'=>'Purwokerto',
            'foto'  =>'',
            'password' => bcrypt('bawor')
        ],
        [
            'name'  => 'gareng',
            'email' => 'gareng@gmail.com',
            'tipe'  => 1,
            'no_hp' =>'082243941676',
            'alamat'=>'Purwokerto',
            'foto'  =>'',
            'password' => bcrypt('gareng')
        ],
        [
            'name'  => 'bagong',
            'email' => 'bagong@gmail.com',
            'tipe'  => 2,
            'no_hp' =>'082243941676',
            'alamat'=>'Purwokerto',
            'foto'  =>'',
            'password' => bcrypt('bagong')
        ]
    ]);
    }
}
