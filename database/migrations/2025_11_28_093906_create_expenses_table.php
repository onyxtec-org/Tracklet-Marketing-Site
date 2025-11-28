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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->foreignId('expense_category_id')->constrained()->onDelete('restrict');
            $table->foreignId('user_id')->constrained()->onDelete('restrict'); // User who created the expense
            $table->date('expense_date');
            $table->decimal('amount', 10, 2);
            $table->string('vendor_payee')->nullable();
            $table->text('description')->nullable();
            $table->string('receipt_path')->nullable(); // File path for receipt/invoice
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['organization_id', 'expense_date']);
            $table->index(['organization_id', 'expense_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
