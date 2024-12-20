<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('desk_fields', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->integer('space_id'); // Foreign key to lst_space_tbl
            $table->string('duration'); // Duration in minutes, hours, or as needed
            $table->decimal('price', 8, 2); // Price with two decimal places
            $table->string('hours'); // Hours in a suitable format, e.g., JSON or text
            $table->timestamps(); // Created at & Updated at timestamps

            // Foreign Key Constraint (optional)
            $table->foreign('space_id')->references('id')->on('list_space_tbl')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desk_fields');
    }
};