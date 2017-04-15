<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatedevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('device_id');
            $table->string('name');
            $table->string('model');
            $table->string('platform');
            $table->string('os_version');

            $table->bigInteger('application_id');

            $table->boolean('lbh')->default(false);
            $table->string('mode_player')->default('xcd');
            $table->boolean('bg')->default(false);

            $table->string('ads_name');

            $table->softDeletes();
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('devices', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
