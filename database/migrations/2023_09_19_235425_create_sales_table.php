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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('buyer_name')->nullable();
            $table->float('quantity');
            $table->float('selling_price')->nullable();
            $table->boolean('is_credit_sale')->default(false);
            $table->decimal('stock_balance_at_sale')->default(0);
            $table->decimal( 'profit_or_loss')->default(0);
           
            $table->string('phone_number')->nullable();
            $table->string('remarks')->default('sale');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};