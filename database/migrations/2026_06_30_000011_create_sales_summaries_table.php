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
        Schema::create('sales_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->nullable()->constrained('stores')->cascadeOnDelete()->comment('Nullable, NULL for global platform report');
            $table->date('report_date');
            $table->decimal('total_revenue', 12, 2);
            $table->integer('total_orders');
            $table->timestamps();

            // Unique constraint to prevent duplicate summaries for the same store and date
            $table->unique(['store_id', 'report_date'], 'sales_summaries_store_id_report_date_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_summaries');
    }
};
