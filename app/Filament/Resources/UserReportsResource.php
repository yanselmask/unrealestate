<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserReportsResource\Pages;
use App\Filament\Resources\UserReportsResource\RelationManagers;
use App\Models\UserReports;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserReportsResource extends Resource
{
    protected static ?string $model = UserReports::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-thumb-down';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\COmponents\Grid::make(3)
                    ->schema([
                        Forms\Components\Select::make('reason_id')
                            ->relationship('reason', 'reason->' . config('app.locale'))
                            ->searchable()
                            ->label(__('Reason'))
                            ->required(),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->label(__('User'))
                            ->required(),
                        Forms\Components\Select::make('property_id')
                            ->relationship('property', 'title')
                            ->searchable()
                            ->label(__('Property'))
                            ->required(),
                    ]),
                Forms\Components\Grid::make(4)
                    ->schema([
                        Forms\Components\Textarea::make('another_message')
                            ->label(__('Message'))
                            ->rows(5)
                            ->columnSpan(2)
                            ->columnStart(2),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reason')
                    ->label(__('Reason')),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('User')),
                Tables\Columns\TextColumn::make('property.title')
                    ->label(__('Property')),
                Tables\Columns\TextColumn::make('another_message')
                    ->label(__('Message')),
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
            'index' => Pages\ListUserReports::route('/'),
            'create' => Pages\CreateUserReports::route('/create'),
            'edit' => Pages\EditUserReports::route('/{record}/edit'),
        ];
    }

    public static function getnavigationGroup(): string
    {
        return __('Real Estate');
    }
}
