<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('cowork_id')->constrained('users')->onDelete('cascade'); // Foreign key to users (coworkers)
            $table->foreignId('review_id')->constrained('reviews')->onDelete('cascade'); // Foreign key to reviews table
            $table->text('reply'); // The reply content
            $table->timestamps(); // Created at, updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('replies');
    }
};
