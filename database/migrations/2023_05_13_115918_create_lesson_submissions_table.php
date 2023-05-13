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
        Schema::create('lesson_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users')->nullable; //->onDelete('cascade'); Vai šo vajag?
            $table->foreign('lecturer_id')->references('id')->on('users'); // Pārbaudīt vai lecturer, vai jābūt savādāk
            $table->string('status', 50);
            $table->time('recommended_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_submissions');
    }
};
