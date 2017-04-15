<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatemessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');
            $table->text('message');
            $table->string('image_url');
            $table->string('ok_title');
            $table->string('url');

            $table->softDeletes();
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('messages', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
