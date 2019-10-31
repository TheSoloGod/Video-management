@extends('layouts.master')

@section('title')
    Category detail
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
                <div class="card">
                    <div class="card-header">
                        Category {{ $category->name }} detail
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-body" style="height: 300px">
                                    <table class="table table-striped">
                                        <tr class="">
                                            <td class="text-center">Name:</td>
                                            <td>{{ $category->name }}</td>
                                        </tr>
                                    </table>
                                    <div class="text-center">
                                        Number videos have this category
                                    </div>
                                    <div class="text-center">
                                        50
                                    </div>
                                    <div class="text-center" style="margin-top: 100px">
                                        <span class="">
                                            <a class="btn btn-outline-primary"
                                               href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                        </span>
                                        <span class="">
                                            <!-- Button trigger modal -->
                                            <a class="btn btn-outline-danger" data-toggle="modal"
                                               data-target="#deleteModal{{ $category->id }}">Delete</a>
                                        </span>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1"
                                             role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Delete {{ $category->name }}</h5>
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
                                                              action="{{ route('categories.destroy', $category->id )}}">
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
                            <div class="col-md-6">
                                <div class="text-center">
                                    <img class="border rounded-circle w-75" style="height: 315px"
                                         src="{{ asset('storage/category/' . $category->image) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
