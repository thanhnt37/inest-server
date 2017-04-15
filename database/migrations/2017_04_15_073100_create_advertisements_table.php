<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateadvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('type')->default('normal');
            $table->string('name');
            $table->string('icon_url');
            $table->string('url');
            $table->string('description');

            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('advertisements', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
