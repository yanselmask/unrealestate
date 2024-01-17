<?php

namespace App\Models;

use App\Traits\HasComments;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Tags\HasTags;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Spatie\Image\Enums\CropPosition;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, HasSlug, HasTags, HasSEO, Searchable, HasComments, InteractsWithMedia;
    use \Conner\Likeable\Likeable;

    protected $guarded = [];

    protected $casts = [
        'status' => \App\Enums\PostStatus::class,
        'template' => \App\Enums\PostTemplate::class,
        'is_featured' => 'boolean',
        'is_sponsored' => 'boolean',
        'allowed_comment' => 'boolean',
        'editorjs_blocks' => 'array'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable')->PostType();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFeatured($sql)
    {
        return $sql->where('is_featured', true);
    }

    public function scopeNotFeatured($sql)
    {
        return $sql->where('is_featured', false);
    }

    public function metas()
    {
        return $this->morphMany(Meta::class, 'metable');
    }

    public function authorName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user_id ? $this->user->fullname : __('Admin')
        );
    }

    public function authorImage(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user_id ? $this->user->profile_photo_url : "https://www.gravatar.com/avatar/" . md5(setting('site_admin_email') ?? 'email@example.com')
        );
    }

    public function authorBio(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user_id ? $this->user->bio : __('Admin Bio')
        );
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    #[SearchUsingFullText(['title', 'content', 'editorjs_blocks', 'gjs_data'])]
    public function toSearchableArray()
    {
        return [
            'title' => (string) $this->title,
            'excerpt' => (string) $this->excerpt,
            'content' => (string) $this->content,
            'editorjs_blocks' => (string) $this->editorjs_blocks,
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('default', 'default') != '' ? $this->getFirstMediaUrl('default', 'default') : 'https://placehold.co/1272x600'
        );
    }

    public function imageSingle(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('default', 'single') != '' ? $this->getFirstMediaUrl('default', 'single') : 'https://placehold.co/2592x1200'
        );
    }

    public function imageFeatured(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('default', 'featured') != '' ? $this->getFirstMediaUrl('default', 'featured') : 'https://placehold.co/1712x800'
        );
    }

    public function imageThumbUrl(): Attribute
    {
        return Attribute::make(
            get: fn () =>  $this->getFirstMediaUrl('default', 'thumb') != '' ? $this->getFirstMediaUrl('default', 'thumb') : 'https://placehold.co/200x200'
        );
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->resize(200, 200)
            ->nonQueued();

        $this->addMediaConversion('featured')
            ->resize(1712, 800)
            ->nonQueued();

        $this->addMediaConversion('default')
            ->resize(1272, 600)
            ->nonQueued();

        $this->addMediaConversion('single')
            ->resize(2592, 1200)
            ->nonQueued();
    }
}
