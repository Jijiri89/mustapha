<?php

namespace App\Filament\Resources\MomoResource\Pages;

use App\Filament\Resources\MomoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMomo extends ViewRecord
{
    protected static string $resource = MomoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
