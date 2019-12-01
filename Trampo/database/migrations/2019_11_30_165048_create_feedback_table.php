<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
		    $table->bigInteger('posts_id')->unsigned();
		    $table->integer('hirers_score')->nullable();
		    $table->integer('hireds_score')->nullable();
		    $table->text('message_for_hirer')->nullable();
		    $table->text('message_for_hired')->nullable();
		    
		    $table->primary('posts_id');
		
		    $table->foreign('posts_id')
		        ->references('id')->on('posts');
		
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
        Schema::dropIfExists('feedback');
    }
}
