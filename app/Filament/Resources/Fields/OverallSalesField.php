<?php

namespace App\Filament\Resources\Fields;

use Filament\Forms\Components\Field;

class OverallSalesField extends Field
{
    public $component = 'text';

    public function getFormattedValue($value)
    {
        // Access the related models from the value array
        $depositors = $value['depositors'];
        $sales = $value['sales'];

        // Calculate the overall sales based on the related models
        $overallSales = collect($depositors)->sum('selling_price') + collect($sales)->sum('selling_price');

        return $overallSales;
    }
}
