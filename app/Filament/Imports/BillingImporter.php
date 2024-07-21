<?php

namespace App\Filament\Imports;

use App\Models\Billing;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class BillingImporter extends Importer
{
    protected static ?string $model = Billing::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nomor_inet')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('kode')
                ->rules(['max:255']),
            ImportColumn::make('billing_inet')
                ->rules(['max:255']),
            ImportColumn::make('nomor_pots')
                ->rules(['max:255']),
            ImportColumn::make('periode_billing')
                ->rules(['max:255']),
            ImportColumn::make('total_billing')
                ->rules(['max:255']),
            ImportColumn::make('tanggal_bayar')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Billing
    {
        // return Billing::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Billing();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your billing import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
