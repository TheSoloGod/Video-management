@extends('layouts.master')

@section('title')
    Addition video list
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
                        Addition video list of group {{ $groupId }}
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(Session::has('additionVideoList'))
                            <form>
                                <table class="table table-striped">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Function</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Session::get('additionVideoList')->videos as $key => $value)
                                        <tr class="text-center">
                                            <th>{{ $key }}</th>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->description }}</td>
                                            <td>
                                                <a class="btn btn-outline-danger"
                                                   href="{{ route('group.video.remove-addition', [$groupId ,$value->id]) }}">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </form>
                            <div>
                                <span>
                                    <!-- Button trigger modal -->
                                    <a class="btn btn-outline-primary" data-toggle="modal"
                                       data-target="#deleteModal{{ $groupId }}">Add all video in list to group</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $groupId }}" tabindex="-1" role="dialog"
                                         aria-labelledby="deleteModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Addition video list of group {{ $groupId }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure to add all video in list to group?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-primary" role="button"
                                                           href="{{ route('group.video.add-confirm', $groupId) }}">Add</a>
                                                        <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </span>
                                {{--                            <span class="float-right">--}}
                                {{--                                {{ $videos->appends(request()->query()) }}--}}
                                {{--                            </span>--}}
                            </div>
                        @else
                            <div class="text-center mb-3">
                                There are no video in this addition list! Please add some video
                            </div>
                            <div class="text-center">
                                <a class="btn btn-outline-primary" href="{{ route('group.video.add', $groupId) }}">Back</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
