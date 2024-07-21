<?php

namespace App\Filament\Resources\IOResource\Pages;

use Filament\Actions;
use App\Imports\IOsImport;
use Filament\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Filament\Resources\IOResource;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;

class ListIOS extends ListRecords
{
    protected static string $resource = IOResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('importMitras')
                ->label('Import IO Table')
                ->color('danger')
                ->icon('heroicon-o-document-arrow-down')
                ->form([
                    FileUpload::make('attachment'),
                ])
                ->action(function (array $data) {
                    $file = public_path('storage/' . $data['attachment']);

                    Excel::import(new IOsImport, $file);

                    Notification::make()
                        ->title('IO Imported')
                        ->success()
                        ->send();
                })
       
        ];
    }
}
