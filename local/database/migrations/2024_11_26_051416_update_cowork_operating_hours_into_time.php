<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('list_space_tbl', function (Blueprint $table) {
            $table->time('operating_hours_from')->nullable()->change();
            $table->time('operating_hours_to')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('list_space_tbl', function (Blueprint $table) {
            // Assuming the original datatype was `string`, adjust accordingly.
            $table->string('operating_hours_from')->nullable()->change();
            $table->string('operating_hours_to')->nullable()->change();
        });
    }
};
