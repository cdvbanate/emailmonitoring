<?php

namespace App\Filament\Resources\UserinformationResource\Pages;

use App\Filament\Resources\UserinformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUserinformation extends ViewRecord
{
    protected static string $resource = UserinformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
