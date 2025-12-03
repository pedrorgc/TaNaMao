<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prestadores', function (Blueprint $table) {
            // Cria a coluna se ela ainda não existir
            if (!Schema::hasColumn('prestadores', 'descricao')) {
                $table->text('descricao')->nullable()->after('telefone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('prestadores', function (Blueprint $table) {
            $table->dropColumn('descricao');
        });
    }
};