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
    Schema::create('prestadores', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
            ->constrained('users')
            ->onDelete('cascade');

        $table->string('documento')->unique();

        $table->string('telefone');

        $table->foreignId('categoria_id')
            ->nullable()
            ->constrained('categorias')
            ->nullOnDelete();

        $table->foreignId('endereco_id')
            ->nullable()
            ->constrained('enderecos')
            ->nullOnDelete();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('prestadores');
}
};
