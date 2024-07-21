<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Billing;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Exports\BillingsExport;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use App\Filament\Exports\BillingExporter;
use App\Filament\Imports\BillingImporter;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\BillingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BillingResource\RelationManagers;

class BillingResource extends Resource
{
    protected static ?string $model = Billing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationLabel = 'Billing';

    protected static ?string $modelLabel = 'Billing';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\TextInput::make('kode'),
            Select::make('nomor_inet')
                ->relationship(name: 'pelanggans', titleAttribute: 'nomor_inet')
                ->searchable()
                ->label('Nomor LOP'),
            Forms\Components\TextInput::make('billing_inet'),
            Select::make('nomor_pots')
                ->relationship(name: 'pelanggans', titleAttribute: 'nomor_pots')
                ->searchable()
                ->label('Nomor POTS'),
            Forms\Components\TextInput::make('periode_billing'),
            Forms\Components\TextInput::make('total_billing'),
            Forms\Components\TextInput::make('tanggal_bayar'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->groups([
            Tables\Grouping\Group::make('periode_billing'),
            Tables\Grouping\Group::make('tanggal_bayar')
            ->date(),
        ])
        ->headerActions([
            ExportAction::make()
            ->exporter(BillingExporter::class)
            ->fileDisk('downloads'),

                ImportAction::make()
                ->importer(BillingImporter::class),
      
        ])

            ->columns([
            Tables\Columns\TextColumn::make('kode')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('nomor_inet')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('billing_inet')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('nomor_pots')->searchable()->sortable(),
            TextColumn::make('mitras.sharing(%)')->suffix('%'),
            Tables\Columns\TextColumn::make('periode_billing')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('total_billing')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('tanggal_bayar')->searchable()->sortable()->date('d/m/Y'),
            ])
            ->filters([
                Filter::make('kode')
                ->modifyFormFieldUsing(fn (Checkbox $field) => $field->inline(false))
                
                
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
                    BulkAction::make('export')
                    ->label('Export to Excel')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function(Collection $records){
                        return Excel::download(new BillingsExport($records), 'mitra.xlsx');
                    })
                    
                    ,
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
            'index' => Pages\ListBillings::route('/'),
            'create' => Pages\CreateBilling::route('/create'),
            'edit' => Pages\EditBilling::route('/{record}/edit'),
        ];
    }
}
