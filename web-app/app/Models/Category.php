<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'category_name',
        'image',
        'IsActive'
    ];

    function child(){
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

}
