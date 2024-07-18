<?php

namespace App\Filament\Resources\UsersdataResource\Pages;

use App\Filament\Resources\UsersdataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsersdatas extends ListRecords
{
    protected static string $resource = UsersdataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
