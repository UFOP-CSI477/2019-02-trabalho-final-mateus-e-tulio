<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
		    $table->bigInteger('posts_id')->unsigned();
		    $table->bigInteger('users_id')->unsigned();
		    $table->enum('viewed', ['Sim',  'Não'])->default('Não');
		    $table->text('comment')->nullable();
		    $table->enum('solved', ['Sim',  'Não'])->default('Não');
		    
		    $table->primary('posts_id', 'users_id');
		
		    $table->index('users_id','fk_posts_has_users_users1_idx');
		    $table->index('posts_id','fk_posts_has_users_posts1_idx');
		
		    $table->foreign('posts_id')
		        ->references('id')->on('posts')
                ->onDelete('cascade');
		
		    $table->foreign('users_id')
		        ->references('id')->on('users');
		
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
        Schema::dropIfExists('answers');
    }
}
