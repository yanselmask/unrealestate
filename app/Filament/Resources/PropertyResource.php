<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        $listing_As = \App\Models\ListingAs::orderBy('sort_order')->get()->mapWithKeys(function ($lis) {
            return [$lis->id => $lis->title];
        });

        return $form
            ->schema([
                Forms\Components\Fieldset::make(__('Basic info'))
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('Title'))
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('property_type')
                            ->label(__('Category'))
                            ->reactive()
                            ->live()
                            ->default(0)
                            ->options([
                                0 => __('For Sell'),
                                1 => __('For Rent')
                            ])
                            ->required(),
                        Forms\Components\Select::make('category_id')
                            ->label(__('Property Type '))
                            ->relationship('category', 'title->' . config('app.locale'))
                            ->reactive()
                            ->live()
                            ->searchable()
                            ->required(),
                        Forms\Components\Radio::make('listing_as_id')
                            ->label(__('Are you listing on Finder as part of a company?'))
                            ->options($listing_As)
                            ->required(),
                    ]),
                Forms\Components\Fieldset::make(__('Location'))
                    ->schema([
                        Forms\Components\TextInput::make('country')
                            ->label(__('Country'))
                            ->required(),
                        Forms\Components\TextInput::make('city')
                            ->label(__('City'))
                            ->required(),
                        Forms\Components\TextInput::make('state')
                            ->label(__('State'))
                            ->required(),
                        Forms\Components\TextInput::make('zip_code')
                            ->label(__('Zip Code'))
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->label(__('Address'))
                            ->required()
                            ->columnSpanFull(),
                        \Cheesegrits\FilamentGoogleMaps\Fields\Map::make('location')
                            ->mapControls([
                                'mapTypeControl'    => true,
                                'scaleControl'      => true,
                                'streetViewControl' => true,
                                'rotateControl'     => true,
                                'fullscreenControl' => true,
                                'searchBoxControl'  => false, // creates geocomplete field inside map
                                'zoomControl'       => true,
                            ])
                            ->autocomplete('address')
                            ->autocompleteReverse(true)
                            ->geolocate()
                            ->geolocateLabel(__('Get Location'))
                            ->geolocateOnLoad(true) //
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $set('latitude', $state['lat']);
                                $set('longitude', $state['lng']);
                            })
                            ->reverseGeocode(
                                [
                                    'country' => '%C',
                                    'city' => '%L',
                                    'state' => '%A1',
                                    'zip_code' => '%z',
                                    'address' => '%n %S',
                                ]
                            )
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('latitude')
                            ->label(__('Latitude'))
                            ->required(),
                        Forms\Components\TextInput::make('longitude')
                            ->label(__('Longitude'))
                            ->required(),
                    ]),
                Forms\Components\Fieldset::make(__('Property details'))
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label(__('Description'))
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Fieldset::make(__('Price'))
                    ->schema([
                        Forms\Components\Select::make('rent_interval')
                            ->label(__('Rent Interval'))
                            ->options([
                                'day' => __('Day'),
                                'week' => __('Week'),
                                'month' => __('Month'),
                                'year' => __('Year'),
                            ])
                            ->visible(function ($get) {
                                return $get('property_type') == 1;
                            })
                            ->required(),
                        Forms\Components\TextInput::make('rent_duration')
                            ->label(__('Rent Durations'))
                            ->visible(function ($get) {
                                return $get('property_type') == 1;
                            }),
                        Forms\Components\Repeater::make('price')
                            ->schema([
                                Forms\Components\Select::make('code')
                                    ->options(site_currencies())
                                    ->reactive()
                                    ->live()
                                    ->default(setting('localization_default_currency'))
                                    ->label(__('Currency')),
                                Forms\Components\TextInput::make('price')
                                    ->prefix(function ($get) {
                                        return $get('code');
                                    })
                                    ->label(__('Price')),
                            ])
                            ->columnSpanFull()
                            ->required(),
                    ]),
                Forms\Components\FieldSet::make(__('Photos'))
                    ->schema([
                        Forms\Components\FileUpload::make('main_image')
                            ->label(__('Main Image'))
                            ->required()
                            ->columnSpanFull(),
                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->multiple()
                            ->reorderable()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('threed_image')
                            ->label(__('3D Image')),
                        Forms\Components\TextInput::make('video_link')
                            ->label(__('Video Link')),
                    ]),
                Forms\Components\Fieldset::make(__('Options'))
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label(__('User'))
                            ->relationship('user', 'name')
                            ->searchable()
                            ->default(auth()->user()->id)
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label(__('Status'))
                            ->options([
                                1 => __('Active'),
                                0 => __('Inactive')
                            ])
                            ->default(1)
                            ->required(),
                    ]),
                Forms\Components\Fieldset::make(__('Contacts'))
                    ->schema([
                        Forms\Components\Repeater::make('contact')
                            ->label(__('Contact information'))
                            ->schema([
                                Forms\Components\TextInput::make('key')
                                    ->label(__('Key')),
                                Forms\Components\TextInput::make('value')
                                    ->label(__('Value'))
                            ])
                            ->defaultItems(0)
                            ->grid(2)
                            ->collapsed()
                            ->columnSpanFull()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title')),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('User')),
                Tables\Columns\TextColumn::make('address')
                    ->label(__('Address')),
                Tables\Columns\TextColumn::make('category.title')
                    ->label(__('Category')),
                Tables\Columns\ImageColumn::make('main_image')
                    ->label(__('Image')),
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }

    public static function getnavigationGroup(): string
    {
        return __('Real Estate');
    }
}
