<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pelanggan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Exports\PelanggansExport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\PelangganExporter;
use App\Filament\Imports\PelangganImporter;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\PelangganResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PelangganResource\RelationManagers;
use App\Filament\Resources\PelangganResource\RelationManagers\MitrasRelationManager;

class PelangganResource extends Resource
{
    protected static ?string $model = Pelanggan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Customer';

    protected static ?string $modelLabel = 'customer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode'),
                Select::make('nama_mitra')
                ->relationship(name: 'mitras', titleAttribute: 'nama_mitra')
                ->searchable()
                ->label('Nama Mitra'),
                Select::make('nama_lop')
                ->relationship(name: 'mitras', titleAttribute: 'nama_lop')
                ->searchable()
                ->label('Nomor LOP'),
                Forms\Components\TextInput::make('nomor_inet'),
                Forms\Components\TextInput::make('nomor_pots'),
                Forms\Components\TextInput::make('nama_pelanggan'),
                Forms\Components\TextInput::make('tanggal_aktivasi'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->headerActions([
            ExportAction::make()
                ->exporter(PelangganExporter::class)
                ->fileDisk('downloads'),

                ImportAction::make()
                ->importer(PelangganImporter::class)
                ->after(function () {
                    // Kirim notifikasi setelah impor berhasil
                    Notification::make()
                        ->title('Import Successful')
                        ->success()
                        ->body('The data has been imported successfully.')
                        ->send();
                        
                }),

        ])
            ->columns([
                Tables\Columns\TextColumn::make('kode')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama_mitra')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama_lop')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nomor_inet')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nomor_pots')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama_pelanggan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tanggal_aktivasi')->searchable()->sortable(),
                TextColumn::make('mitras.sharing(%)')->suffix('%')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->icon('heroicon-m-pencil-square')
                ->iconButton(),
                Tables\Actions\DeleteAction::make()
                ->icon('heroicon-m-trash')
                ->iconButton(),
                Tables\Actions\ReplicateAction::make()
                ->icon('heroicon-m-plus-circle')
                ->iconButton()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                BulkAction::make('export')
                    ->label('Export to Excel')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function(Collection $records){
                        return Excel::download(new PelanggansExport($records), 'mitra.xlsx');
                    })
                    
                    ,
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelanggans::route('/'),
            'create' => Pages\CreatePelanggan::route('/create'),
            'edit' => Pages\EditPelanggan::route('/{record}/edit'),
        ];
    }
}
