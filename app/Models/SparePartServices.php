<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartServices extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function booted(){
        static::addGlobalScope('status' , function(Builder $builder){
            $builder->where('status' , 'open');
        });
    }

    public function user(){
        return $this->belongsTo(User::class );
    }
    public function sparePart()
    {
        return $this->belongsTo(SpareParts::class, 'spare_part_id');
    }
    public function comments()
    {
        return $this->morphMany(GeneralComments::class, 'commentable');
    }
    public function orders()
    {
        return $this->morphMany(GeneralOrder::class, 'orderable');
    }
    public function images()
    {
        return $this->morphMany(GeneralImage::class, 'commentable');
    }
}
