<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class FrontSection extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'content' => 'array'
    ];

    public function sectionable()
    {
        return $this->morphTo(__FUNCTION__);
    }

    /**
     * Get all attached models of the given class to the category.
     *
     * @param string $class
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function entries(string $class): MorphToMany
    {
        return $this->morphedByMany($class, 'sectionable', 'sectionables');
    }

    /**
     * Get all attached models of the given class to the category.
     *
     * @param string $class
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function pages(): MorphToMany
    {
        return $this->morphedByMany(Page::class, 'sectionable', 'sectionables')->withPivot('sort_order');
    }
}
