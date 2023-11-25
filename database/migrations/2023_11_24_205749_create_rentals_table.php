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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            // Foreign keys
            //$table->foreignId('item_id')->constrained('items')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
           // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('item');
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->decimal('amount');
            $table->decimal('total_cost_rent')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->float('no_of_day');
            $table->string('remark')->nullable();
            $table->timestamps();


        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
