@extends('Layouts.no_auth_layout')

@section('title')
    Register
@endsection

@section('content')
<div class="col-xl-10 col-lg-10 col-md-10">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>

                        @include('Shared.Message')

                        <form class="user" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input name="first_name" type="text" class="form-control form-control-user" id="exampleFirstName"
                                        placeholder="First Name" value="{{ old('first_name') }}">
                                </div>
                                <div class="col-sm-6">
                                    <input name="last_name" type="text" class="form-control form-control-user" id="exampleLastName"
                                        placeholder="Last Name" value="{{ old('last_name') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email Address" value="{{ old('email') }}">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input name="password" type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password">
                                </div>
                                <div class="col-sm-6">
                                    <input name="confirm_password" type="password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Repeat Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="address" id="addressId" class="form-control" placeholder="address" rows="5" value="{{ old('address') }}"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                            <hr>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
