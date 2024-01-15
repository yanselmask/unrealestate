<?php

namespace App\Filament\Resources\UserReportsResource\Pages;

use App\Filament\Resources\UserReportsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserReports extends EditRecord
{
    protected static string $resource = UserReportsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
