@extends('layouts.master')

@section('title')
    Group video management
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
                        Group video management
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">

                        <div class="row">
                            @foreach($videos as $key => $value)
                                <div class="col-md-3">
                                    <div class="card mb-3">
                                        <div class="card-body text-center p-0">
                                            <a href="{{ route('videos.show', $value->video->id) }}" style="position: relative">
                                                <img class="w-100" style="height: 110px"
                                                     src="{{ asset('storage/preview/' . $value->video->image) }}">
                                                <a class="btn btn-outline-secondary btn-sm text-danger" style="position: absolute; right: 0%" data-toggle="modal"
                                                   data-target="#deleteModal{{ $value->video->id }}">X</a>
                                            </a>
                                        </div>
                                        <div class="card-footer p-0" style="">
                                            <div class="text-center">
                                                {{ $value->video->title }}
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{ $value->video->id }}" tabindex="-1"
                                                 role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Remove {{ $value->video->title }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to remove this video from group?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-light" role="button"
                                                               href="{{ route('group.video.remove', [$value->group->id, $value->video->id]) }}">Remove</a>
                                                            <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <span>
                                <a class="btn btn-outline-primary" href="{{ route('groups.show', $groupId) }}">Back</a>
                            </span>
                            <span>
                                <a class="btn btn-outline-info" href="{{ route('group.video.add', $groupId) }}">Add video</a>
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
