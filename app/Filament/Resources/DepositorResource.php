<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepositorResource\Pages;
use App\Filament\Resources\DepositorResource\RelationManagers;
use App\Models\Depositor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepositorResource extends Resource
{
    protected static ?string $model = Depositor::class;

    protected static ?string $pluralModelLabel = 'Suppliers';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Transaction';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->relationship('item', 'title')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Staff in charge')
                    ->required(),
                Forms\Components\TextInput::make('buyer_name')
                    ->label('Supplier name'),
                Forms\Components\Select::make('item_id')
                    ->relationship('item', 'unitcp')
                    ->label('Unit cost Price')
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('paid')
                    ->default(0)
                    ->label('Amount to pay in GHS')
                    ->numeric(),

               // Forms\Components\TextInput::make('stock_balance_at_sale')
                   // ->required()
                    //->numeric()
                   // ->default(0.00),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->label('Supply tel')
                    ->maxLength(255),
                Forms\Components\TextInput::make('remarks')
                    ->required()
                    ->maxLength(255)
                    ->default('Deposit'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label('Staff in charge')
                    ->sortable(),
                Tables\Columns\TextColumn::make('buyer_name')
                    ->label('Supplier name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('selling_price')
                    ->label(' Amount')
                    ->numeric()
                    ->money('GHS')
                    ->sortable()
            ->summarize(Sum::make()->label('Total Amount supplied')->money('GHS'))
            ->numeric()
            ->money('GHS'),
                Tables\Columns\TextColumn::make('paid')
                    ->label(' Amount paid to supplier')
                    ->numeric()
                    ->money('GHS')
                    ->sortable()
                    ->summarize(Sum::make()->label('Total paid')->money('GHS'))
                    ->numeric()
                    ->money('GHS'),
                Tables\Columns\TextColumn::make('balance')
                    ->label(' Balance left to pay')
                    ->numeric()
                    ->money('GHS')
                    ->sortable()
                    ->summarize(Sum::make()->label('Total balance left to pay')->money('GHS'))
                    ->numeric()
                    ->money('GHS'),
               // Tables\Columns\TextColumn::make('stock_balance_at_sale')
                   // ->numeric()
                   // ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('remarks')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('deposited on')
                    ->toggleable(isToggledHiddenByDefault: 0),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Paid on')
                    ->toggleable(isToggledHiddenByDefault: 0),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDepositors::route('/'),
            'create' => Pages\CreateDepositor::route('/create'),
            'view' => Pages\ViewDepositor::route('/{record}'),
            'edit' => Pages\EditDepositor::route('/{record}/edit'),
        ];
    }
}
