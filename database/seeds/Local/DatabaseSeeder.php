<?php

namespace Seeds\Local;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ArticleSeeder::class);
         $this->call(AdvertisementSeeder::class);
         $this->call(ApplicationSeeder::class);
    }
}
