<?php
namespace App\Models;

use App\Models\Item;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditSale extends Model
{
    protected $fillable = [
        'item_id',
        'user_id',
        'buyer_name',
        'quantity',

        'selling_price',
        'phone_number',
        // Add any other attributes specific to credit sales
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    
}    