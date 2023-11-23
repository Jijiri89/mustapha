<?php

namespace App\Filament\Widgets;

use App\Models\Sale;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class SaleChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $data = Trend::model(Sale::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();
 
    return [
        'datasets' => [
            [
                'label' => 'Monthly Sale Chart',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                'backgroundColor' => '	#008000',
                'borderColor' => '#9BD0F5',
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
{
    return [
        'today' => 'Today',
        'week' => 'Last week',
        'month' => 'Last month',
        'year' => 'This year',
    ];
}
public ?string $filter = 'today';

}
