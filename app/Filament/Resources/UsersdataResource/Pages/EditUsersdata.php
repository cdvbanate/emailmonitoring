<?php

namespace App\Filament\Resources\UsersdataResource\Pages;

use App\Filament\Resources\UsersdataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsersdata extends EditRecord
{
    protected static string $resource = UsersdataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
