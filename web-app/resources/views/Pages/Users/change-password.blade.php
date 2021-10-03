@extends('Layouts.no_auth_layout')


    @section('title')
    Change Password
    @endsection


@section('content')
    <div class="col-xl-5 col-lg-5 col-md-5">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                        </div>

                        @include('Shared.Message')

                        <form class="user" action="{{route('passwordChange')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <input name="old_password" type="password" class="form-control form-control-user"
                                    id="exampleInputEmail" value="{{ old('old_password') }}"
                                    placeholder="Enter old password">

                                    
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control form-control-user"
                                    id="exampleInputPassword" placeholder="New Password" value="{{ old('new password') }}">
                            </div>
                            <div class="form-group">
                                <input name="confirm_password" type="password" class="form-control form-control-user"
                                    id="exampleInputPassword" placeholder="ConfromPassword" value="{{ old('confrm password') }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Change Password
                            </button>
                        </form>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
