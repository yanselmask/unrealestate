<?php

namespace App\Filament\Resources\UserPurchasedPackageResource\Pages;

use App\Filament\Resources\UserPurchasedPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserPurchasedPackage extends EditRecord
{
    protected static string $resource = UserPurchasedPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
