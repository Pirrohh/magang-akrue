<?php

namespace App\Filament\Resources;

use App\Models\IO;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Exports\IOExporter;
use App\Filament\Imports\IOImporter;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\IOResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\IOResource\RelationManagers;

class IOResource extends Resource
{
    protected static ?string $model = IO::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static ?string $navigationLabel = 'I/O Table';

    protected static ?string $modelLabel = 'Input Output Table';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kode')
                ->relationship(name: 'billings', titleAttribute: 'kode')
                ->searchable()
                ->label('Kode'),
                Select::make('nomor_inet')
                ->relationship(name: 'pelanggans', titleAttribute: 'nomor_inet')
                ->searchable()
                ->label('Nomor Inet'),
                Select::make('billing_inet')
                ->relationship(name: 'billings', titleAttribute: 'billing_inet')
                ->searchable()
                ->label('Billing Inet'),
                Select::make('nomor_pots')
                ->relationship(name: 'billings', titleAttribute: 'nomor_pots')
                ->searchable()
                ->label('Nomor POTS'),
                Select::make('billing_pots')
                ->relationship(name: 'billings', titleAttribute: 'billing_pots')
                ->searchable()
                ->label('Billing POTS'),
                Select::make('periode_billing')
                ->relationship(name: 'mitras', titleAttribute: 'periode_billing')
                ->searchable()
                ->label('Periode Billing'),
                Select::make('total_billing')
                ->relationship(name: 'billings', titleAttribute: 'total_billing')
                ->searchable()
                ->label('Total Billing'),
                Forms\Components\TextInput::make('revenue_share_inet'),
                Forms\Components\TextInput::make('revenue_share_pots'),
                Forms\Components\TextInput::make('total_billing_sharing'),
                Forms\Components\TextInput::make('total_nilai_sharing')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->groups([
            Tables\Grouping\Group::make('periode_billing')
            ->date(),
            Tables\Grouping\Group::make('tanggal_bayar')
            ->date(),
        ])

        ->headerActions([
            ExportAction::make()
                ->exporter(IOExporter::class)
                ->fileDisk('downloads'),

                ImportAction::make()
                ->importer(IOImporter::class)
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
                Tables\Columns\TextColumn::make('nomor_inet')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('billing_inet')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nomor_pots')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('billing_pots')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('periode_billing')->searchable()->sortable()->date('Y/m'),
                TextColumn::make('pelanggans.nama_mitra'),
                TextColumn::make('mitras.sharing(%)')->suffix('%'),
                Tables\Columns\TextColumn::make('total_billing')->searchable()->sortable(),
                Tables\Columns\TextInputColumn::make('revenue_share_inet')->searchable()->sortable(),
                Tables\Columns\TextInputColumn::make('revenue_share_pots')->searchable()->sortable(),
                Tables\Columns\TextInputColumn::make('total_billing_sharing')->searchable()->sortable(),
                Tables\Columns\TextInputColumn::make('total_nilai_sharing')->searchable()->sortable()
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
                ->excludeAttributes(['periode_billing','sharing'])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIOS::route('/'),
            'create' => Pages\CreateIO::route('/create'),
            'edit' => Pages\EditIO::route('/{record}/edit'),
        ];
    }
}
