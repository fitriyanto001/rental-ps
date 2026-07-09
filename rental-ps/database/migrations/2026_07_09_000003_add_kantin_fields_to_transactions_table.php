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
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('total_rental')->default(0)->after('total_price');
            $table->integer('total_kantin')->default(0)->after('total_rental');
            $table->integer('grand_total')->default(0)->after('total_kantin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['total_rental', 'total_kantin', 'grand_total']);
        });
    }
};
