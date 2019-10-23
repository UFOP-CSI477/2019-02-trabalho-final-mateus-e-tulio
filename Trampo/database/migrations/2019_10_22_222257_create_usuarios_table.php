<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function(Blueprint $table) {
		    $table->string('cpf', 11);
		    $table->string('nome', 45);
		    $table->string('sobrenome', 45);
		    $table->string('email', 45);
		    $table->string('senha', 255);
		    $table->string('celular', 11);
		    $table->string('cep', 8);
		    
		    $table->primary('cpf');
		
		    $table->unique('email','email_unique');
		
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
        Schema::dropIfExists('usuarios');
    }
}
