<?php

namespace App\Filament\Imports;

use App\Models\Mitra;
use App\Imports\MitrasImport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;

class MitraImporter extends Importer
{
    protected static ?string $model = Mitra::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('kode'),
            ImportColumn::make('nama_mitra'),
            ImportColumn::make('nama_lop'),
            ImportColumn::make('periode_billing'),
            ImportColumn::make('bulan_awal_sharing'),
            ImportColumn::make('bulan_akhir_sharing'),
            ImportColumn::make('sharing(%)'),
        ];
    }

    public function resolveRecord(): ?Mitra
    {
        // return Mitra::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Mitra();
    }



    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your mitra import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
