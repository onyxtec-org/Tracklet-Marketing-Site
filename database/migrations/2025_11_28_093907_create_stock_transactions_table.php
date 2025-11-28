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
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->foreignId('inventory_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('restrict'); // User who logged the transaction
            $table->enum('type', ['in', 'out']); // Stock in or stock out
            $table->integer('quantity');
            $table->date('transaction_date');
            $table->string('reference')->nullable(); // Purchase order, usage reason, etc.
            $table->text('notes')->nullable();
            $table->decimal('unit_price', 10, 2)->nullable(); // Price at time of transaction (for stock in)
            $table->string('vendor')->nullable(); // Vendor for stock in transactions
            $table->timestamps();
            
            $table->index(['organization_id', 'transaction_date']);
            $table->index(['organization_id', 'inventory_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};
