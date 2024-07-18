<?php

namespace App\Filament\Resources\UsersdataResource\Pages;

use App\Filament\Resources\UsersdataResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUsersdata extends ViewRecord
{
    protected static string $resource = UsersdataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
