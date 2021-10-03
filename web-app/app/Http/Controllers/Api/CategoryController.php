<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Traits\Message;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use Message;

    function getCategory(Request $request){
        $categories = Category::with('child')->where('parent_id', 0)->OrderBy('category_name')->get();
        return $this->success('Category List', $categories, 200);
    }
}
