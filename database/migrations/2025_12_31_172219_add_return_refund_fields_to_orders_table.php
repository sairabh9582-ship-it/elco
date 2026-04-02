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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('return_status')->nullable()->default(null)->after('shiprocket_shipment_id'); // requested, approved, rejected
            $table->text('return_reason')->nullable()->after('return_status');
            $table->string('refund_status')->nullable()->default(null)->after('return_reason'); // pending, processed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['return_status', 'return_reason', 'refund_status']);
        });
    }
};
