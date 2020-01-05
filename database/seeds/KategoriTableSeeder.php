<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('kategori')->insert([
         [
            'name'  => 'umum',
            'status' => 1],
         [
            'name'  => 'khusus',
            'status' => 1]
         ]);
    }
}
