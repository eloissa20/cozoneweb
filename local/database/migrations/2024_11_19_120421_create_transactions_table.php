<?php

use App\Models\Cowork;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->integer('space_id');
            $table->foreign('space_id')->references('id')->on('list_space_tbl')->onDelete('cascade');
            $table->date('reservation_date'); // Date of the reservation
            $table->integer('hours'); // Hours reserved
            $table->integer('guests'); // Number of guests
            $table->string('name'); // Full name
            $table->string('email'); // Email address
            $table->string('company')->nullable(); // Company name (nullable)
            $table->string('contact'); // Contact number
            $table->time('arrival_time'); // Estimated arrival time

            // Amount for the transaction
            $table->decimal('amount', 10, 2)->nullable();

            // Payment method and status fields
            $table->string('payment_method', 50)->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};