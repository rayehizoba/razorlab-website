<?php

namespace App\Models;

use AlAminFirdows\LaravelEditorJs\Facades\LaravelEditorJs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'links' => 'array',
        'content' => 'array',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    /**
     * Scope a query to only include featured projects.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * @return string|null
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? Storage::url($this->thumbnail) : null;
    }

    /**
     * @return string|null
     */
    public function getThumbnailMaskUrlAttribute()
    {
        return $this->thumbnail_mask ? Storage::url($this->thumbnail_mask) : null;
    }

    /**
     * @return string|null
     */
    public function getCaptionUrlAttribute()
    {
        return $this->caption ? Storage::url($this->caption) : null;
    }

    /**
     * @return mixed
     */
    public function getContentRenderedAttribute()
    {
        try {
            return LaravelEditorJs::render($this->attributes['content']);
        } catch (\Exception $e) {
            return '';
        }
    }
}
