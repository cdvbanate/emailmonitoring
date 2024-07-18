<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersdataResource\Pages;
use App\Filament\Resources\UsersdataResource\RelationManagers;
use App\Models\Usersdata;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersdataResource extends Resource
{
    protected static ?string $model = Usersdata::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Email-users';
    protected static ?string $modelLabel = 'User Information';
    protected static ?string $navigationGroup = 'TOP Users Data';
    protected static ?string $slug = 'TOP-users-data';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fullname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('sex')
                    ->options([
                        'female' => 'Female',
                        'male' => 'Male',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->autosize()
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sex')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

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
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsersdatas::route('/'),
            'create' => Pages\CreateUsersdata::route('/create'),
            'view' => Pages\ViewUsersdata::route('/{record}'),
            'edit' => Pages\EditUsersdata::route('/{record}/edit'),
        ];
    }    
}
