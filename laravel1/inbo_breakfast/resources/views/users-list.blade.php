@extends('layouts.project')


@section('content')
    <div class="row" style="display: block; margin-left: 20px; margin-right: 20px">
        <br>

        <div class="row" style="display: block; margin-left: 10px; margin-right: 10px">
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
