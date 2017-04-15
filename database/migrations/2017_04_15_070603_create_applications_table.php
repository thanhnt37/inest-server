<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateapplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('bundle_id');
            $table->string('version');
            $table->string('introduction');
            $table->string('icon');
            $table->string('ios_url');
            $table->string('android_url');
            $table->string('ads_type');

            $table->bigInteger('message_id')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('applications', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
