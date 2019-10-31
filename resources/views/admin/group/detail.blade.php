@extends('layouts.master')

@section('title')
    Group detail
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
                        Group infomation
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7 text-center">
                                <div class="card card-body mb-3" style="height: 180px">
                                    <div>
                                        Members:
                                    </div>
                                    <div>
                                        <a class="btn btn-outline-secondary"
                                           href="{{ route('group.member.index', $group->id) }}">Member management</a>
                                    </div>
                                </div>
                                <div class="card card-body" style="height: 180px">
                                    <div>
                                        Videos:
                                    </div>
                                    <div>
                                        <a class="btn btn-outline-secondary" href="">Videos management</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 text-center">
                                <div class="mb-3">
                                    <img class="border rounded-circle" style="width: 250px; height: 250px"
                                         src="{{ asset('storage/group/' . $group->image) }}">
                                </div>
                                <div class="card card-body">
                                    <div>
                                        <div>
                                            <h5><strong>{{ $group->name }}</strong></h5>
                                        </div>
                                        <div>
                                            <!-- function edit & delete -->
                                            <span><a href="{{ route('groups.edit', $group->id) }}"
                                                     class="btn btn-outline-primary">Edit</a></span>
                                            <span>
                                                <!-- Button trigger modal -->
                                                <a class="btn btn-outline-danger" data-toggle="modal"
                                                   data-target="#deleteModal{{ $group->id }}">Delete</a>
                                            </span>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{ $group->id }}" tabindex="-1"
                                                 role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Delete {{ $group->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to delete this groups?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post"
                                                                  action="{{ route('users.destroy', $group->id )}}">
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
