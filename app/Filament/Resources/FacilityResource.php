<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilityResource\Pages;
use App\Filament\Resources\FacilityResource\RelationManagers;
use App\Models\Facility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('Name'))
                            ->required()
                            ->columns(1),
                        Forms\Components\Select::make('type')
                            ->label(__('Type'))
                            ->required()
                            ->reactive()
                            ->live()
                            ->options([
                                'textbox' => __('Text Box'),
                                'textarea' => __('Text Area'),
                                'select' => __('Select'),
                                'radio' => __('Radio'),
                                'checkbox' => __('Checkbox'),
                                'file' => __('File'),
                                'number' => __('Number'),
                                'markdown' => __('Markdown'),
                            ])
                            ->columns(1),
                        Forms\Components\TextInput::make('icon')
                            ->label(__('Icon'))
                            ->columns(1),
                    ]),
                Forms\Components\Grid::make(4)
                    ->schema([
                        Forms\Components\Repeater::make('value')
                            ->label(__('Values'))
                            ->visible(
                                function ($get) {
                                    return $get('type') == 'select' || $get('type') == 'radio' || $get('type') == 'checkbox';
                                }
                            )
                            ->schema([
                                Forms\Components\TextInput::make('value')
                                    ->required(),
                                Forms\Components\TextInput::make('icon')
                            ])
                            //->collapsed()
                            ->grid(3)
                            ->columnSpanFull()
                    ])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('ID'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('Type'))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    // ->disk('public')
                    ->label(__('Image'))
                    ->searchable(),
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
            'index' => Pages\ListFacilities::route('/'),
            'create' => Pages\CreateFacility::route('/create'),
            'edit' => Pages\EditFacility::route('/{record}/edit'),
        ];
    }

    public static function getnavigationGroup(): string
    {
        return __('Real Estate');
    }
}
