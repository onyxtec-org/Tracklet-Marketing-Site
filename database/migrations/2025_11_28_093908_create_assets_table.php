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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->string('asset_code')->unique(); // Unique asset code (auto-generated)
            $table->string('name');
            $table->string('category');
            $table->date('purchase_date');
            $table->decimal('purchase_price', 10, 2);
            $table->string('vendor')->nullable();
            $table->date('warranty_expiry')->nullable();
            $table->enum('status', ['active', 'in_repair', 'retired'])->default('active');
            $table->date('status_changed_at')->nullable(); // Date when status was last changed
            $table->text('status_change_reason')->nullable(); // Reason for status change (especially for retired)
            $table->foreignId('assigned_to_user_id')->nullable()->constrained('users')->onDelete('set null'); // Assigned to employee
            $table->string('assigned_to_location')->nullable(); // Assigned to location (Room 101, Marketing Dept, etc.)
            $table->text('description')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('model_number')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['organization_id', 'status']);
            $table->index(['organization_id', 'category']);
            $table->index(['organization_id', 'assigned_to_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
