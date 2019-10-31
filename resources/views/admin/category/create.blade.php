@extends('layouts.master')

@section('title')
    Create new category
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
                        Create new category
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-body" style="height: 375px">
                                        <table class="table table-striped">
                                            <tr class="">
                                                <td class="text-center">Name:</td>
                                                <td>
                                                    <input type="text" name="name" class="form-control" placeholder="Input new category">
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="text-center" style="margin-top: 200px">
                                            <button class="btn btn-outline-primary" type="submit">Create</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center">
                                        <img class="border rounded-circle w-75" style="height: 315px"
                                             src="{{ asset('storage/category/category-default.jpg') }}">
                                    </div>
                                    <div class="mt-3">
                                        <input class="form-control" type="file" name="image">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
