<?php

namespace App\Filament\Resources\UserPurchasedPackageResource\Pages;

use App\Filament\Resources\UserPurchasedPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserPurchasedPackages extends ListRecords
{
    protected static string $resource = UserPurchasedPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
