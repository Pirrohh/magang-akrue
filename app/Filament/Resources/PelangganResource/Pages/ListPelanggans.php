<?php

namespace App\Filament\Resources\PelangganResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use App\Imports\PelanggansImport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PelangganResource;

class ListPelanggans extends ListRecords
{
    protected static string $resource = PelangganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('importMitras')
            ->label('Import Mitra Table')
            ->color('danger')
            ->icon('heroicon-o-document-arrow-down')
            ->form([
                FileUpload::make('attachment'),
            ])
            ->action(function(array $data){
                $file = public_path('storage/' . $data['attachment']);

                Excel::import(new PelanggansImport, $file);

                Notification::make()
                ->title('Mitra Imported')
                ->success()
                ->send();
            })
        ];
    }
}
