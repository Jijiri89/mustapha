<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MomoResource\Pages;
use App\Filament\Resources\MomoResource\RelationManagers;
use App\Models\Momo;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MomoResource extends Resource
{
    protected static ?string $model = Momo::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Transaction';
    protected static ?string $pluralModelLabel = 'MOMO Transaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('local_offering')
                    ->label('Cash In')
                    ->numeric(),

                //Forms\Components\TextInput::make('accumulated_local_offering')
                   // ->required()
                   // ->numeric()
                   // ->default(0.00),
                Forms\Components\TextInput::make('expenditure')
                    ->label('Cash Out')
                    ->numeric(),
               // Forms\Components\TextInput::make('balance')
                 //   ->numeric(),
                Forms\Components\TextInput::make('item')
                    ->label('Phone Number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('remark')
                    ->label('Name of Sender/Receipient')
                    ->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('D-d-M-Y H:i:s A')
                    ->sortable()
                    ->label('Date')
                    ->toggleable(isToggledHiddenByDefault: 0),
                Tables\Columns\TextColumn::make('local_offering')
                    ->numeric()
                    ->label('Cash In')
                    ->summarize(Sum::make()->label('Total Cash In')->money('GHS'))
                    ->numeric()
                    ->money('GHS')
                    ->sortable(),


                Tables\Columns\TextColumn::make('expenditure')
                    ->numeric()
                    ->label('Cash Out')
                    ->summarize(Sum::make()->label('Total Cash Out')->money('GHS'))
                    ->numeric()
                    ->money('GHS')
                    ->sortable(),
                    //->label('Cash In'),

              /*  Tables\Columns\TextColumn::make('accumulated_local_offering')
                    ->numeric()
                    ->sortable(),*/


                Tables\Columns\TextColumn::make('balance')
                    ->numeric()
                    ->money('GHS')
                    ->sortable(),
                Tables\Columns\TextColumn::make('item')
                    ->label('Phone Number')
                    ->searchable(),

                Tables\Columns\TextColumn::make('remark')
                    ->label('Name of Sender/Receipient')
                    ->searchable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('D-d-M-Y H:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListMomos::route('/'),
            'create' => Pages\CreateMomo::route('/create'),
            'view' => Pages\ViewMomo::route('/{record}'),
            'edit' => Pages\EditMomo::route('/{record}/edit'),
        ];
    }
}
