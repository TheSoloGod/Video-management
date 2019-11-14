@extends('back_end.layouts.master')

@section('title')
    Categories list
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
                <div class="card mt-3 mb-3">
                    <div class="card-header">
                        Categories management
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($categories as $key => $value)
                                <div class="col-md-2">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h6 class="text-center"><strong>{{ $value->name }}</strong></h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <a href="{{ route('categories.show', $value->id) }}">
                                                <img class="w-100" style="height: 80px"
                                                     src="{{ asset('storage/category/' . $value->image) }}">
                                            </a>
                                        </div>
                                        <div class="card-footer p-2">
                                            <span class="float-left">
                                                <a class="btn btn-outline-primary"
                                                   href="{{ route('categories.edit', $value->id) }}">Edit</a>
                                            </span>
                                            <span class="float-right">
                                                <!-- Button trigger modal -->
                                                <a class="btn btn-outline-danger" data-toggle="modal"
                                                   data-target="#deleteModal{{ $value->id }}">X</a>
                                            </span>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{ $value->id }}" tabindex="-1"
                                                 role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Delete {{ $value->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to delete this category?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post"
                                                                  action="{{ route('categories.destroy', $value->id )}}">
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
                            @endforeach
                        </div>

                        <div>
                            <span class="float-left">
                                <a class="btn btn-outline-primary"
                                   href="{{ route('categories.create') }}">Create new category</a>
                            </span>
                            <span class="float-right">
                                {{ $categories->appends(request()->query()) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        @include('back_end.layouts.footer')
    </div>
@endsection
