<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserinformationResource\Pages;
use App\Filament\Resources\UserinformationResource\RelationManagers;
use App\Mail\Hellomail;
use App\Models\Userinformation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



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
        $loggedInUser = Auth::user(); // Get the currently logged-in user
        
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
                        'Male' => 'Male',
                        'Female' => 'Female',
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
                    Forms\Components\Select::make('nature_of_concern')
                    ->options([
                        'How to Access TOP' => 'How to Access TOP',
                        'How to Enroll' => 'How to Enroll',
                        'Verification of Certificate of Completion' => 'Verification of Certificate of Completion',
                        'Change User Password' => 'Change User Password',
                        'Inquire to TOP courses' => 'Inquire to TOP courses',
                    ])
                    ->native(false)
                    ->required(),

                Forms\Components\TextArea::make('actual_inquiry')
                    ->required()
                    ->rows(5) // Changed `row` to `rows` for correct method name
                    ->maxLength(1000),
                Forms\Components\TextArea::make('recommendation')
                    ->required()
                    ->rows(5)
                    ->maxLength(1000),
                ])
                ->columns(2),

                Forms\Components\Section::make('Person in Charge')
                ->description('Put the Person in charge here.')
                ->schema([
                    Forms\Components\Select::make('person_in_charge')
                    ->options([
                        $loggedInUser->name => $loggedInUser->name, // Use logged-in user's name as an option
                    ])
                    ->native(false)
                    ->required()
                    ])
                    ->columns(1),

  
                Forms\Components\Select::make('status')
                    ->options([
                        'Approved' => 'Approved',
                        'Reject' => 'Reject',
                    ])
                    ->native(false)
                    ->required(),
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
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('recommendation')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('person_in_charge')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
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
    // Sending email after creating a record
    public static function afterCreate(Userinformation $userinformation)
    {
        $user = $userinformation; // Assuming $userinformation has the user data

        Mail::to($user->email)->send(new Hellomail($user));
    }
    
}
