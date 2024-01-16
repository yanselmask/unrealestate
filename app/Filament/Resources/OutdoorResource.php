<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutdoorResource\Pages;
use App\Filament\Resources\OutdoorResource\RelationManagers;
use App\Models\Outdoor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OutdoorResource extends Resource
{
    protected static ?string $model = Outdoor::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name.' . config('app.locale'))
                    ->label(__('Name'))
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->label(__('Image')),
                Forms\Components\TextInput::make('icon')
                    ->label(__('Icon'))
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('ID')),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('icon')
                    ->label(__('Icon')),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('Image'))
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOutdoors::route('/'),
            'create' => Pages\CreateOutdoor::route('/create'),
            'edit' => Pages\EditOutdoor::route('/{record}/edit'),
        ];
    }

    public static function getnavigationGroup(): string
    {
        return __('Real Estate');
    }
}
