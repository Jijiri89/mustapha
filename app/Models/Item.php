<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Depositor;
use App\Models\CreditSale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'unitcp',
        'unitsp',
        'Quantity',
        'stock_balance_ghs',
       'unitsp_updated',
        'stock_balance',
        'remarks',
    ];
    public function sales():HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function creditsales():HasMany
    {
        return $this->hasMany(CreditSale::class);
    }

    public function depositors():HasMany
    {
        return $this->hasMany(Depositor::class);
    }

   // public function recalculateStockBalance()
//{
    //$this->stock_balance = $this->sales->sum('quantity');
    //$this->save();
//}

public function recalculateStockBalance()
{
    $this->stock_balance = $this->sales->sum('quantity') - $this->creditsales->sum('quantity');
    $this->save();
}



}