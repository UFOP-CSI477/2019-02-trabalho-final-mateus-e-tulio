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
        Schema::create('feedback', function(Blueprint $table) {
		    $table->integer('publicacao_id')->unsigned();
		    $table->integer('nota_ao_contratante')->unsigned()->nullable();
		    $table->integer('nota_ao_prestador')->unsigned()->nullable();
		    $table->text('comentario_ao_contratante')->nullable();
		    $table->text('comentario_ao_prestador')->nullable();
		    
		    $table->primary('publicacao_id');
		
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
        Schema::dropIfExists('feedback');
    }
}
