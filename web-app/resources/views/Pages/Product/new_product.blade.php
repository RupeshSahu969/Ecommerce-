@extends('Layouts.auth_layout')

@section('title')
    New Product
@endsection


@section('content')

    @include('Shared.Message')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">New Product</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="categoryLabel">Category</label>
                            <select name="category_id" id="categoryId" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @foreach ($category->child as $subcategory)
                                        <option value="{{$subcategory->id}}">{{$category->category_name}} -> {{$subcategory->category_name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoryLabel">Title</label>
                            <input type="text" name="product_name" value="{{old('product_name')}}" class="form-control" />
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="amountLabel">Amount</label>
                                <input type="number" name="amount" value="{{old('amount')}}" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label for="amountLabel">Quantity</label>
                                <input type="number" name="quantity" value="{{old('quantity')}}" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="statusLabel">Is Active</label>
                                <select name="IsActive" id="IsActive" class="form-control" >
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="productImage">Product Images</label>
                                    <input type="file" name="product_images[]" multiple="true" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary">Create</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection