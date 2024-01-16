<?php

namespace App\Filament\Resources\PropertyResource\RelationManagers;

use App\Models\Facility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FacilitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'facilities';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('value')
                    ->label(__('Value'))
                    ->reactive()
                    ->visible(fn ($get) => $get('type') == 'textbox' || $get('type') == 'number')
                    ->maxLength(255),
                Forms\Components\Textarea::make('value')
                    ->label(__('Value'))
                    ->reactive()
                    ->visible(fn ($get) => $get('type') == 'textarea')
                    ->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('value')
                    ->label(__('Value'))
                    ->reactive()
                    ->visible(fn ($get) => $get('type') == 'markdown')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('value')
                    ->label(__('Value'))
                    ->reactive()
                    ->visible(fn ($get) => $get('type') == 'file')
                    ->columnSpanFull(),
                Forms\Components\Select::make('value')
                    ->label(__('Value'))
                    ->reactive()
                    ->options(function ($get) {
                        $facility = Facility::find($get('id'));

                        if ($facility) {
                            $values = collect($facility->values)->mapWithKeys(function ($k) {
                                return [$k['value'] => $k['value']];
                            });

                            return $values;
                        }

                        return [];
                    })
                    ->visible(fn ($get) => $get('type') == 'select'),
                Forms\Components\CheckboxList::make('value')
                    ->label(__('Value'))
                    ->reactive()
                    ->options(function ($get) {
                        $facility = Facility::find($get('id'));

                        if ($facility) {
                            $values = collect($facility->values)->mapWithKeys(function ($k) {
                                return [$k['value'] => $k['value']];
                            });

                            return $values;
                        }

                        return [];
                    })
                    ->visible(fn ($get) => $get('type') == 'checkbox'),
                Forms\Components\Radio::make('value')
                    ->label(__('Value'))
                    ->reactive()
                    ->options(function ($get) {
                        $facility = Facility::find($get('id'));

                        if ($facility) {
                            $values = collect($facility->values)->mapWithKeys(function ($k) {
                                return [$k['value'] => $k['value']];
                            });

                            return $values;
                        }

                        return [];
                    })
                    ->visible(fn ($get) => $get('type') == 'radio'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('ID')),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('Type')),
                Tables\Columns\TextColumn::make('icon')
                    ->label(__('Icon')),
                Tables\Columns\TextColumn::make('value')
                    ->label(__('Value')),
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
