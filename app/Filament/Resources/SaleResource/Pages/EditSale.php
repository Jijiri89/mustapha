<?php

namespace App\Filament\Resources\SaleResource\Pages;

use Filament\Actions;
use Emanate\BeemSms\Facades\BeemSms;
use App\Filament\Resources\SaleResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditSale extends EditRecord
{
    protected static string $resource = SaleResource::class;

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
            ->title('Sales')
            ->body('Edited successfully.');
    }
   
}
