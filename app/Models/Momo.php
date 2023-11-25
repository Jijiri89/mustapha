<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Momo extends Model
{
    use HasFactory;

    protected $fillable = ['local_offering','accumulated_local_offering', 'expenditure', 'balance','remark','item','date'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($finance) {
            $previousAccumulatedLocalOffering = self::sum('local_offering');
            $previousExpenditure = self::sum('expenditure');

            if ($finance->local_offering) {
                $finance->accumulated_local_offering = $previousAccumulatedLocalOffering + $finance->local_offering;
                $finance->balance= $finance->local_offering +  $finance->balance;
            } else {
                $finance->accumulated_local_offering = $previousAccumulatedLocalOffering;
            }

            $finance->balance = $finance->accumulated_local_offering - $previousExpenditure;

            if ($finance->expenditure) {
                $finance->balance -= $finance->expenditure;
            }
        });
//edit method added by Jijiri
        static::updating(function ($finance) {
            $previousAccumulatedLocalOffering = self::sum('local_offering');
            $previousExpenditure = self::sum('expenditure');

            $updatedLocalOffering = $previousAccumulatedLocalOffering - $finance->getOriginal('local_offering') + $finance->local_offering;
            $updatedExpenditure = $previousExpenditure - $finance->getOriginal('expenditure') + $finance->expenditure;

            $finance->balance = $updatedLocalOffering - $updatedExpenditure;
        });
    }
}





