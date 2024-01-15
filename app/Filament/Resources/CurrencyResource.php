<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurrencyResource\Pages;
use App\Filament\Resources\CurrencyResource\RelationManagers;
use App\Models\Currency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class CurrencyResource extends Resource
{
    protected static ?string $model = Currency::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->helperText(__('Example: U.S. Dollar')),
                Forms\Components\TextInput::make('code')
                    ->label(__('Code'))
                    ->helperText(__('Example: USD')),
                Forms\Components\TextInput::make('symbol')
                    ->label(__('Symbol'))
                    ->helperText(__('Example: $')),
                Forms\Components\TextInput::make('format')
                    ->label(__('Format'))
                    ->helperText(__('Example: $1,0.00')),
                Forms\Components\TextInput::make('exchange_rate')
                    ->label(__('Exchange Rate'))
                    ->helperText(__('Example: 1.00000000')),
                Forms\Components\Select::make('active')
                    ->label(__('Status'))
                    ->default(1)
                    ->options([
                        1 => __('Active'),
                        0 => __('Inactive'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('code')
                    ->label(__('Code')),
                Tables\Columns\TextColumn::make('symbol')
                    ->label(__('Symbol')),
                Tables\Columns\TextColumn::make('format')
                    ->label(__('Format')),
                Tables\Columns\TextColumn::make('exchange_rate')
                    ->label(__('Exchange Rate')),
                Tables\Columns\CheckboxColumn::make('active')
                    ->label(__('Active')),
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
            'index' => Pages\ListCurrencies::route('/'),
            'create' => Pages\CreateCurrency::route('/create'),
            'edit' => Pages\EditCurrency::route('/{record}/edit'),
        ];
    }

    public static function getnavigationGroup(): string
    {
        return __('Real Estate');
    }
}
