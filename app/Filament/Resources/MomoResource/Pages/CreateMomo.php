<?php

namespace App\Filament\Resources\MomoResource\Pages;

use App\Filament\Resources\MomoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMomo extends CreateRecord
{
    protected static string $resource = MomoResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
