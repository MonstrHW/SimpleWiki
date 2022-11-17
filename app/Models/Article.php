<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'header',
        'foreword',
        'image'
    ];

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
