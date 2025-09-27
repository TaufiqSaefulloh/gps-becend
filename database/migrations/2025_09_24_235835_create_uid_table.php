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
        Schema::create('uid', function (Blueprint $table) {
            $table->id();
            $table->string('nama_uid');
            $table->unsignedBigInteger('id_cluster');
            $table->foreign('id_cluster')->references('id')->on('cluster')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uid');
    }
};
