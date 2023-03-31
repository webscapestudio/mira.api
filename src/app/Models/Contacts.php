<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class Contacts extends Model
{
    use HasFactory, AsSource;
    protected $fillable = ['address', 'email', 'phone', 'social_id'];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Social::class);
    }
}
