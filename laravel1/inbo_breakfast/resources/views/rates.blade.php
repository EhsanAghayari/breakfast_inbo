@extends('layouts.project')


@section('content')
    <div class="row" style="display: block; margin-left: 20px; margin-right: 20px">


        <div class="text-center" style="margin-top: 50px">
            <h1 class="h4 text-gray-900 mb-4">Rate & Comment this Event</h1>
        </div>

        <br>

        <form class="user" method="post"
              action="{{  route('addTheRate', ['eventId' => $chosenEvent->id]) }}"
              style="margin-left: 300px; margin-right: 300px">
            @if(\Illuminate\Support\Facades\Session::get('fail'))
                <div class="alert alert-danger">
                    {{ \Illuminate\Support\Facades\Session::get('fail') }}
                </div>
            @endif
            @csrf
            <div class="form-group">
                <input type="number" step="0.01"
                       name="rate"
                       value="{{old('rate')}}"
                       class="form-control form-control-user"
                       id="rate"
                       placeholder="Rate this post 0-10">
                <span class="text.danger">@error('rate'){{$message}} @enderror</span>
            </div>
            <div class="form-group">
                <textarea type="text"
                          name="criticism"
                          value="{{old('criticism')}}"
                          class="form-control form-control-user"
                          id="criticism"
                          placeholder="Add a Criticism"></textarea>
                <span class="text.danger">@error('criticism'){{$message}} @enderror</span>
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block" value="setRateComment">
                Submit
            </button>

        </form>


        <!-- DataTales Example -->
        <div class="card shadow mb-4" style="margin-top: 20px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of Rates and Comments
                    for {{$chosenEvent->description}}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="background: hotpink; color: black;text-align: center">
                            <td>Description</td>
                            <td>Performer</td>
                            <td>Date of Event</td>
                            <td colspan="2">Rate</td>
                        </tr>

                        </thead>
                        <tbody>
                        <tr style="background: hotpink; color: black; text-align: center">
                            <td>{{$chosenEvent->description}}</td>
                            @foreach($chosenEvent->users()->get() as $user)
                                {{ $user->username }}
                                @if($user != $chosenEvent->users()->get()->last())
                                    |
                                @endif
                            @endforeach
                            <td style="font-size: 11px">{{$chosenEvent->userList($usernames)}}</td>
                            {{ $chosenEvent->terminator($usernames) }}
                            <td>{{$chosenEvent->carbon($chosenEvent->created_at)}}</td>
                            <td colspan="2">{{$chosenEvent->rating()}}</td>
                        </tr>
                        <tr style="text-align: center">
                            <td>Commenter</td>
                            <td colspan="2">Comment</td>
                            <td>Rate</td>
                        </tr>
                        @foreach($ratesOfEvent as $rate)
                            <tr style="text-align: center">
                                <td>{{$rate->user->username}}</td>
                                <td colspan="2">{{$rate->criticism}}</td>
                                <td style="{{ \App\Models\Event::rateTableColor($rate->rate) }}">{{$rate->rate}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
