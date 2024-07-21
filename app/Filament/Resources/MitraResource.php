<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Mitra;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Exports\MitrasExport;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Tables\Actions\ReplicateAction;
use Maatwebsite\Excel\Facades\Excel;
use App\Filament\Imports\MitraImporter;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Exports\MitrasExporter;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\MitraResource\Pages;
use Filament\Actions\Exports\Enums\ExportFormat;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\MitraResource\RelationManagers;

class MitraResource extends Resource
{
    protected static ?string $model = Mitra::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Partner';

    protected static ?string $modelLabel = 'Partner';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode'),
                Forms\Components\TextInput::make('nama_mitra'),
                Forms\Components\TextInput::make('nama_lop'),
                Forms\Components\TextInput::make('periode_billing'),
                Forms\Components\TextInput::make('bulan_awal_sharing'),
                Forms\Components\TextInput::make('bulan_akhir_sharing'),
                Forms\Components\TextInput::make('sharing'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->headerActions([
            ExportAction::make()
                ->exporter(MitrasExporter::class)
                ->fileDisk('downloads'),

                ImportAction::make()
                ->importer(MitraImporter::class)
                ->after(function () {
                    // Kirim notifikasi setelah impor berhasil
                    Notification::make()
                        ->title('Import Successful')
                        ->success()
                        ->body('The data has been imported successfully.')
                        ->send();
                        
                }),
                

                // Action::make('undo')
                // ->label('Undo')
                // ->color('gray'),
                
        ])

            ->columns([
                Tables\Columns\TextColumn::make('kode')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama_mitra')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama_lop')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('periode_billing')->searchable()->sortable(),
                Tables\Columns\TextInputColumn::make('bulan_awal_sharing')->searchable()->sortable(),
                Tables\Columns\TextInputColumn::make('bulan_akhir_sharing')->searchable()->sortable(),
                Tables\Columns\TextInputColumn::make('sharing(%)')->searchable()->sortable()->label('Sharing'),
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
                
                // ->mutateRecordDataUsing(function (array $data): array {
                //     $data['id_mitra'] = auth()->id();
             
                //     return $data;
                // })
            
            ,
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('export')
                        ->label('Export to Excel')
                        ->icon('heroicon-o-document-arrow-down')
                        ->action(function (Collection $records) {
                            return Excel::download(new MitrasExport($records), 'mitra.xlsx');
                        }),
                ]),
            ]);
    }

 
    public function getFileDisk(): string
    {
        return 'downloads';
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
            'index' => Pages\ListMitras::route('/'),
            'create' => Pages\CreateMitra::route('/create'),
            'edit' => Pages\EditMitra::route('/{record}/edit'),
        ];
    }
}
