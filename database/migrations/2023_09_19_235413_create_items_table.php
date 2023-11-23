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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->float('unitcp');
            $table->float('unitsp');
            $table->integer('Quantity');
          
            $table ->float('selling_price')->virtualAs('quantity* unitsp')->nullable();
            $table->decimal('stock_balance')->default(0); // Add the stock_balance column with a default value of 0
            $table ->float('stock_balance_ghs')->virtualAs('stock_balance * unitsp')->nullable();
            $table->string('remarks')->default('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};