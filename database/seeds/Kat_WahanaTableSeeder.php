<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Kat_WahanaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kat_wahana')->insert([
         [
            'name'  => 'Air',
            'status' => 1],
         [
            'name'  => 'Garden',
            'status' => 1]
         ]);
    }
}
