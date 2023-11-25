<?php

namespace App\Filament\Resources\MomoResource\Pages;

use App\Filament\Resources\MomoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMomo extends EditRecord
{
    protected static string $resource = MomoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
