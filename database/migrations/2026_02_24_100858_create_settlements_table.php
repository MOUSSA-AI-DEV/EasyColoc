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
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('colocation_id')->constrained()->onDelete('cascade');
            $table->foreignId('debtor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('creditor_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->unique(['colocation_id', 'debtor_id', 'creditor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settlements');
    }
};
