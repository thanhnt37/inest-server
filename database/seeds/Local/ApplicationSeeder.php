<?php

namespace Seeds\Local;

use App\Models\Application;
use App\Models\ApplicationDevice;
use App\Models\Device;
use App\Models\Message;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder {
    public function run() {
        for( $i = 0; $i < 10; $i++ ) {
            $message = factory( Message::class )->create();

            $app = factory( Application::class )->create(
                [
                    'message_id' => $message->id
                ]
            );

            foreach( range(10, 20) as $numberDevices ) {
                $device = factory( Device::class )->create();

                factory(ApplicationDevice::class)->create(
                    [
                        'application_id' => $app->id,
                        'device_id'      => $device->id
                    ]
                );
            }
        }
    }
}
