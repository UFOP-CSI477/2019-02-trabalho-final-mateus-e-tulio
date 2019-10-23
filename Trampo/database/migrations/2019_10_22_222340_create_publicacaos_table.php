<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacao', function(Blueprint $table) {
		    $table->integer('id')->unsigned();
		    $table->integer('categoria_id')->unsigned();
		    $table->string('contratante_cpf', 11)->nullable();
		    $table->string('prestador_cpf', 11)->nullable();
		    $table->enum('tipo_autor', ['Contratante',  'Prestador']);
		    $table->string('titulo', 45);
		    $table->text('descricao');
		    $table->string('cep', 8);
		    $table->enum('status', ['Concluído',  'Em Andamento', 'Cancelado'])->default('Em Andamento');
		    
		    $table->primary('id');
		
		    $table->index('categoria_id','fk_publicacao_categoria1_idx');
		    $table->index('contratante_cpf','fk_publicacao_usuario1_idx');
		    $table->index('prestador_cpf','fk_publicacao_usuario2_idx');
		
		    $table->foreign('categoria_id')
		        ->references('id')->on('categoria');
		
		    $table->foreign('contratante_cpf')
		        ->references('cpf')->on('usuario');
		
		    $table->foreign('prestador_cpf')
		        ->references('cpf')->on('usuario');
		
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
        Schema::dropIfExists('publicacaos');
    }
}
