<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('itineraire_id');
            $table->enum('type', ['start', 'final']);
            $table->string('name');
            $table->string('lodging')->nullable();
            $table->text('activities')->nullable();
            $table->timestamps();

            $table->foreign('itineraire_id')->references('id')->on('itineraires')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinations');
    }
};
