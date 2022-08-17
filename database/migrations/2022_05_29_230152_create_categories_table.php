<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('model_type');
            $table->timestamps();
        });

        Schema::create('recipe_categories', function (Blueprint $table) {
            $table->unsignedInteger('recipes_id');
            $table->unsignedInteger('category_id');
        });

        Schema::create('news_categories', function (Blueprint $table) {
            $table->unsignedInteger('news_id');
            $table->unsignedInteger('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('recipe_categories');
        Schema::dropIfExists('news_categories');
    }
}
