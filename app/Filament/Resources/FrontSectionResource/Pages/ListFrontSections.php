<?php

namespace App\Filament\Resources\FrontSectionResource\Pages;

use App\Filament\Resources\FrontSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFrontSections extends ListRecords
{
    protected static string $resource = FrontSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
