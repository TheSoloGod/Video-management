@extends('layouts.master')

@section('title')
    Invitation list
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
                        Invitation list of group {{ $groupId }}
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(Session::has('invitationList'))
                            <form>
                                <table class="table table-striped">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Function</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(Session::get('invitationList')->users as $key => $user)
                                            <tr class="text-center">
                                                <th>{{ ++$key }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <a class="btn btn-outline-danger" href="{{ route('group.member.remove-invitation', [$groupId ,$user->id]) }}">Remove</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                            <div>
                                <span>
                                    <!-- Button trigger modal -->
                                    <a class="btn btn-outline-primary" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">Invite all user in list</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Invitation list of group {{ $groupId }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure to send invitation email to all user in list?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-primary" role="button" href="{{ route('group.member.invite', $groupId) }}">Send invitation email</a>
                                                        <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </span>
    {{--                            <span class="float-right">--}}
    {{--                                {{ $users->appends(request()->query()) }}--}}
    {{--                            </span>--}}
                            </div>
                        @else
                            <div class="text-center">
                                There are no users in this invitation list! Please add someone
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
