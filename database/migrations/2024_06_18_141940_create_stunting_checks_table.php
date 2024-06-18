<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStuntingChecksTable extends Migration
{
    public function up()
    {
        Schema::create('stunting_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->float('height');
            $table->float('weight');
            $table->boolean('is_poor_family');
            $table->string('stunting_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stunting_checks');
    }
};
