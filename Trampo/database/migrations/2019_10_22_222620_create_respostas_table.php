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
		    $table->string('usuario_cpf', 11);
		    $table->integer('publicacao_id')->unsigned();
		    $table->enum('endereco_visivel', ['Sim',  'Não'])->default('Não');
		    $table->enum('visualizado', ['Sim',  'Não'])->default('Não');
		    $table->text('comentario')->nullable();
		    
		    $table->primary('usuario_cpf', 'publicacao_id');
		
		    $table->index('publicacao_id','fk_usuario_has_publicacao1_publicacao1_idx');
		    $table->index('usuario_cpf','fk_usuario_has_publicacao1_usuario1_idx');
		
		    $table->foreign('usuario_cpf')
		        ->references('cpf')->on('usuario');
		
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
