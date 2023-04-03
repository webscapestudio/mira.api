<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class InvestStrategies extends Model
{
    use HasFactory, AsSource;

    protected $fillable = ['title','description'];

    public function invest_strategieable()
    {
        return $this->morphTo();
    }
}
