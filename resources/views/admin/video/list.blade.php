@extends('layouts.master')

@section('title')
    Videos list
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
                        Videos management
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
{{--                        <video width="320" height="240" controls>--}}
{{--                            <source src="https://docs.google.com/uc?id=1kacnjiNqBrIWp7HKVCWai2nOLGA6uBBE" type="video/mp4">--}}
{{--                        </video>--}}
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Display</th>
                                <th scope="col">Delete at</th>
                                <th scope="col" colspan="2" class="text-center">Function</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($videos as $key => $value)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>
                                        <img src="{{ asset("storage/preview/" . $value->image ) }}" class="border rounded" style="width: 50px; height: 30px">
                                    </td>
                                    <td>
                                        <a href="{{ route('videos.show', $value->id) }}">{{ $value->title }}</a>
                                    </td>
                                    <td>{{ $value->type }}</td>
                                    <td>{{ $value->status }}</td>
                                    <td>{{ $value->is_display }}</td>
                                    <td>{{ $value->delete_at }}</td>

                                    <!-- button edit -->
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{ route('users.edit', $value->id) }}">Edit</a>
                                    </td>

                                    <!-- button delete -->
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal{{ $value->id }}">Delete</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete {{ $value->title }}</h5>
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
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                            <span>
                                <a class="btn btn-outline-primary" href="{{ route('videos.create') }}">Add video</a>
                            </span>
                            <span class="float-right">
                                {{ $videos->appends(request()->query()) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
