<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Orchid\Screen\AsSource;

class Social extends Model
{
    use HasFactory, AsSource;
    protected $fillable = ['title'];

}
