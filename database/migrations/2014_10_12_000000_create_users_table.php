<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('activated')->default(true);
            $table->boolean('verified')->default(true);
            $table->string('password');
            $table->integer('city_id')->default(0);
            $table->integer('type')->default(\App\User::TYPE_USER);
            $table->decimal('balance');
            $table->string('contact');
            $table->string('contact_whatsapp');
            $table->string('contact_telegram');
            $table->text('description');
            $table->text('address');
            $table->string('image');
            $table->string('id_card_image');
            $table->json('data');
            $table->json('open_hours');
            $table->rememberToken();
            $table->timestamps();

            $table->index(['balance', 'type', 'city_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
