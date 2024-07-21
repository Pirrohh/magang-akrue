<?php

namespace App\Filament\Resources\MitraResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use App\Imports\MitrasImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Filament\Resources\MitraResource;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ListMitras extends ListRecords
{
    protected static string $resource = MitraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('importMitras')
                ->label('Import Partner Table')
                ->color('danger')
                ->icon('heroicon-o-document-arrow-down')
                ->form([
                    FileUpload::make('attachment'),
                ])
                ->action(function (array $data) {
                    $file = public_path('storage/' . $data['attachment']);

                    Excel::import(new MitrasImport, $file);

                    Notification::make()
                        ->title('Partner Imported')
                        ->success()
                        ->send();
                })
       
        ];
    }
}
