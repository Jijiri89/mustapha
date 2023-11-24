<?php

namespace App\Filament\Resources\DepositorResource\Pages;

use App\Filament\Resources\DepositorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDepositor extends EditRecord
{
    protected static string $resource = DepositorResource::class;

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
