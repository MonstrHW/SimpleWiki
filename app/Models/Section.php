<?php

namespace App\Models;

use App\Casts\ReplaceCustomTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Section extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'slug',
        'header',
        'body',
    ];

    protected $casts = [
        'body' => ReplaceCustomTags::class,
    ];
}
