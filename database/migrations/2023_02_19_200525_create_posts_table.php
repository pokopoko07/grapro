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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title');
            $table->text('body');
            $table->text('image_main')->nullable();
            $table->text('image_sub1')->nullable();
            $table->text('image_sub2')->nullable();
            $table->text('image_sub3')->nullable();
            $table->text('image_sub4')->nullable();
            $table->string('hp_adress')->nullable();
            $table->foreignId('area_id');
            $table->boolean('park');
            $table->boolean('indoor_fac');
            $table->boolean('shopping');
            $table->boolean('gourmet');
            $table->boolean('others');
            $table->integer('infant');
            $table->integer('lower_grade');
            $table->integer('higher_grade');
            $table->integer('over13');
            $table->integer('dogs')->nullable();
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
};
