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
        Schema::table('finance_documents', function (Blueprint $table) {
            if (!Schema::hasColumn('finance_documents', 'user_id')) {
                $table->unsignedBigInteger('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('finance_documents', function (Blueprint $table) {
            //
        });
    }
};
