<?php

namespace Seeds\Local;

use App\Models\Advertisement;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder {
    public function run() {
        for( $i = 0; $i <= 50; $i++ ) {
            factory( Advertisement::class )->create();
        }
    }
}
