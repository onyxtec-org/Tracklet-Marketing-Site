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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('category')->nullable();
            $table->integer('quantity')->default(0); // Current stock
            $table->integer('minimum_threshold')->default(0); // Low stock warning threshold
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2)->default(0); // Calculated: quantity * unit_price
            $table->string('unit')->default('pcs'); // Unit of measurement (pcs, kg, liters, etc.)
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['organization_id', 'category']);
            $table->index(['organization_id', 'quantity']); // For low stock queries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
