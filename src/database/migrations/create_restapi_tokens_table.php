<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restapi_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->text('access_token');
            $table->text('token_type')->nullable();
            $table->text('scope')->nullable();
            $table->string('expires_in')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restapi_tokens');
    }
};
