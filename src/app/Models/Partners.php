<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Partners extends Model
{
    use AsSource, Attachable;
    protected $table = 'partners';
    protected $fillable = ['title', 'description', 'logo'];

}

