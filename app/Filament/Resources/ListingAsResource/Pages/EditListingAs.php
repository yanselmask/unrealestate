<?php

namespace App\Filament\Resources\ListingAsResource\Pages;

use App\Filament\Resources\ListingAsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditListingAs extends EditRecord
{
    protected static string $resource = ListingAsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
