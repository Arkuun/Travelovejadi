<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('slider')->insert([
         [
            'image'  => 'http://localhost/ojal/media/slider/slider_1.jpg',
            'status' => 1,
        	'sort'   => 1],
         [
            'image'  => 'http://localhost/ojal/media/slider/slider_2.jpg',
            'status' => 1,
        	'sort'   => 1]
         ]);
    }
}

