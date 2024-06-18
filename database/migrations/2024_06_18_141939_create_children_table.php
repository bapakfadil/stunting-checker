<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrenTable extends Migration
{
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('father_name');
            $table->string('mother_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('children');
    }
};
