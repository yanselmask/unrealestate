<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FrontSectionResource\Pages;
use App\Filament\Resources\FrontSectionResource\RelationManagers;
use App\Models\FrontSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FrontSectionResource extends Resource
{
    protected static ?string $model = FrontSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('heading')
                            ->label(__('Heading')),
                        Forms\Components\Select::make('key')
                            ->options([
                                'hero' => __('Hero'),
                                'category' => __('Category'),
                                'service' => __('Service'),
                                'calculator' => __('Calculator'),
                                'partner' => __('Partner'),
                                'agent' => __('Agent'),
                                'offer' => __('Offer'),
                                'contact' => __('Contact'),
                                'info_contact' => __('Card Info'),
                                'city' => __('City'),
                            ])
                            ->label(__('Key')),
                        Forms\Components\Select::make('theme')
                            ->options(themes())
                            ->label(__('Theme')),
                        //Builder HERO
                        Forms\Components\Builder::make('content')
                            ->blocks([
                                Forms\Components\Builder\Block::make('hero')
                                    ->schema([
                                        Forms\Components\TextInput::make('heading')
                                            ->label(__('Heading'))
                                            ->required(),
                                        Forms\Components\Textarea::make('description')
                                            ->label(__('Description'))
                                            ->required(),
                                        Forms\Components\FileUpload::make('image')
                                            ->label(__('Image'))
                                            ->required(),
                                    ]),
                                Forms\Components\Builder\Block::make('category')
                                    ->schema([
                                        Forms\Components\Repeater::make('categories')
                                            ->label(__('Categories'))
                                            ->schema([
                                                Forms\Components\Select::make('category')
                                                    ->options(\App\Models\Category::PropertyType()->get()->mapWithKeys(function ($ct) {
                                                        return [$ct->id => $ct->title];
                                                    }))
                                                    ->required()
                                            ])
                                            ->required()
                                            ->grid(3),
                                    ]),
                                Forms\Components\Builder\Block::make('service')
                                    ->schema([
                                        Forms\Components\Repeater::make('services')
                                            ->schema([
                                                Forms\Components\TextInput::make('heading')
                                                    ->label(__('Heading'))
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->label(__('Description'))
                                                    ->required(),
                                                Forms\Components\FileUpload::make('image')
                                                    ->label(__('Image'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('btn_text')
                                                    ->label(__('Button Text'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('btn_link')
                                                    ->label(__('Button Link'))
                                                    ->required(),
                                                Forms\Components\Select::make('btn_target')
                                                    ->label(__('Button Target'))
                                                    ->default('_self')
                                                    ->options([
                                                        '_self' => __('Same tab'),
                                                        '_blank' => __('New tab')
                                                    ])
                                                    ->required(),
                                            ])
                                    ]),
                                Forms\Components\Builder\Block::make('calculator')
                                    ->schema([
                                        Forms\Components\TextInput::make('heading')
                                            ->label(__('Heading'))
                                            ->required(),
                                        Forms\Components\Textarea::make('description')
                                            ->label(__('Description'))
                                            ->required(),
                                        Forms\Components\FileUpload::make('image')
                                            ->label(__('Image'))
                                            ->required(),
                                        Forms\Components\TextInput::make('btn_text')
                                            ->label(__('Button Text'))
                                            ->required(),
                                        Forms\Components\Select::make('modal')
                                            ->options([
                                                'yes' => __('Yes'),
                                                'no' => __('No')
                                            ])
                                            ->default('yes')
                                            ->required(),
                                        Forms\Components\TextInput::make('btn_link')
                                            ->label(__('Button Link'))
                                            ->required(),
                                        Forms\Components\Select::make('btn_target')
                                            ->label(__('Button Target'))
                                            ->default('_self')
                                            ->options([
                                                '_self' => __('Same tab'),
                                                '_blank' => __('New tab')
                                            ])
                                    ]),
                                Forms\Components\Builder\Block::make('partner')
                                    ->schema([
                                        Forms\Components\TextInput::make('heading')
                                            ->label(__('Heading'))
                                            ->required(),
                                        Forms\Components\Repeater::make('logos')
                                            ->schema([
                                                Forms\Components\FileUpload::make('color')
                                                    ->label(__('Color'))
                                                    ->required(),
                                                Forms\Components\FileUpload::make('gray')
                                                    ->label(__('Gray'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('link')
                                                    ->label(__('Link'))
                                                    ->required()
                                            ])
                                    ]),
                                Forms\Components\Builder\Block::make('agent')
                                    ->schema([
                                        Forms\Components\TextInput::make('heading')
                                            ->label(__('Heading'))
                                            ->required(),
                                        Forms\Components\Repeater::make('agents')
                                            ->schema([
                                                Forms\Components\TextInput::make('quote')
                                                    ->label(__('Quote'))
                                                    ->required(),
                                                Forms\Components\Textarea::make('description')
                                                    ->label(__('Description'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('name')
                                                    ->label(__('Name'))
                                                    ->required(),
                                                Forms\Components\Textarea::make('bio')
                                                    ->label(__('Bio'))
                                                    ->required(),
                                                Forms\Components\KeyValue::make('socials')
                                                    ->required(),
                                                Forms\Components\FileUpload::make('agent_1')
                                                    ->label(__('Agent 1'))
                                                    ->required(),
                                                Forms\Components\FileUpload::make('agent_2')
                                                    ->label(__('Agent 2'))
                                                    ->required(),
                                                Forms\Components\Select::make('stars')
                                                    ->label(__('Stars'))
                                                    ->default(5)
                                                    ->options([
                                                        1 => 1,
                                                        2 => 2,
                                                        3 => 3,
                                                        4 => 4,
                                                        5 => 5,
                                                    ])
                                                    ->required(),
                                                Forms\Components\TextInput::make('reviews')
                                                    ->label(__('Reviews'))
                                                    ->required(),
                                            ])
                                    ]),
                                Forms\Components\Builder\Block::make('offer')
                                    ->schema([
                                        Forms\Components\TextInput::make('heading')
                                            ->label(__('Heading'))
                                            ->required(),
                                        Forms\Components\TextInput::make('view_text')
                                            ->label(__('View All Text')),
                                        Forms\Components\TextInput::make('view_link')
                                            ->label(__('View All Link')),
                                        Forms\Components\TextInput::make('view_icon')
                                            ->label(__('View All Icon')),
                                        Forms\Components\Repeater::make('offers')
                                            ->label(__('Properties'))
                                            ->schema([
                                                Forms\Components\Select::make('property')
                                                    ->options(\App\Models\Property::all()->mapWithKeys(function ($property) {
                                                        return [$property->id => $property->title];
                                                    }))
                                                    ->required()
                                            ])
                                            ->grid(3)
                                    ]),
                                Forms\Components\Builder\Block::make('contact')
                                    ->schema([
                                        Forms\Components\TextInput::make('heading')
                                            ->label(__('Heading'))
                                            ->required(),
                                        Forms\Components\Textarea::make('description')
                                            ->label(__('Description'))
                                            ->required(),
                                        Forms\Components\FileUpload::make('image')
                                            ->label(__('Image'))
                                            ->required(),
                                        Forms\Components\TextInput::make('btn_text')
                                            ->label(__('Button Text')),
                                    ]),
                                Forms\Components\Builder\Block::make('info_contact')
                                    ->schema([
                                        Forms\Components\Repeater::make('values')
                                            ->schema([
                                                Forms\Components\TextInput::make('icon')
                                                    ->label(__('Icon'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('subtitle')
                                                    ->label(__('Subtitle'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('title')
                                                    ->label(__('Title'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('link')
                                                    ->label(__('Link')),
                                            ])
                                    ]),
                                Forms\Components\Builder\Block::make('city')
                                    ->schema([
                                        Forms\Components\TextInput::make('heading')
                                            ->label(__('Heading'))
                                            ->required(),
                                        Forms\Components\TextInput::make('view_all_link')
                                            ->label(__('View all Link'))
                                            ->required(),
                                        Forms\Components\Repeater::make('cities')
                                            ->schema([
                                                Forms\Components\FileUpload::make('image')
                                                    ->label(__('Image'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('city')
                                                    ->label(__('City Name'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('btn_link')
                                                    ->label(__('Button Link'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('sales_count')
                                                    ->label(__('Total sales'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('sales_avg')
                                                    ->label(__('Sales Porcentage'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('rents_count')
                                                    ->label(__('Total rents'))
                                                    ->required(),
                                                Forms\Components\TextInput::make('rents_avg')
                                                    ->label(__('Rents Porcentage'))
                                                    ->required(),
                                                Forms\Components\Select::make('btn_target')
                                                    ->label(__('Button Target'))
                                                    ->default('_self')
                                                    ->options([
                                                        '_self' => __('Same tab'),
                                                        '_blank' => __('New tab')
                                                    ])
                                                    ->required(),
                                            ])
                                    ]),
                            ])
                            ->maxItems(1)
                            ->columnSpanFull()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('ID')),
                Tables\Columns\TextColumn::make('heading')
                    ->label(__('Heading')),
                Tables\Columns\TextColumn::make('key')
                    ->label(__('Key')),
                Tables\Columns\TextColumn::make('theme')
                    ->label(__('Theme')),
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
            'index' => Pages\ListFrontSections::route('/'),
            'create' => Pages\CreateFrontSection::route('/create'),
            'edit' => Pages\EditFrontSection::route('/{record}/edit'),
        ];
    }

    public static function getnavigationGroup(): string
    {
        return __('Posts');
    }
}
