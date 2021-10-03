<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;

use App\Models\Category;
use Symfony\Component\Finder\Iterator\FilenameFilterIterator;

class CategoryController extends Controller
{
    function category(Request $request){
        $categories = Category::with('child')->where('parent_id', 0)->OrderBy('category_name')->get();
        return view('Pages/Category/category', ['categories'=> $categories]);
    }

    function new_category(Request $request){
        $validated = $request->validate([
            'parent_id' => 'required',
            'category_name' => 'required',
            'image' => 'required',
            'IsActive' => 'required'
        ]);


        $filename = Storage::disk('public')->put('images/category', $validated['image']);
        $validated['image']= $filename;
        
        Category::create($validated);
        return redirect('category')->with('success', 'category created sucessfully!');
    }

}
