<?php

namespace App\Filament\Resources\ListingAsResource\Pages;

use App\Filament\Resources\ListingAsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListListingAs extends ListRecords
{
    protected static string $resource = ListingAsResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
