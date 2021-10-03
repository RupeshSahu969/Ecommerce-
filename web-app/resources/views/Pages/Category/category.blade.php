@extends('Layouts.auth_layout')

@section('title')
    Category
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Category</h1>

    @include('Shared.Message')

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">New Category</div>
                <div class="card-body">
                    <form method="post" action="{{route('new-category')}}" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label for="categoryNameLabel">Parent Category</label>
                            <select name="parent_id" class="form-control" id="cateoryParentId">
                                <option value="">Select Parent</option>
                                <option value="0">Parent</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="categoryNameLabel">Category Name</label>
                            <input name="category_name" value="{{old('category_name')}}" type="text" class="form-control" placeholder="Category Name" />
                        </div>
                        <div class="form-group">
                            <label for="imageTitle ">Category Image</label>
                            <input type="file" class="form-control"  name="image" id="imageId" />
                        </div>
                        <div class="form-group">
                            <label for="statusTitle ">Status</label>
                            <select name="IsActive" id="IsActiveId" class="form-control">
                                <option value="1" >Active</option>
                                <option value="0" >Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Create</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">Category</div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td><img src="{{asset("storage/$category->image")}}"   alt="{{$category->category_name}}" class="img-thumbnail" width="100" /></td>
                                    <td>{{$category->category_name}}</td>
                                    
                                    <td>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                @foreach ($category->child as $subcategory)
                                    <tr>
                                        <td><img src="{{asset("storage/$subcategory->image")}}"  alt="{{$category->category_name}}" class="img-thumbnail" width="100" /></td>
                                        <td> <span class="text-primary font-weight-bold">{{$category->category_name}}</span> -> {{$subcategory->category_name}}</td>
                                        <td>
                                            
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                              @endforeach
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>
@endsection