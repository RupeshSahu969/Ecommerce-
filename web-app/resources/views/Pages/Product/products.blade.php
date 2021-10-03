@extends('Layouts.auth_layout')

@section('title')
    Products
@endsection


@section('content')
    <div class="d-flex justify-content-between bd-highlight">
        <h1 class="p-2 h3 text-gray-800">Products</h1>
        <div class="bd-highlight">
            <a href="{{route('new-product')}}" class="btn btn-primary">Add New</a>
        </div>
    </div>
    @include('Shared.Message')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Product List</div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table"  width="100%" cellspacing="0">
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{$product->product_name}}</td>
                                <td>
                                    <img class="img-thumbnail" width="100" src="{{asset("storage/".$product->images[0]['product_image'])}}" alt="">
                                </td>
                                <td>
                                    @if ($product->IsActive == 1)
                                        <button class="btn btn-outline-success btn-sm">Active</button>
                                    @else
                                        <button class="btn btn-outline-warning btn-sm">In active</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('edit-product', ['product_id'=>$product->id])}}" class="btn btn-primary btn-sm"><em class="fas fa-edit"></em></a>
                                    <a href="#" class="btn btn-danger btn-sm"><em class="fas fa-trash"></em></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection