@extends('layouts.master')

@section('title')
    Group member invitation
@endsection

@section('content')
    <div class="container">
        <!-- navbar -->
        @include('admin.layouts.navbar')

        <div class="row">
            <!-- sidebar -->
            <div class="col-md-2">
                @include('admin.layouts.sidebar')
            </div>

            <!-- content -->
            <div class="col-md-10">
                <div class="card mt-3">
                    <div class="card-header">
                        Group member invitation
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Function</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $value)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>
                                        <img src="{{ asset("storage/avatar/" . $value->image ) }}" class="border rounded-circle" style="width: 30px; height: 30px">
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', $value->id) }}">{{ $value->name }}</a>
                                    </td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td>{{ $value->address }}</td>
                                    @if(Session::has('invitationList'))
                                        @if(array_key_exists($value->id, Session::get('invitationList')->users))
                                            <td>
                                                <div class="btn btn-secondary">Add to invitation list</div>
                                            </td>
                                        @else
                                            <td>
                                                <a class="btn btn-outline-danger" href="{{ route('group.member.add-invitation', [$groupId, $value->id]) }}">Add to invitation list</a>
                                            </td>
                                        @endif
                                    @else
                                        <td>
                                            <a class="btn btn-outline-danger" href="{{ route('group.member.add-invitation', [$groupId, $value->id]) }}">Add to invitation list</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>

                            <span>
                                <a class="btn btn-outline-primary" href="{{ route('group.member.show-invitation', $groupId) }}">Show invitaiton list</a>

                                <!-- Button trigger modal -->
{{--                                <a class="btn btn-outline-primary" data-toggle="modal" data-target="#deleteModal{{ $value->id }}">Show invitaiton list</a>--}}

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Invitation list of group {{ $groupId }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <td>Id</td>
                                                                    <td>Name</td>
                                                                    <td>Email</td>
                                                                    <td>Function</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(Session::has('invitationList'))
                                                                    @foreach(Session::get('invitationList')->users as $key => $user)
                                                                        <tr class="text-center">
                                                                            <td>{{ ++$key }}</td>
                                                                            <td>{{ $user->name }}</td>
                                                                            <td>{{ $user->email }}</td>
                                                                            <td>
                                                                                <a class="btn btn-outline-danger" href="">Remove</a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-primary" role="button" href="">Send invite email</a>
                                                    <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </span>
                            <span class="float-right">
                                {{ $users->appends(request()->query()) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
