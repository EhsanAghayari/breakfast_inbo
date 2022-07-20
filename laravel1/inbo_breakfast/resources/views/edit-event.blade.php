@extends('layouts.project')


@section('content')
    <div class="row" style="display: block; margin-left: 20px; margin-right: 20px">


        <div class="text-center" style="margin-top: 50px">
            <h1 class="h4 text-gray-900 mb-4">Edit Event!</h1>
        </div>

        <br>

        <form class="user" method="post" action="/editTheEvent/{{$event->id}}"
              style="margin-left: 300px; margin-right: 300px">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <label class="col-form-label" for="description"> Description: </label>
                <textarea type="text"
                       name="description"
                       value="{{old('description')}}"
                       class="form-control form-control-user"
                       id="description"
                       placeholder="{{ $event->description }}"></textarea>
                <span class="text.danger">@error('description'){{$message}} @enderror</span>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="userId">Choose User: </label>
                <select name="userId[]"
                        value="{{old('userId[]')}}"
                        class="custom-select"
                        multiple>
                    <option value="" disabled selected>Select The User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach

                </select>
                <span class="text.danger">@error('userId'){{$message}} @enderror</span>
            </div>

            <div class="form-group">
                <span class="text small -info" style="color: #806520"> (اگر قصد انتخاب امروز را دارید فیلد زیر را دست نخورده رها کنید)</span>
                <br>
                <label class="col-form-label" for="datePicker">Date of Event:</label>
                <input type="date"
                       name="datePicker"
                       placeholder="yyyy-mm-dd">
                <span id="span1"></span>

                <span class="text.danger">@error('datePicker'){{$message}} @enderror</span>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block" value="setRateComment" style="margin-bottom: 50px;">
                Submit Edit
            </button>

        </form>
    </div>
@endsection
