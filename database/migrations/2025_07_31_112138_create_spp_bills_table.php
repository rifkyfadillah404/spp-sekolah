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
        Schema::create('spp_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('month');
            $table->string('year');
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['unpaid', 'paid', 'pending'])->default('unpaid');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->date('due_date');
            $table->timestamps();

            $table->unique(['student_id', 'month', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spp_bills');
    }
};
