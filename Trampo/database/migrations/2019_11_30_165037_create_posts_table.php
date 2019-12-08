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
		    $table->bigInteger('categories_id')->unsigned();
		    $table->bigInteger('hirer_id')->unsigned()->nullable();
		    $table->bigInteger('hired_id')->unsigned()->nullable();
		    $table->enum('author_type', ['Contratante',  'Prestador']);
		    $table->string('title', 45);
		    $table->text('description');
            $table->string('cep', 10);
            $table->string('state');
            $table->string('city');
            $table->string('neighborhood');
		    $table->enum('status', ['Concluído',  'Em Andamento',  'Cancelado'])->default('Em Andamento');
		
		    $table->index('categories_id','fk_posts_categories_idx');
		    $table->index('hirer_id','fk_posts_users1_idx');
		    $table->index('hired_id','fk_posts_users2_idx');
		
		    $table->foreign('categories_id')
		        ->references('id')->on('categories');
		
		    $table->foreign('hirer_id')
		        ->references('id')->on('users');
		
		    $table->foreign('hired_id')
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
        Schema::dropIfExists('posts');
    }
}
