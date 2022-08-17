<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('sub_url')->unique()->nullable();
            $table->longText('description');
            $table->json('ingredients')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('last_code')->default(1);
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamp('publish')->nullable();
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
        Schema::dropIfExists('recipes');
    }
}
