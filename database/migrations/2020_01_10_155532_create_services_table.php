<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index();
            $table->bigInteger('city_id')->index();
            $table->bigInteger('category_id')->index();
            $table->string('name');
            $table->string('image');
            $table->decimal('price', 14, 2);
            $table->boolean('activated')->default(false)->index();
            $table->text('description');
            $table->json('data');
            $table->timestamps();

            $table->index(['city_id', 'category_id', 'activated'], 'services_search_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
