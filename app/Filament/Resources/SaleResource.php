<?php

namespace App\Filament\Resources;

use auth;
use Filament\Forms;
use App\Models\Sale;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use App\Filament\Resources\SaleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SaleResource\RelationManagers;

class SaleResource extends Resource
{

    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Transaction';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('item_id')
                    ->relationship('item', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Staff in charge of this sale')
                   // ->money('GHS')
                    ->required(),
                Forms\Components\TextInput::make('buyer_name'),
                Forms\Components\Select::make('item_id')
                   ->relationship('item', 'unitsp')
                   ->label('Unit selling Price')
                   ->required(),
                  // ->selectablePlaceholder(false),
                   //->native(false),

                    //->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                    Toggle::make('is_credit_sale')
                    ->label('Click if this is a credit sale'),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->placeholder('make sure the number is in international format eg. +233554463045')
                    ->minLength(12)
                    ->maxLength(13),
                    Forms\Components\TextInput::make('remarks')
                    ->default('Thank You'),


            ])->columns(1);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item.title')
                ->icon('heroicon-m-shopping-cart')

                    ->numeric()
                    ->sortable(),
                   // Tables\Columns\TextColumn::make('item.stock_balance')
                  // TextColumn::make('item.stock_balance')
                    // ->numeric()
                     //->label('Current Stock Balance'),

                   TextColumn::make('stock_balance_at_sale')
                   ->numeric()
                   ->label('Stock Balance'),
                   /*  Tables\Columns\TextColumn::make('item.unitsp')
                     ->numeric()
                     ->money('GHS')
                     ->label('Unit Selling price')
                     ->sortable(),*/

                Tables\Columns\TextColumn::make('quantity')

                    ->numeric()
                    ->label('Quantity sold out')
                    ->sortable(),

                Tables\Columns\TextColumn::make('selling_price')


             ->icon('heroicon-m-calculator')

                ->summarize(Sum::make()->money('GHS'))
                ->numeric()
                ->money('GHS')
                ->sortable(),

                BooleanColumn::make('is_credit_sale')->sortable(),

                TextColumn::make('profit_or_loss')
                ->visible(in_array(auth()->user()->email, ['super@rjazakhallahventures.com', 'developer@jazakhallahventures.com', 'more@example.com']))
                ->money('GHS')
                ->summarize(Sum::make()->money('GHS')->label('Total Profit '))


                ->label('Profit or Loss'),


                Tables\Columns\TextColumn::make('user.name')
                ->icon('heroicon-m-user')

                ->numeric()
                ->label('Staff in charge')
                ->sortable(),
            Tables\Columns\TextColumn::make('buyer_name')
                ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                ->icon('heroicon-m-phone')


                    ->searchable(),
                     TextColumn::make('remarks')
                     ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                //->format('d/m/Y')

                     ->label('Date of Sale')
                     ->icon('heroicon-m-calendar')


                    ->dateTime('D-d-M-Y H:i:s A')
                    ->sortable(),
                   // ->toggleable(isToggledHiddenByDefault: 0),

                Tables\Columns\TextColumn::make('updated_at')
                ->label('Edited date')
                     ->dateTime('D-d-M-Y H:i:s A')
                    ->sortable(),
                   // ->toggleable(isToggledHiddenByDefault: 0),
            ])
            ->filters([
                //

                Filter::make('created_at')
    ->form([
        DatePicker::make('created_from')
        ->label('Kindly Specify starting date that you want to filter from'),
        DatePicker::make('created_until')
        ->label('Kindly Specify Ending date that you want to filter to'),
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'view' => Pages\ViewSale::route('/{record}'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
