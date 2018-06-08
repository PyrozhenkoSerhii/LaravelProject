<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');

            $table->string('title');
            $table->string('description');
            $table->text('content');
            $table->string('category');

            $table->string('img_url')->nullable();;

            $table->text('lecsics')->nullable();

            $table->integer('created_by')->unsigned();

            $table->timestamp('published_at')->nullable();
            $table->boolean('published')->default(false);

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');;

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
        Schema::dropIfExists('posts');
    }
}
