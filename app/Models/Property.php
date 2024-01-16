<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Property extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    use \Conner\Likeable\Likeable;

    protected $guarded = [];

    protected $casts = [
        'price' => 'array',
        'location' => 'array',
        'contact' => 'array',
        'status' => \App\Enums\PropertyStatus::class,
    ];

    protected $appends = [
        'location',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listingAs()
    {
        return $this->belongsTo(ListingAs::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class)->withPivot('value');
    }

    public function outdoors()
    {
        return $this->belongsToMany(Outdoor::class)->withPivot('distance');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDrafted($query)
    {
        return $query->where('status', 0);
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 2);
    }

    public function firstImageMedia(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMedia('gallery') ? $this->getFirstMedia('gallery')->getUrl('single') : 'https://placehold.co/2592x1200'
        );
    }

    public function secImageMedia(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getMedia('gallery') && count($this->getMedia('gallery')) > 1 ? $this->getMedia('gallery')[1]->getUrl('single') : 'https://placehold.co/2592x1200'
        );
    }

    public function treImageMedia(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getMedia('gallery') && count($this->getMedia('gallery')) > 2 ? $this->getMedia('gallery')[2]->getUrl('single') : 'https://placehold.co/2592x1200'
        );
    }

    public function restsImagesMedia(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getMedia('gallery') && count($this->getMedia('gallery')) > 3 ? $this->getMedia('gallery')->slice(3) : null
        );
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->main_image ? Storage::url($this->main_image) : 'https://placehold.co/1272x600'
        );
    }

    public function imageSingle(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->main_image ? Storage::url($this->main_image) : 'https://placehold.co/2592x1200'
        );
    }

    public function imageFeatured(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->main_image ? Storage::url($this->main_image) : 'https://placehold.co/1712x800'
        );
    }

    public function imageThumbUrl(): Attribute
    {
        return Attribute::make(
            get: fn () =>  $this->main_image ? Storage::url($this->main_image) : 'https://placehold.co/200x200'
        );
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->resize(467, 305);

        $this->addMediaConversion('featured')
            ->resize(1272, 1060);

        $this->addMediaConversion('single')
            ->resize(1000, 707);
    }

    public function gallery(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getMedia('gallery')
        );
    }


    /**
     * ADD THE FOLLOWING METHODS TO YOUR Property MODEL
     *
     * The 'latitude' and 'longitude' attributes should exist as fields in your table schema,
     * holding standard decimal latitude and longitude coordinates.
     *
     * The 'location' attribute should NOT exist in your table schema, rather it is a computed attribute,
     * which you will use as the field name for your Filament Google Maps form fields and table columns.
     *
     * You may of course strip all comments, if you don't feel verbose.
     */

    /**
     * Returns the 'latitude' and 'longitude' attributes as the computed 'location' attribute,
     * as a standard Google Maps style Point array with 'lat' and 'lng' attributes.
     *
     * Used by the Filament Google Maps package.
     *
     * Requires the 'location' attribute be included in this model's $fillable array.
     *
     * @return array
     */

    public function getLocationAttribute(): array
    {
        return [
            "lat" => (float)$this->latitude,
            "lng" => (float)$this->longitude,
        ];
    }

    /**
     * Takes a Google style Point array of 'lat' and 'lng' values and assigns them to the
     * 'latitude' and 'longitude' attributes on this model.
     *
     * Used by the Filament Google Maps package.
     *
     * Requires the 'location' attribute be included in this model's $fillable array.
     *
     * @param ?array $location
     * @return void
     */
    public function setLocationAttribute(?array $location): void
    {
        if (is_array($location)) {
            $this->attributes['latitude'] = $location['lat'];
            $this->attributes['longitude'] = $location['lng'];
            unset($this->attributes['location']);
        }
    }

    /**
     * Get the lat and lng attribute/field names used on this table
     *
     * Used by the Filament Google Maps package.
     *
     * @return string[]
     */
    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'latitude',
            'lng' => 'longitude',
        ];
    }

    /**
     * Get the name of the computed location attribute
     *
     * Used by the Filament Google Maps package.
     *
     * @return string
     */
    public static function getComputedLocation(): string
    {
        return 'location';
    }
}
