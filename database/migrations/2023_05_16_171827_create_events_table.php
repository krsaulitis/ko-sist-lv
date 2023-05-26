<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('description', 2000)->nullable;
            $table->dateTime('datetime_from');
            $table->dateTime('datetime_to');
            $table->timestamps();
        });

        Schema::create('events_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('resource_id');

            $table->foreign('event_id')->references('id')->on('events')->cascadeOnDelete();
            $table->foreign('resource_id')->references('id')->on('resources')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events_resources');
        Schema::dropIfExists('events');
    }
};
