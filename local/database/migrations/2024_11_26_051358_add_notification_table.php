<?php

use App\Models\Transaction;
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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->integer('space_id');
            $table->foreign('space_id')->references('id')->on('list_space_tbl')->onDelete('cascade');
            $table->foreignIdFor(Transaction::class)->constrained()->onDelete('cascade');
            $table->text('subject')->default("");
            $table->text('content')->default("");
            $table->text('url')->default("");
            $table->string('type')->default("USER"); // USER / SYSTEM
            $table->boolean('isRead')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};