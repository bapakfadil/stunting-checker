<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stunting_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->float('height');
            $table->float('weight');
            $table->boolean('is_poor_family');
            $table->string('stunting_status')->default('Normal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stunting_checks');
    }
};
