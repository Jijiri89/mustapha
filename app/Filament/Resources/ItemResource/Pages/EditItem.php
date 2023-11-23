<?php

namespace App\Filament\Resources\ItemResource\Pages;

use Filament\Actions;
use App\Filament\Resources\ItemResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditItem extends EditRecord
{
    protected static string $resource = ItemResource::class;

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
    
    
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Item')
            ->body('Edited successfully.');
    }
}
