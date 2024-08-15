<?php

use App\Enums\ComoNosConheceu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();
            $table->string('cep');
            $table->string('nome');
            $table->string('cpf');
            $table->char('whatsapp', 11);
            $table->char('contato', 11)->nullable();
            $table->enum('como_nos_conheceu', ComoNosConheceu::getComoNosConheceu());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendimentos');
    }
};
