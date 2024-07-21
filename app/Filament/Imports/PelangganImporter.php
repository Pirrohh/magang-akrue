<?php

namespace App\Filament\Imports;

use App\Models\Pelanggan;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class PelangganImporter extends Importer
{
    protected static ?string $model = Pelanggan::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('kode')
                ->rules(['max:255']),
            ImportColumn::make('nama_mitra')
                ->rules(['max:255']),
            ImportColumn::make('nama_lop')
                ->rules(['max:255']),
            ImportColumn::make('nomor_inet')
                ->rules(['max:255']),
            ImportColumn::make('nomor_pots')
                ->rules(['max:255']),
            ImportColumn::make('nama_pelanggan')
                ->rules(['max:255']),
            ImportColumn::make('tanggal_aktivasi')
                ->rules(['max:255']),
        ];
    }

    public function resolveRecord(): ?Pelanggan
    {
        // return Pelanggan::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Pelanggan();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your pelanggan import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
