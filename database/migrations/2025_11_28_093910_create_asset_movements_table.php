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
        Schema::create('asset_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->foreignId('asset_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('restrict'); // User who logged the movement
            $table->date('movement_date');
            $table->enum('movement_type', ['assignment', 'location_change', 'return', 'other']);
            $table->foreignId('from_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('from_location')->nullable();
            $table->foreignId('to_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('to_location')->nullable();
            $table->text('reason')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['organization_id', 'asset_id']);
            $table->index(['organization_id', 'movement_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_movements');
    }
};
