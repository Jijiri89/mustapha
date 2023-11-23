<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Item;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use App\Filament\Resources\ItemResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ItemResource\RelationManagers;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Transaction';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->unique(ignoreRecord:true)

                    ->maxLength(255),
                Forms\Components\TextInput::make('unitcp')
                ->label('Unit Cost Price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('unitsp')
                ->label('Unit Selling Price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('Quantity')
                    ->required()
                    ->numeric(),
                    Forms\Components\TextInput::make('stock_balance')
                    ->required()
                   ->numeric(),
                Forms\Components\TextInput::make('remarks')
                    ->required()
                    ->default('Stock')
                    ->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               
                Tables\Columns\TextColumn::make('title')
                ->icon('heroicon-m-shopping-cart')

                    ->searchable(),
                    TextColumn::make('stock_balance')
                    ->numeric()
                    ->label('Stock Level in Quantity')
                     
                     ->sortable(),
                     TextColumn::make('stock_balance_ghs')->money('GHS')
                     ->summarize(Sum::make()->money('GHS'))
                ->numeric()
                ->money('GHS')
                ->sortable()
                     ->label('Stock Balance in GHS'),
                Tables\Columns\TextColumn::make('unitcp')
                
                ->label('Unit Cost Price')
                    ->numeric()
                    ->money('GHS')
                    ->sortable(),
                Tables\Columns\TextColumn::make('unitsp')
                ->label('Unit Selling Price')
                    ->numeric()
                    ->money('GHS')
                    ->sortable(),
               /* Tables\Columns\TextColumn::make('Quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('selling_price')
                    ->numeric()
                    ->money('GHS')
                    ->sortable(),*/
                   // TextColumn::make('sales.quantity')
                   // ->label('Sale Quantity'),
                   // TextColumn::make('sales.selling_price')
                  //  ->summarize(Sum::make()->label("Gross Total Sales")->money('GHS'))
                //    ->numeric()
                  //  ->label('Qauntity Sold in GHS')
                   // ->numeric()
                 //   ->money('GHS')
                  //  ->sortable(),
               // TextColumn::make('sales.profit_or_loss')
                //->summarize(Sum::make()->money('GHS')->label('Total Profit '))
                
               // ->label('Profit or Loss'),
                //TextColumn::make('stock_balance'),

               
                Tables\Columns\TextColumn::make('remarks')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                   // ->toggleable(isToggledHiddenByDefault: 0),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
                   // ->toggleable(isToggledHiddenByDefault: 0),
            ])
            ->filters([
                //
                Filter::make('created_at')
    ->form([
        DatePicker::make('created_from')
        ->label('Kindly Specify start date'),
        DatePicker::make('created_until')
        ->label('Kindly Specify End date'),
    ])
    ->query(function (Builder $query, array $data): Builder {
        return $query
            ->when(
                $data['created_from'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
            )
            ->when(
                $data['created_until'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
            );
    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'view' => Pages\ViewItem::route('/{record}'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }    
}