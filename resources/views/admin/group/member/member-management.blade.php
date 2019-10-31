@extends('layouts.master')

@section('title')
    Group member management
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
                        Group member management
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
                            @foreach($members as $key => $value)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>
                                        <img src="{{ asset("storage/avatar/" . $value->user->image ) }}"
                                             class="border rounded-circle" style="width: 30px; height: 30px">
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', $value->user_id) }}">{{ $value->user->name }}</a>
                                    </td>
                                    <td>{{ $value->user->email }}</td>
                                    <td>{{ $value->user->phone }}</td>
                                    <td>{{ $value->user->address }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                data-target="#deleteModal{{ $value->user->id }}">
                                            @if(!$invited)
                                                Remove
                                            @else
                                                Cancel invitation
                                            @endif
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $value->user->id }}" tabindex="-1"
                                             role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Remove {{ $value->user->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure to remove this member from group?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-light" role="button"
                                                           href="{{ route('group.member.remove', [$value->group->id, $value->user->id]) }}">Remove</a>
                                                        <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                            <span>
                                <a class="btn btn-outline-primary" href="{{ route('groups.show', $groupId) }}">Back</a>
                            </span>
                            @if(!$invited)
                                <span>
                                    <a class="btn btn-outline-info" href="{{ route('group.member.add', $groupId) }}">Add member</a>
                                </span>
                                <span>
                                    <a class="btn btn-outline-secondary"
                                       href="{{ route('group.member.invited', $groupId) }}">Invited list</a>
                                </span>
                                <span class="float-right">
                                    {{ $members->appends(request()->query()) }}
                                </span>
                            @else
                                <span>
                                    <a class="btn btn-outline-info" href="{{ route('group.member.all', $groupId) }}">Show all members</a>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
