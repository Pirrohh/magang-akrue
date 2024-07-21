<?php

namespace App\Filament\Exports;

use App\Models\IO;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class IOExporter extends Exporter
{
    protected static ?string $model = IO::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('kode'),
            ExportColumn::make('nomor_inet'),
            ExportColumn::make('billing_inet'),
            ExportColumn::make('nomor_pots'),
            ExportColumn::make('billing_pots'),
            ExportColumn::make('periode_billing'),
            ExportColumn::make('total_billing'),
            ExportColumn::make('revenue_share_inet'),
            ExportColumn::make('revenue_share_pots'),
            ExportColumn::make('total_billing_sharing'),
            ExportColumn::make('total_nilai_sharing'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your i o export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
