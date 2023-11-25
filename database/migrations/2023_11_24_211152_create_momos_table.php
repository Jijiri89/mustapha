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
        Schema::create('momos', function (Blueprint $table) {
            $table->id();
            $table->decimal('local_offering', 10, 2)->nullable();
           // $table->decimal('tithe', 10, 2)->nullable();
            $table->string('item')->nullable();
            $table->string('remark')->nullable();
            //$table->decimal('designated_offering', 10, 2)->nullable();
            $table->decimal('accumulated_local_offering', 10, 2)->default(0);
           // $table->decimal('mission_offering', 10, 2)->nullable();
            $table->decimal('expenditure', 10, 2)->nullable();
            $table->decimal('balance', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('momos');
    }
};
