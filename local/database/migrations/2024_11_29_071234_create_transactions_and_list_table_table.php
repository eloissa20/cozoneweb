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
        Schema::create('list_space_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('role')->nullable();
            $table->string('coworking_space_name')->nullable();
            $table->string('coworking_space_address')->nullable();
            $table->string('space_name')->nullable();
            $table->string('type_of_space')->nullable();
            $table->string('description')->nullable();
            $table->date('opening_date')->nullable();
            $table->string('available_days_from')->nullable();
            $table->string('available_days_to')->nullable();
            $table->string('exceptions')->nullable();
            $table->time('operating_hours_from')->nullable();
            $table->time('operating_hours_to')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('basics')->nullable();
            $table->string('seats')->nullable();
            $table->string('equipment')->nullable();
            $table->string('facilities')->nullable();
            $table->string('accessibility')->nullable();
            $table->string('perks')->nullable();
            $table->string('location')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('country')->nullable();
            $table->string('unit')->nullable();
            $table->string('postal')->nullable();
            $table->string('city')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('tables')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('meeting_rooms')->nullable();
            $table->integer('virtual_offices')->nullable();
            $table->string('measurement_unit')->nullable();
            $table->integer('size')->nullable();
            $table->string('header_image')->nullable();
            $table->string('additional_images')->nullable();
            $table->string('pay_online')->nullable();
            $table->string('credit_cards')->nullable();
            $table->string('eWallet')->nullable();
            $table->string('desk_fields')->nullable();
            $table->string('meeting_fields')->nullable();
            $table->string('virtual_service')->nullable();
            $table->string('membership')->nullable();
            $table->integer('membership_duration')->nullable();
            $table->integer('membership_price')->nullable();
            $table->string('short_term')->nullable();
            $table->string('free_pass')->nullable();
            $table->string('short_term_details')->nullable();
            $table->string('free_pass_details')->nullable();
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->integer('space_id');
            $table->foreign('space_id')->references('id')->on('list_space_tbl')->onDelete('cascade');
            $table->date('reservation_date'); // Date of the reservation
            $table->string('hours'); // Hours reserved
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
        Schema::dropIfExists('list_space_tbl');
    }
};
