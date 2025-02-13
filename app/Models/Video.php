<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'url',
        'published_at',
        'previous',
        'next',
        'series_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Get the formatted published date.
     *
     * @return string
     */
    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? Carbon::parse($this->published_at)->translatedFormat('d \d\e F \d\e Y') : 'No publicado';
    }

    /**
     * Get the published date in a human-readable format.
     *
     * @return string
     */
    public function getFormattedForHumansPublishedAtAttribute()
    {
        return $this->published_at ? Carbon::parse($this->published_at)->diffForHumans() : 'No publicado';
    }

    /**
     * Get the published date as a timestamp.
     *
     * @return int|string
     */
    public function getPublishedAtTimestampAttribute()
    {
        return $this->published_at ? Carbon::parse($this->published_at)->timestamp : 'No publicado';
    }
}
