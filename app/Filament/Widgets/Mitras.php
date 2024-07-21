<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Mitra;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Filament\Widgets\TableWidget as BaseWidget;

class Mitras extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                // Menggunakan model Mitra untuk mengambil data
                return Mitra::query()->distinct()->orderBy('nama_mitra');
            })
            ->columns([
                // Definisikan kolom-kolom yang ingin ditampilkan
                Columns\TextColumn::make('nama_mitra')->sortable(),
                // Tambahkan kolom-kolom lain jika diperlukan
            ]);
    }
}
