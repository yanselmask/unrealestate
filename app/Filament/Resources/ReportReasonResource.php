<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportReasonResource\Pages;
use App\Filament\Resources\ReportReasonResource\RelationManagers;
use App\Models\ReportReason;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportReasonResource extends Resource
{
    protected static ?string $model = ReportReason::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reason.' . config('app.locale'))
                    ->label(__('Reason'))
                    ->required(),
                Forms\Components\Textarea::make('description.' . config('app.locale'))
                    ->label(__('Description'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('ID')),
                Tables\Columns\TextColumn::make('reason')
                    ->label(__('Reason')),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('Description'))
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
            'index' => Pages\ListReportReasons::route('/'),
            'create' => Pages\CreateReportReason::route('/create'),
            'edit' => Pages\EditReportReason::route('/{record}/edit'),
        ];
    }

    public static function getnavigationGroup(): string
    {
        return __('Real Estate');
    }
}
