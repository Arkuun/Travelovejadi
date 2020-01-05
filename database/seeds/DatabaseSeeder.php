<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(KategoriTableSeeder::class);
        $this->call(SliderTableSeeder::class);
        $this->call(WisataTableSeeder::class);
        $this->call(BeritaTableSeeder::class);
        $this->call(Kat_WahanaTableSeeder::class);
    }
}
