<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respostas', function(Blueprint $table) {
		    $table->string('user_cpf', 11);
		    $table->integer('publicacao_id')->unsigned();
		    $table->enum('endereco_visivel', ['Sim',  'Não'])->default('Não');
		    $table->enum('visualizado', ['Sim',  'Não'])->default('Não');
		    $table->text('comentario')->nullable();
		    
		    $table->primary('user_cpf', 'publicacao_id');
		
		    $table->index('publicacao_id','fk_users_has_publicacao1_publicacao1_idx');
		    $table->index('user_cpf','fk_users_has_publicacao1_users1_idx');
		
		    $table->foreign('user_cpf')
		        ->references('cpf')->on('users');
		
		    $table->foreign('publicacao_id')
		        ->references('id')->on('publicacao');
		
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
        Schema::dropIfExists('respostas');
    }
}
