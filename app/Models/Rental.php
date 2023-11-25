<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Rental extends Model
{
    protected $fillable = [
        'item_id', 'name', 'amount', 'start_date','item', 'end_date', 'no_of_day', 'total_cost_rent','phone_number','remark'
    ];

    // Relationships
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    protected static function booted()
    {
        static::saving(function ($rental) {
            $rental->no_of_day = $rental->calculateNoOfDay();
            $rental->total_cost_rent = $rental->calculateTotalCostRent();
        });
    }

    // Custom methods for business logic
    public function calculateNoOfDay()
    {
        $start = \Carbon\Carbon::parse($this->start_date);
        $end = \Carbon\Carbon::parse($this->end_date);

        // Calculate the number of days
        return $start->diffInDays($end);
    }

    public function calculateTotalCostRent()
    {
        // Calculate the total cost by multiplying the amount by the number of days
        return $this->amount * $this->no_of_day;
    }
}
