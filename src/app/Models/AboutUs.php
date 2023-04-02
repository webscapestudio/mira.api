<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class AboutUs extends Model
{
    use HasFactory, AsSource;
    protected $fillable = ['title', 'description', 'text_size', 'image_desc', 'image_mob'];
    public function about_achievement()
    {
        return $this->morphMany(AboutAchievements::class, 'about_achievementable');
    }
}
