<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Pelanggan;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class BlendData extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
        ->query(function () {
            // Menggabungkan data dari kedua tabel
            return Pelanggan::with('billing')->orderBy('nama_mitra');
        })
        ->columns([
            // Definisikan kolom untuk data Mitra
            Columns\TextColumn::make('nama_mitra')->label('Nama Mitra')->sortable(),
            // Kolom-kolom untuk data Proyek yang terkait
            TextColumn::make('billings.periode'),
            TextColumn::make('billings.total_billing')
        ]);
    }
}
