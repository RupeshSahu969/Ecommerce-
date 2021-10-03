@extends('Layouts.auth_layout')

@section('title')
    Edit Product
@endsection


@section('content')

    @include('Shared.Message')

    <div class="row">
        
        <div class="col-lg-8 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-header">Edit Product</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="categoryLabel">Category</label>
                            <select name="category_id" id="categoryId" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    @if ($category->id == $product->category_id) 
                                        <option selected value="{{$category->id}}">{{$category->category_name}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endif
                                    @foreach ($category->child as $subcategory)
                                        @if ($subcategory->id == $product->category_id)
                                            <option selected value="{{$subcategory->id}}">{{$category->category_name}} -> {{$subcategory->category_name}}</option>
                                        @else
                                            <option value="{{$subcategory->id}}">{{$category->category_name}} -> {{$subcategory->category_name}}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoryLabel">Title</label>
                            <input type="text" name="product_name" value="{{old('product_name', $product->product_name)}}" class="form-control" />
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="amountLabel">Amount</label>
                                <input type="number" name="amount" value="{{old('amount', $product->amount)}}" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label for="amountLabel">Quantity</label>
                                <input type="number" name="quantity" value="{{old('quantity', $product->quantity)}}" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="statusLabel">Is Active</label>
                                <select name="IsActive" id="IsActive" class="form-control" >
                                    @foreach (['Active'=>1, 'Inactive'=>0] as $key => $status_value)
                                    @if ($product->Isactive == $status_value)
                                        <option selected value="{{$status_value}}">{{$key}}</option>
                                    @else
                                        <option value="{{$status_value}}">{{$key}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="productImage">Product Images</label>
                                    <input type="file" name="product_images[]" multiple="true" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary">Update</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    Images
                </div>
                <div class="card-body">
                    @foreach ($product->images as $image)                        
                        <div class="d-flex justify-content-between">
                            <div>
                                <img src="{{asset("storage/".$image->product_image)}}" class="img-thumnail" height='80' alt="Image{{$image->id}}">
                            </div>
                            <div>
                                <a href="{{route('delete-product-image', ['product_id'=>$product->id, 'image_id'=>$image->id])}}" class="btn btn-danger btn-sm mt-3"><em class="fas fa-trash"></em></a>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>

    </div>


@endsection