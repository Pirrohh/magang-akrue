<?php

namespace App\Filament\Resources\BillingResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use App\Imports\BillingsImport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BillingResource;

class ListBillings extends ListRecords
{
    protected static string $resource = BillingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('importMitras')
                ->label('Import Billing Table')
                ->color('danger')
                ->icon('heroicon-o-document-arrow-down')
                ->form([
                    FileUpload::make('attachment'),
                ])
                ->action(function (array $data) {
                    $file = public_path('storage/' . $data['attachment']);

                    Excel::import(new BillingsImport, $file);

                    Notification::make()
                        ->title('Mitra Imported')
                        ->success()
                        ->send();
                })
        ];
    }
}
