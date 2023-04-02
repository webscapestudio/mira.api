<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class AboutAchievements extends Model
{
    use HasFactory, AsSource;

    protected $fillable = ['number','addition','description'];
    
    public function about_achievementable()
    {
        return $this->morphTo();
    }
}
