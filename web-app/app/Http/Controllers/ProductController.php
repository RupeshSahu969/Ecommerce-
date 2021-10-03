<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ProductController extends Controller
{
    function product(Request $request){

        // get product lists
        $products = Product::with(['images'])->paginate(10);
        // end
        return view('Pages/Product/products', ['products'=>$products]);
    }

    function add_product(Request $request){

        $categories = Category::with('child')->where('parent_id', 0)->OrderBy('category_name')->get();

        if($request->isMethod('post')){
            $images = [];
            // validation logic
            $body = $request->validate([
                'category_id' => 'required',
                'product_name' => 'required',
                'amount' => 'required',
                'quantity' => 'required',
                'IsActive' => 'required',
                'product_images.*'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
            ]);
            // save product
            $postBody = [
                'category_id' => $body['category_id'],
                'product_name' => $body['product_name'],
                'amount' => $body['amount'],
                'quantity' => $body['quantity'],
                'IsActive' => $body['IsActive']
            ];

            $product = Product::create($postBody);
            foreach($body['product_images'] as $image){
                $saved_image = Storage::disk('public')->put('images/product', new File($image));
                array_push($images, [ 'product_image' => $saved_image ]);
            }
            // save many rescord
            $product->images()->createMany($images);
            return redirect('product')->with('success', 'Product created sucessfully!');
        }

        return view('Pages/Product/new_product', ['categories'=> $categories]);
    }

    function edit_product(Request $request, $product_id){
        

        $product = Product::with(['images'])->where(['id'=>$product_id])->first();
        
        if($request->isMethod('post')){
            $images = [];
            // validation logic
            $body = $request->validate([
                'category_id' => 'required',
                'product_name' => 'required',
                'amount' => 'required',
                'quantity' => 'required',
                'IsActive' => 'required',
                'product_images.*'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
            ]);
            // save product
            $postBody = [
                'category_id' => $body['category_id'],
                'product_name' => $body['product_name'],
                'amount' => $body['amount'],
                'quantity' => $body['quantity'],
                'IsActive' => $body['IsActive']
            ];
            // product update
            Product::where(['id'=>$product_id])->update($postBody);
            // end
            foreach($body['product_images'] as $image){
                $saved_image = Storage::disk('public')->put('images/product', new File($image));
                array_push($images, [ 'product_image' => $saved_image ]);
            }
            $product->images()->createMany($images);
            return redirect('product')->with('success', 'Product updated successfully!');
        }

        $categories = Category::with('child')->where('parent_id', 0)->OrderBy('category_name')->get();
        return view('Pages/Product/edit_product', ['categories'=> $categories, 'product'=>$product]);
    }

    function deleteProductImage(Request $request, $product_id, $image_id){
        ProductImage::where(['id'=>$image_id])->delete();
        return redirect()->route('edit-product', ['product_id'=>$product_id])->with('success', "Product image deleted successfully!");
    }

    function deleteProduct(Request $request, $product_id){
        Product::where(['id'=>$product_id])->delete();
        return redirect('products')->with('success', "Product deleted successfully!");
        
    }

}

