<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnitureTransportationService extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getImageUrlAttribute()
    {
        return asset( 'storage/' . $this->image);
    }
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
    public function products(){
        return $this->hasMany(FurnitureTransportationServiceProducts::class ,'service_id', 'id');
    }
    public function comments()
    {
        return $this->morphMany(GeneralComments::class, 'commentable');
    }
}