<?php

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
        Schema::create('pedido', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor', 8 ,2);
            $table->string('status', 20)->default('Em avaliação');
            $table->foreignId('cliente_id')->constrained('cliente');
            $table->foreignId('cartao_id')->constrained('cartao');
            $table->foreignId('carrinho_id')->constrained('carrinho');
            $table->foreignId('transportadora_id')->constrained('transportadora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido');
    }
};
