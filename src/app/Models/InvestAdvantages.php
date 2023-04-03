<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class InvestAdvantages extends Model
{
    use HasFactory, AsSource;

    protected $fillable = ['title','description'];

    public function invest_advantageable()
    {
        return $this->morphTo();
    }
}
