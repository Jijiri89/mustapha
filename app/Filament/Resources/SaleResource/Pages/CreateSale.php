<?php

namespace App\Filament\Resources\SaleResource\Pages;

use Filament\Actions;
use Emanate\BeemSms\Facades\BeemSms;
use App\Filament\Resources\SaleResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sales')
            ->body('Sold successfully.');
    }


   /* protected function afterCreate(): void
    {

        if ($this->record->phone_number) {


            BeemSms::content('Dear Cherished  ' . $this->record->buyer_name . ". Thank you for choosing to shop with us. Do not miss out! Feel free to join our WhatsApp group by clicking on this link: https://chat.whatsapp.com/BDSyPSS6j6zLEt4gFEHBM2. We are looking forward to seeing you again. For any enquiry Kindly contact us on 0247266961. By Rising Star 3 Enterprise")->unpackRecipients($this->record->phone_number)->send();
        }
    }*/
}
