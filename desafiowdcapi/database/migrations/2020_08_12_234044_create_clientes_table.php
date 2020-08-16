<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('email',255);
            $table->string('nome',255)->nullable();
            $table->string('cidade',255)->nullable();
            $table->string('uf',255)->nullable();
            $table->string('cep',255)->nullable();
            $table->string('numero',255)->nullable();
            $table->string('logradouro',255)->nullable();
            $table->text('telefone',255)->nullable();
            $table->boolean('enviado')->default(0);	
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
        Schema::dropIfExists('clientes');
    }
}
