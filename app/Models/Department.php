<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeParent($query)
    {
        return $query->where('department_id', 0)->orWhere('department_id', null);
    }
    public function sub_departments()
    {
        return $this->hasMany(\App\Models\SubDepartment::class, 'department_id');
    }
    public function parent_Department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function departments()
    {
        return $this->morphMany(UserDepartment::class, 'commentable');
    }
    public function favoriteDepartments()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
    // public function departmentNameParent()
    // {
    //     $parent_id = $this->id;
    //     $department_name = '';

    //     if ($parent_id) {
    //         $parent_department_names = [];
    //         while ($parent_id) {
    //             $department = DB::table('departments')->whereId($parent_id)->first();
    //             $parent_id = $department->id;
    //             $parent_department_names[] = $department->name;
    //         }
    //         //krsort($parent_category_names);
    //         $department_name .= ' → ' . implode(' → ', $parent_department_names);
    //     }
    //     return $department_name;
    // }

    // public function getDepartmentNameParent()
    // {
    //     $department_name = $this->name . $this->departmentNameParent();
    //     return $department_name;
    // }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
    public function topics()
    {
        return $this->belongsToMany(Category::class, 'departments_categories');
    }
    public function second_category()
    {
        return $this->belongsTo(Category::class, 'second_category_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'department_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_departments');
    }
    public function serv_depart()
    {
        return $this->belongsTo(Services::class, 'department_id');
    }

    public function fields()
    {
        return $this->hasMany(DepartmentField::class);
    }
    public function inputs()
{
    return $this->belongsToMany(Inputs::class, 'department_inputs', 'department_id', 'input_id');
}
}
