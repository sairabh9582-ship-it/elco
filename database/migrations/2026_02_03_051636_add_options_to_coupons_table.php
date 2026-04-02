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
        Schema::table('coupons', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('expiry_date');
            $table->enum('target_type', ['total_order', 'product', 'category', 'welcome'])->default('total_order')->after('type');
            $table->json('target_ids')->nullable()->after('target_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'target_type', 'target_ids']);
        });
    }
};
