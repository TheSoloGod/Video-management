@extends('layouts.master')

@section('title')
    Video detail
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
                        Video infomation
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/preview/' . $video->image) }}" class="border rounded" style="width: 250px; height: 150px">
                                        </div>
                                        <div class="mb-3">
                                            <span class="border border-primary">
                                                views
                                            </span>
                                            <span class="border border-primary">
                                                favorites
                                            </span>
                                        </div>
                                        <div>
                                            <textarea class="form-control mb-3">comments</textarea>
                                        </div>

                                        @if(!$video->delete_at)
                                        <div>
                                            <!-- function edit $ delete -->
                                            <span><a href="{{ route('videos.edit', $video->id) }}" class="btn btn-outline-primary">Edit</a></span>
                                            <span>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal{{ $video->id }}">Delete</button>
                                            </span>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{ $video->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete {{ $video->title }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to delete this video?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post" action="{{ route('videos.destroy', $video->id )}}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-light" role="button">Delete</button>
                                                            </form>
                                                            <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            <div class="border border-danger">Delete at: {{ $video->delete_at }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card card-body">
                                    <table class="table">
                                        <tr>
                                            <td>Title:</td>
                                            <td>{{ $video->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description:</td>
                                            <td>{{ $video->description }}</td>
                                        </tr>
                                        <tr>
                                            <td>Type:</td>
                                            <td>
                                                @if($video->type)
                                                    Member
                                                @else
                                                    Public
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td>{{ $video->status }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div>Categories:</div>
                                                <div></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div>Groups:</div>
                                                <div></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Created at:</td>
                                            <td>{{ $video->created_at }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
