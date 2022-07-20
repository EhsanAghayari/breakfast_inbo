@extends('layouts.project')


@section('content')
    <div class="row" style="display: block; margin-left: 20px; margin-right: 20px">


        <div class="text-center" style="margin-top: 50px">
            <h1 class="h4 text-gray-900 mb-4">Create User!</h1>
        </div>

        <br>

        <form class="user" method="post" action="{{ route('signUser1') }}" enctype="multipart/form-data"
              style="margin-left: 300px; margin-right: 300px">
            @if(\Illuminate\Support\Facades\Session::get('fail'))
                <div class="alert alert-danger">
                    {{ \Illuminate\Support\Facades\Session::get('fail') }}
                </div>
            @endif
            @csrf
            <div class="form-group">
                <label class="col-form-label" for="username"> Username: </label>
                <input type="text"
                       name="username"
                       value="{{old('username')}}"
                       class="form-control form-control-user"
                       id="username"
                       placeholder="Enter Username Here">
                <span class="text.danger">@error('username'){{$message}} @enderror</span>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="password"> Password: </label>
                <input type="password"
                       name="password"
                       value="{{old('password')}}"
                       class="form-control form-control-user"
                       id="password"
                       placeholder="Enter Password Here">
                <span class="text.danger">@error('password'){{$message}} @enderror</span>
            </div>
            <div class="form-group">

                <input type="checkbox"
                       name="isAdmin"
                       value="{{old('isAdmin')}}"
                       class="custom-checkbox"
                       id="isAdmin">
                <label class="col-form-label" for="isAdmin"> Admin ? </label>
                <span class="text.danger">@error('isAdmin'){{$message}} @enderror</span>
            </div>

            <div class="">
                <label class="col-form-label" for="avatar"> Profile Image:
                    <span class="text small -info" style="color: #806520"> * Not Required</span>
                </label>
                <input type="file"
                       name="avatar"
                       value="{{old('avatar')}}"
                       class="form-control-file"
                       id="avatar"
                       placeholder="Add Profile Image">

                <span class="text.danger">@error('avatar'){{$message}} @enderror</span>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block" value="setRateComment"
                    style="margin-top: 20px">
                Add This User
            </button>

        </form>

        <div class="row" style="display: block; margin-top: 100px; margin-left: 10px; margin-right: 10px">

            <div class="text-center" style="margin-top: 50px">
                <h1 class="h4 text-gray-900 mb-4">Users List</h1>
            </div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr style="text-align: center">
                                <td>Image</td>
                                <td>Username</td>
                                <td>Date Added</td>
                                <td>Events Performed</td>
                                <td>Events / Time</td>
                                <td>Is Admin?</td>
                                <td>Edit</td>
                                <td>Delete!</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr style="text-align: center">
                                    <td><img class="img-profile rounded-circle" width="30px;"
                                             src="/images/{{$user->avatar_path}}" alt=""></td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->carbon($user->created_at)}}</td>

                                    <td>{{ count($user->events()->get()) }}</td>

                                    <td>{{ $user->performPerTime(count($user->events()->get())) }}</td>

                                    <td>
                                        @if($user->is_admin == 1)
                                            Admin
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <form method="post" action="/editUser/{{$user->id}}">
                                            @csrf
                                            <button type="submit" class="btn btn-facebook btn-block">Edit User!
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="/deleteUser/{{$user->id}}">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-google btn-block">Delete!</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
