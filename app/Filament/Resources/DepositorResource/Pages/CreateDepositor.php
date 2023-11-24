<?php

namespace App\Filament\Resources\DepositorResource\Pages;

use App\Filament\Resources\DepositorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDepositor extends CreateRecord
{
    protected static string $resource = DepositorResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
