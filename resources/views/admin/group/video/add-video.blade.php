@extends('layouts.master')

@section('title')
    Group video addition
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
                        Group video addition
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
                                <th scope="col">Title</th>
                                <th scope="col">Type</th>
                                <th scope="col">Display</th>
                                <th scope="col">Function</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($videos as $key => $value)
                                <tr class="text-center">
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>
                                        <img src="{{ asset("storage/preview/" . $value->image ) }}"
                                             class="border rounded" style="width: 50px; height: 30px">
                                    </td>
                                    <td>
                                        <a href="{{ route('videos.show', $value->id) }}">{{ $value->title }}</a>
                                    </td>
                                    <td>
                                        @if($value->type)
                                            Member
                                        @else
                                            Public
                                        @endif
                                    </td>
                                    <td>
                                        @if($value->is_display)
                                            Show
                                        @else
                                            Hide
                                        @endif
                                    </td>
                                    @if(Session::has('additionVideoList'))
                                        @if(array_key_exists($value->id, Session::get('additionVideoList')->videos))
                                            <td>
                                                <div class="btn btn-outline-danger disabled">Add to video list
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                                <a class="btn btn-outline-danger"
                                                   href="{{ route('group.video.add-addition', [$groupId, $value->id]) }}">Add
                                                    to video list</a>
                                            </td>
                                        @endif
                                    @else
                                        <td>
                                            <a class="btn btn-outline-danger"
                                               href="{{ route('group.video.add-addition', [$groupId, $value->id]) }}">Add
                                                to video list</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                            <span>
                                <a class="btn btn-outline-primary" href="{{ route('group.video.all', $groupId) }}">Back</a>
                            </span>
                            <span>
                                <a class="btn btn-outline-info"
                                   href="{{ route('group.video.show-addition', $groupId) }}">Show addition video list</a>
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
