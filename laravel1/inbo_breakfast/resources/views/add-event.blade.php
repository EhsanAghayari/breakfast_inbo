@extends('layouts.project')


@section('content')
    <div class="row" style="display: block; margin-left: 20px; margin-right: 20px">


        <div class="text-center" style="margin-top: 50px">
            <h1 class="h4 text-gray-900 mb-4">Add Event!</h1>
        </div>

        <br>

        <form class="user" method="POST" action="{{ route('addTheEvent') }}"
              style="margin-left: 300px; margin-right: 300px">
            @csrf
            <div class="form-group">
                <label class="col-form-label" for="description"> Description: </label>
                <textarea type="text"
                          name="description"
                          value="{{old('description')}}"
                          class="form-control form-control-user"
                          id="description"
                          placeholder="Enter Breakfast Description Here"></textarea>
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

               {{-- <div id="userId" class="dropdown-check-list" tabindex="100">
                    <span class="anchor">Select Users</span>
                    <ul class="items" name="usersId[]">
                        @foreach($users as $user)
                        <li><input type="checkbox" value="{{ $user->id }}"/>{{ $user->username }}</li>
                        @endforeach
                    </ul>
                </div>

                <script>
                    var checkList = document.getElementById('userId');
                    checkList.getElementsByClassName('anchor')[0].onclick = function(evt) {
                        if (checkList.classList.contains('visible'))
                            checkList.classList.remove('visible');
                        else
                            checkList.classList.add('visible');
                    }
                </script>--}}
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
        <!--            <div class="form-group">
                <label class="col-form-label" for="user">Choose User: </label>
                <div class="multipleSelection">
                    <div class="form-select" onclick="showCheckboxes()">
                <select>
                    <option value="" disabled selected>Select The User</option>
                </select>
                    <div class="overSelect"></div>
                    </div>
                    <div id="checkBoxes">
                    @foreach($users as $user)
            <label for="first">
                <input type="checkbox" id="{{$user->id}}" value="{{$user->id}}" class="custom-checkbox"/>
                                {{ $user->username }}
                </label>
@endforeach
            </div>

    </div>
    </div>-->


            <button type="submit" class="btn btn-primary btn-user btn-block" value="setRateComment">
                Add It!
            </button>

        </form>

        <!--        <script>
                    var show = true;

                    function showCheckboxes() {
                        var checkboxes =
                            document.getElementById("checkBoxes");

                        if (show) {
                            checkboxes.style.display = "block";
                            show = false;
                        } else {
                            checkboxes.style.display = "none";
                            show = true;
                        }
                    }
                </script>-->

        <div class="row" style="display: block; margin-top: 100px; margin-left: 10px; margin-right: 10px">

            <div class="text-center" style="margin-top: 50px">
                <h1 class="h4 text-gray-900 mb-4">Events List</h1>
            </div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Events List</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr style="text-align: center">
                                <td>Description</td>
                                <td>Performer</td>
                                <td>Date of Event</td>
                                <td>Rate</td>
                                <td>Edit</td>
                                <td>Delete!</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr style="text-align: center">
                                    <td>{{$event->description}}</td>

                                    <td style="font-size: 11px"> @foreach($event->users()->get() as $user)
                                            {{ $user->username }}
                                            @if($user != $event->users()->get()->last())
                                                |
                                            @endif
                                        @endforeach</td>

                                    <td>{{$event->carbon($event->created_at)}}</td>
                                    <td>{{$event->rating()}}</td>
                                    <td>
                                        <form method="post" action="/editEvent/{{$event->id}}">
                                            @csrf
                                            <button type="submit" class="btn btn-facebook btn-block">Edit Event!
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="/deleteEvent/{{$event->id}}">
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
