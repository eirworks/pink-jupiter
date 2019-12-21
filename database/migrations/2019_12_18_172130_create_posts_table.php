<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index();
            $table->bigInteger('post_category_id')->index();
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->dateTimeTz('published_at')->nullable()->default(null)->index();
            $table->timestamps();
            $table->index(['post_category_id', 'published_at'], 'cat_published_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
