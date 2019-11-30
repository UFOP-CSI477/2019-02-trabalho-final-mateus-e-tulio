<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cpf', 14)->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
		    $table->string('phone_number', 16);
		    $table->string('cep', 10);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        
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
        Schema::dropIfExists('users');
    }
}
