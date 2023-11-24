<?php

namespace App\Filament\Resources\DepositorResource\Pages;

use App\Filament\Resources\DepositorResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDepositor extends ViewRecord
{
    protected static string $resource = DepositorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
