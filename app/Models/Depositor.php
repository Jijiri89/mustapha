<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depositor extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'paid',
        'balance',
        'remarks',
        'buyer_name',
        'quantity',
        'selling_price',
        'stock_balance_at_sale',
        'phone_number',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($depositor) {
            // Retrieve the associated item
            $item = $depositor->item;

            if ($item) {
                // Calculate the selling_price as unitsp * quantity
                $depositor->selling_price = $item->unitsp * $depositor->quantity;

                // Check if the depositor is credited
                if ($depositor->remarks === 'Credit') {
                    // Iterate through associated Sale records and update selling_price
                    $item->sales->each(function ($sale) use ($depositor) {
                        $newSellingPrice = $sale->selling_price + $depositor->selling_price;
                        $sale->update(['selling_price' => $newSellingPrice]);
                    });
                }

                // Calculate balance as selling_price - paid
                $depositor->balance = $depositor->selling_price - $depositor->paid;
            }
        });

        static::updating(function ($depositor) {
            // Retrieve the associated item
            $item = $depositor->item;

            if ($item) {
                // Recalculate selling_price if quantity is updated
                $depositor->selling_price = $item->unitsp * $depositor->quantity;

                // Recalculate balance as selling_price - paid
                $depositor->balance = $depositor->selling_price - $depositor->paid;
            }
        });
    }
}
