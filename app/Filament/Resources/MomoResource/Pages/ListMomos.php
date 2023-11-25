<?php

namespace App\Filament\Resources\MomoResource\Pages;

use App\Filament\Resources\MomoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMomos extends ListRecords
{
    protected static string $resource = MomoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
