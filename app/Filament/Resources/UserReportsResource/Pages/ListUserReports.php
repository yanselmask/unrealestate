<?php

namespace App\Filament\Resources\UserReportsResource\Pages;

use App\Filament\Resources\UserReportsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserReports extends ListRecords
{
    protected static string $resource = UserReportsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
