@extends('layouts.master')

@section('title')
    Users list
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
                <div class="card mt-3 mb-3">
                    <div class="card-header">
                        Users management
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
                                <th scope="col" colspan="2">Function</th>
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

                                <!-- button edit -->
                                <td>
                                    <a class="btn btn-outline-primary" href="{{ route('users.edit', $value->id) }}">Edit</a>
                                </td>

                                <!-- button delete -->
                                <td>
                                    <!-- Button trigger modal -->
                                    <a type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal{{ $value->id }}">Delete</a>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete {{ $value->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to delete this user?
                                            </div>
                                            <div class="modal-footer">
                                                <form method="post" action="{{ route('users.destroy', $value->id )}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-light" role="button">Delete</button>
                                                </form>
                                                <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
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
