<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stunting_checks', function (Blueprint $table) {
            $table->string('stunting_status')->default('Normal')->change();
        });
    }

    public function down(): void
    {
        Schema::table('stunting_checks', function (Blueprint $table) {
            $table->string('stunting_status')->change();
        });
    }
};

