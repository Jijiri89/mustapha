<?php

namespace App\Filament\Resources\DepositorResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\DepositorResource;

class CreateDepositor extends CreateRecord
{
    protected static string $resource = DepositorResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Deposit')
            ->body('Deposited successfully.');
    }
}
