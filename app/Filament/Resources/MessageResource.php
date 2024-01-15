<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Filament\Resources\MessageResource\RelationManagers;
use App\Models\Message;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('sender_id')
                    ->label(__('Sender'))
                    ->searchable()
                    ->relationship('sender', 'name'),
                Forms\Components\Select::make('receiver_id')
                    ->label(__('Receiver'))
                    ->searchable()
                    ->relationship('receiver', 'name'),
                Forms\Components\Select::make('property_id')
                    ->label(__('Property'))
                    ->searchable()
                    ->relationship('property', 'title'),
                Forms\Components\DateTimePicker::make('booking')
                    ->label(__('Booking')),
                Forms\Components\Textarea::make('message')
                    ->label(__('Message'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sender.name')
                    ->label(__('Sender')),
                Tables\Columns\TextColumn::make('receiver.name')
                    ->label(__('Receiver')),
                Tables\Columns\TextColumn::make('property.title')
                    ->label(__('Property')),
                Tables\Columns\TextColumn::make('booking')
                    ->label(__('Booking')),
                Tables\Columns\TextColumn::make('message')
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
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }

    public static function getnavigationGroup(): string
    {
        return __('Real Estate');
    }
}
