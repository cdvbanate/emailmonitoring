<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserinformationResource\Pages;
use App\Filament\Resources\UserinformationResource\RelationManagers;
use App\Models\Userinformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



class UserinformationResource extends Resource
{
    protected static ?string $model = Userinformation::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $modelLabel = 'User Information';
    protected static ?string $navigationGroup = 'TOP Users Data';
    protected static ?string $slug = 'TOP-users';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Informations')
                ->description('Put the user information here.')
                ->schema([
                    Forms\Components\TextInput::make('fullname')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('sex')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                ])
                ->columns(3),

                Forms\Components\Section::make('Date of User Assisted')
                ->description('Put the date when user assisted here.')
                ->schema([
                Forms\Components\DatePicker::make('date_received')
                    ->required(),
                Forms\Components\DatePicker::make('date_emailed')
                    ->required(),
                ])
                ->columns(2),

                Forms\Components\Section::make('Mode of Communication')
                ->description('Put the reccomendation of users here.')
                ->schema([
                Forms\Components\TextInput::make('mode_of_communication')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nature_of_concern')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('actual_inquiry')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('recommendation')
                    ->required()
                    ->maxLength(255),
                ])
                ->columns(2),

                Forms\Components\Section::make('Person in Charge')
                ->description('Put the Person in charge here.')
                ->schema([
                Forms\Components\Select::make('person_in_charge')
                ->options([
                    'cristian' => 'Cristian',
                    'carlo' => 'Carlo',
                    'marmel' => 'Marmel',
                    'janel' => 'Janel',
                ])
                ->native(false)
                    ->required()
                    ])
                    ->columns(1),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sex')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_received')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_emailed')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mode_of_communication')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nature_of_concern')
                    ->searchable(),
                Tables\Columns\TextColumn::make('actual_inquiry')
                    ->searchable(),
                Tables\Columns\TextColumn::make('recommendation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('person_in_charge')
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
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserinformations::route('/'),
            'create' => Pages\CreateUserinformation::route('/create'),
            'view' => Pages\ViewUserinformation::route('/{record}'),
            'edit' => Pages\EditUserinformation::route('/{record}/edit'),
        ];
    }    
}
