<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class News extends Model
{
    use HasFactory, AsSource, Sluggable;
    protected $guarded = [];
    
    public function sluggable(): array
    {
        return ['slug' => ['source' => 'title']];
    }
}
