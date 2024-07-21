<?php

namespace App\Filament\Resources\IOResource\Pages;

use App\Filament\Resources\IOResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIO extends EditRecord
{
    protected static string $resource = IOResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
