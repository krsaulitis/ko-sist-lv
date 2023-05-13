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
        Schema::create('audition_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreign('conductor_id')->references('id')->on('users')->nullable; //->onDelete('cascade'); Vai šo vajag?
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('motivation', 1000)->nullable;
            $table->number_format('phone_number', 12);
            $table->string('status', 50)->nullable;
            $table->string('experience', 1000)->nullable;
            $table->string('email');
            $table->timestamps(); // Vai šo vajag?
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audition_submissions');
    }
};
