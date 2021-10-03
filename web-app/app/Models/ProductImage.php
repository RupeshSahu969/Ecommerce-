<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    
    protected $table = 'product_images';
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'product_id',
        'product_image'
        
    ];



}