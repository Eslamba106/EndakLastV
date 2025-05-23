<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en'
    ];

    public function governements()
    {
        return $this->hasMany(Governements::class,'country_id');
    }
}
