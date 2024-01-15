<?php

namespace App\Filament\Resources\OutdoorResource\Pages;

use App\Filament\Resources\OutdoorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOutdoor extends EditRecord
{
    protected static string $resource = OutdoorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
