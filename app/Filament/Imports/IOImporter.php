<?php

namespace App\Filament\Imports;

use App\Models\IO;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class IOImporter extends Importer
{
    protected static ?string $model = IO::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('kode')
                ->rules(['max:255']),
            ImportColumn::make('nomor_inet')
                ->rules(['max:255']),
            ImportColumn::make('billing_inet')
                ->rules(['max:255']),
            ImportColumn::make('nomor_pots')
                ->rules(['max:255']),
            ImportColumn::make('billing_pots')
                ->rules(['max:255']),
            ImportColumn::make('periode_billing')
                ->rules(['max:255']),
            ImportColumn::make('total_billing')
                ->rules(['max:255']),
            ImportColumn::make('revenue_share_inet')
                ->rules(['max:255']),
            ImportColumn::make('revenue_share_pots')
                ->rules(['max:255']),
            ImportColumn::make('total_billing_sharing')
                ->rules(['max:255']),
            ImportColumn::make('total_nilai_sharing')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?IO
    {
        // return IO::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new IO();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your i o import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
