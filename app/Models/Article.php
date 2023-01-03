<?php

namespace App\Models;

use App\Casts\ReplaceCustomTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory, Searchable;

    public $timestamps = false;

    protected $fillable = [
        'slug',
        'header',
        'foreword',
        'image'
    ];

    protected $casts = [
        'foreword' => ReplaceCustomTags::class,
    ];

    public function toSearchableArray()
    {
        return [
            'header' => $this->header,
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function saveSections(array $sections)
    {
        $sections = array_filter(
            $sections,
            fn ($s) => !empty($s['header']) && !empty($s['body'])
        );

        $this->sections()->createMany($sections);
    }
}
