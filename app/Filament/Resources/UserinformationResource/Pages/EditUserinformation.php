<?php

namespace App\Filament\Resources\UserinformationResource\Pages;

use App\Filament\Resources\UserinformationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserinformation extends EditRecord
{
    protected static string $resource = UserinformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
