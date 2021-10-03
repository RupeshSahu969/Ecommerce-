<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'product_name',
        'amount',
        'quantity',
        'IsActive'
        
    ];

    function images(){
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id');
    }

}
