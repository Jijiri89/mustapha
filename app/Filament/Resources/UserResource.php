<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use Filament\Pages\Page;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\BooleanColumn;
//use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\RolesRelationManager;
use Doctrine\DBAL\Types\BooleanType;
use Filament\Forms\Components\CheckboxList;
use Filament\Tables\Columns\IconColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $pluralModelLabel = 'Staff';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Administration';


   // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                     Toggle::make('is_admin'),
              //  Forms\Components\TextInput::make('is_admin')
                  //  ->required()
                 //   ->maxLength(255)
                  //  ->default(0),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
               // Forms\Components\DateTimePicker::make('email_verified_at'),
                /*Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),*/
                TextInput::make('password')
                  ->password()
                 ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                 ->dehydrated(fn ($state) => filled($state))
                  ->required(fn (string $context): bool => $context === 'create'),
                  
                  
                  
                  
                  
               // Forms\Components\Textarea::make('two_factor_secret')
                   // ->maxLength(65535)
                  //  ->columnSpanFull(),
               /* Forms\Components\Textarea::make('two_factor_recovery_codes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('two_factor_confirmed_at'),
                Forms\Components\TextInput::make('current_team_id')
                    ->numeric(),
                Forms\Components\TextInput::make('profile_photo_path')
                    ->maxLength(2048),*/
                    
                     CheckboxList::make('roles')
                    ->relationship('roles', 'name')
                    ->columns(1)
                    ->helperText('Only Choose One!')
                    ->required(),
                    

                

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                     BooleanColumn::make('is_admin')->sortable(),
              //  Tables\Columns\TextColumn::make('is_admin')
                 //   ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
              /*  Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('two_factor_confirmed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_team_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('profile_photo_path')
                    ->searchable(),*/
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: 0),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
            
             //RolesRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
