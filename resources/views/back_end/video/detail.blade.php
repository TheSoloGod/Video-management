@extends('back_end.layouts.master')

@section('title')
    Video detail
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
                        Video infomation
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div>
                                    <div class="">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <img src="{{ asset('storage/preview/' . $video->image) }}"
                                                         class="border rounded w-100" style="height: auto">
                                                </div>
                                                <div>
                                                    <div class="border rounded mb-3">
                                                        <div class="">
                                                            Views
                                                        </div>
                                                        <div>
                                                            {{ $video->views }}
                                                        </div>
                                                    </div>
                                                    <div class="border rounded mb-3">
                                                        <div class="">
                                                            Favorites
                                                        </div>
                                                        <div>
                                                            {{ $video->favorite }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                {{--                                                <div id="success">--}}

                                                {{--                                                </div>--}}
                                                <video width="100%" height="auto" controls>
                                                    {{--                                                    <source src="{{ 'https://docs.google.com/uc?id=' . $video->path}}" type="video/mp4">--}}
                                                    <source src="{{ asset('storage/video/' . $video->name) }}"
                                                            type="video/mp4">
                                                </video>
                                            </div>
                                        </div>
                                        <div>
                                            <textarea class="form-control mb-3" style="height: 100px"
                                                      placeholder="View comments here"></textarea>
                                        </div>

                                        @if(!$video->delete_at)
                                            <div>
                                                <!-- function edit $ delete -->
                                                <span><a href="{{ route('videos.edit', $video->id) }}"
                                                         class="btn btn-outline-primary">Edit</a></span>
                                                <span>
                                                <!-- Button trigger modal -->
                                                <a class="btn btn-outline-danger" data-toggle="modal"
                                                   data-target="#deleteModal{{ $video->id }}">Delete</a>
                                            </span>

                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal{{ $video->id }}" tabindex="-1"
                                                     role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Delete {{ $video->title }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure to delete this video?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form method="post"
                                                                      action="{{ route('videos.destroy', $video->id )}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-light" role="button">Delete
                                                                    </button>
                                                                </form>
                                                                <a class="btn btn-secondary"
                                                                   data-dismiss="modal">Close</a>
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

                                        </tr>
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
                                            <td>Display:</td>
                                            <td>
                                                @if($video->is_display)
                                                    Show
                                                @else
                                                    Hide
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td>
                                                @if($video->status == 'upload success')
                                                    <a class="btn btn-success disabled">{{ $video->status }}</a>
                                                @elseif($video->status == 'upload fail')
                                                    <a class="btn btn-danger disabled">{{ $video->status }}</a>
                                                @elseif($video->status == 'uploading')
                                                    <a class="btn btn-warning disabled">{{ $video->status }}</a>
                                                @elseif($video->status == 'not upload')
                                                    <a class="btn btn-info disabled">{{ $video->status }}</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Categories:</td>
                                            <td>
                                                @foreach($categories as $key => $value)
                                                    <span>
                                                        <a class="badge badge-info"
                                                           href="{{ route('categories.show', $value->category->id) }}">
                                                            {{ $value->category->name }}
                                                        </a>
                                                    </span>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Groups:</td>
                                            <td>
                                                @foreach($groups as $key => $value)
                                                    <span>
                                                        <a class="badge badge-info"
                                                           href="{{ route('groups.show', $value->group->id) }}">
                                                            {{ $value->group->name }}
                                                        </a>
                                                    </span>
                                                @endforeach
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
