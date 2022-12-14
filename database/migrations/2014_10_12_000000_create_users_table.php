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
            $table->id();

            $table->string('nome_completo');
            $table->char('cpf', 11);
            $table->date('nascimento')->nullable();
            $table->text('foto_documento')->nullable();
            $table->text('foto_usuario')->nullable();
            $table->char('telefone', 11)->nullable();

            $table->integer('tipo_usuario')->nullable();
            $table->string('chave_pix')->nullable();
            $table->integer('reputacao')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
