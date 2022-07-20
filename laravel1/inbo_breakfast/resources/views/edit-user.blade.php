@extends('layouts.project')


@section('content')
    <div class="row" style="display: block; margin-left: 20px; margin-right: 20px">


        <div class="text-center" style="margin-top: 50px">
            <h1 class="h4 text-gray-900 mb-4">Edit User!</h1>
        </div>

        <br>

        <form class="user" method="post" action="/editTheUser/{{$user->id}}" enctype="multipart/form-data"
              style="margin-left: 300px; margin-right: 300px">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <label class="col-form-label" for="username"> Username: </label>
                <input type="text"
                       name="username"
                       value="{{old('username')}}"
                       class="form-control form-control-user"
                       id="username"
                       placeholder="{{ $user->username }}">
                <span class="text.danger">@error('username'){{$message}} @enderror</span>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="password"> Password: </label>
                <input type="password"
                       name="password"
                       value="{{old('password')}}"
                       class="form-control form-control-user"
                       id="password"
                       placeholder="{{ $user->password }}">
                <span class="text.danger">@error('password'){{$message}} @enderror</span>
            </div>
            <div class="form-group">

                <input type="checkbox"
                       name="isAdmin"
                       value="{{old('isAdmin')}}"
                       class="custom-checkbox"
                       id="isAdmin">
                <label class="col-form-label" for="isAdmin">  Admin ? </label>
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

            <button type="submit" class="btn btn-primary btn-user btn-block" value="setRateComment" style="margin-top: 20px">
                Submit Edit
            </button>

        </form>
    </div>
@endsection
