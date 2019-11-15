@extends('back_end.layouts.master')

@section('title')
    User detail
@endsection

@section('content')
    <div class="container">
        <!-- navbar -->
        @include('back_end.layouts.navbar')

        <div class="row">
            <!-- sidebar -->
            <div class="col-md-2">
                @include('back_end.layouts.sidebar')
            </div>

            <!-- content -->
            <div class="col-md-10">
                <div class="card mt-3">
                    <div class="card-header">
                        User infomation
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card card-body">
                                    <div>
                                        <table class="table">
                                            <tr>
                                                <td>Name:</td>
                                                <td>{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email:</td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone:</td>
                                                <td>{{ $user->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Address:</td>
                                                <td>{{ $user->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Created at:</td>
                                                <td>{{ $user->created_at }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div>
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/avatar/' . $user->image) }}"
                                                 class="border rounded-circle" style="width: 150px; height: 150px">
                                        </div>
                                        <div class="card card-body mb-3">
                                            <div>Groups:</div>
                                            <div>
                                                @foreach($groups as $key => $value)
                                                    <span>
                                                        <a class="badge badge-info"
                                                           href="{{ route('groups.show', $value->group->id) }}">
                                                        {{ $value->group->name }}
                                                        </a>
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div>
                                            <!-- function edit $ delete -->
                                            <span><a href="{{ route('users.edit', $user->id) }}"
                                                     class="btn btn-outline-primary">Edit</a></span>
                                            <span>
                                                <!-- Button trigger modal -->
                                                <a class="btn btn-outline-danger" data-toggle="modal"
                                                   data-target="#deleteModal{{ $user->id }}">Delete</a>
                                            </span>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                                                 role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Delete {{ $user->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to delete this user?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post"
                                                                  action="{{ route('users.destroy', $user->id )}}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-light" role="button">Delete
                                                                </button>
                                                            </form>
                                                            <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
