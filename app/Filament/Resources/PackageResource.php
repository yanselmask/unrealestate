<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),
                Forms\Components\TextInput::make('short_name')
                    ->label(__('Short Name')),
                Forms\Components\Select::make('interval')
                    ->label(__('Interval'))
                    ->options([
                        'day' => 'Day',
                        'week' => 'Week',
                        'month' => 'Month',
                        'year' => 'Year',
                    ])
                    ->default('day')
                    ->required(),
                Forms\Components\TextInput::make('duration')
                    ->label(__('Duration'))
                    ->required(),

                Forms\Components\TextInput::make('listing_limit')
                    ->label(__('Listing Limit'))
                    ->required(),
                Forms\Components\TextInput::make('ads_limit')
                    ->label(__('Ads Limit'))
                    ->required(),
                Forms\Components\Select::make('is_recommended')
                    ->label(__('Recommended'))
                    ->options([
                        1 => 'Recommended',
                        0 => 'Not recommended',
                    ])
                    ->default(0)
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label(__('Status'))
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive',
                    ])
                    ->default(1)
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->label(__('Image'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('features')
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label(__('Feature')),
                        Forms\Components\Checkbox::make('checked')
                            ->label(__('Checked'))
                    ])
                    ->grid(3)
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('short_name')
                    ->label(__('Short Name')),
                Tables\Columns\TextColumn::make('interval')
                    ->label(__('Interval')),
                Tables\Columns\TextColumn::make('duration')
                    ->label(__('Duration')),
                Tables\Columns\TextColumn::make('listing_limit')
                    ->label(__('Listing Limit')),
                Tables\Columns\TextColumn::make('ads_limit')
                    ->label(__('Ads Limit')),
                Tables\Columns\CheckboxColumn::make('status')
                    ->label(__('Status')),
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
            RelationManagers\PricesRelationManager::class,
            RelationManagers\UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }


    public static function getnavigationGroup(): string
    {
        return __('Real Estate');
    }
}
