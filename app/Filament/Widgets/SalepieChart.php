<?php

namespace App\Filament\Widgets;

use App\Models\Sale;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class SalepieChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static string $color = 'primary';

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
                'label' => 'Sale Report',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                'backgroundColor' => '	#008000',
                'borderColor' => '	#008000',
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    ];
    }

    protected function getType(): string
    {
        return 'line';
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
}
