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
		Schema::create('videos', function (Blueprint $table) {
        	$table->id();
            $table->string('title');
            $table->string('url');
            $table->string('duration')->nullable();
            $table->text('description')->nullable();
            $table->enum('role', ['technicien', 'adv', 'comptabilite', 'commerciaux']);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
        	$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
