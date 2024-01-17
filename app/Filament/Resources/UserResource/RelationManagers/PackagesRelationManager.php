<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackagesRelationManager extends RelationManager
{
    protected static string $relationship = 'packages';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('start_at')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_at'),
                Forms\Components\DateTimePicker::make('canceled_at'),
                Forms\Components\TextInput::make('used_listing'),
                Forms\Components\TextInput::make('used_ads'),
                Forms\Components\TextInput::make('limit_listing'),
                Forms\Components\TextInput::make('limit_ads'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('start_at'),
                Tables\Columns\TextColumn::make('end_at'),
                Tables\Columns\TextColumn::make('canceled_at'),
                Tables\Columns\TextColumn::make('used_listing'),
                Tables\Columns\TextColumn::make('used_ads'),
                Tables\Columns\TextColumn::make('limit_listing'),
                Tables\Columns\TextColumn::make('limit_ads'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\DateTimePicker::make('start_at')
                            ->required(),
                        Forms\Components\DateTimePicker::make('end_at'),
                        Forms\Components\DateTimePicker::make('canceled_at'),
                        Forms\Components\TextInput::make('used_listing'),
                        Forms\Components\TextInput::make('used_ads'),
                        Forms\Components\TextInput::make('limit_listing'),
                        Forms\Components\TextInput::make('limit_ads'),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
