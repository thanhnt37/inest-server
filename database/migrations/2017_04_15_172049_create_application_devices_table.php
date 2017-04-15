<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateapplicationDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_devices', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('device_id');

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('application_devices', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_devices');
    }
}
