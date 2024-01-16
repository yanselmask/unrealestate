<?php

namespace App\Filament\Resources\FrontSectionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    protected bool $allowsDuplicates = true;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sort_order')
                    ->label(__('Order')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('heading')
            ->columns([
                Tables\Columns\TextColumn::make('heading')
                    ->label(__('Heading')),
                Tables\Columns\TextColumn::make('key')
                    ->label(__('Key')),
                Tables\Columns\TextColumn::make('theme')
                    ->label(__('Theme')),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('Order')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make(),
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
