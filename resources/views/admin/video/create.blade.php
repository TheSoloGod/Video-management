@extends('layouts.master')

@section('title')
    Upload new video
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
                        Upload new video
                        @if (Session::has('error'))
                            <div class="alert alert-warning alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ Session::get('error') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('videos.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="">
                                        <div class="text-center">
                                            <img src="{{ asset('storage/preview/preview-default.jpg') }}" class="mb-3"
                                                 style="width: 250px; height: 150px">
                                        </div>
                                        <div class="card card-body">
                                            <table class="table">
                                                <tr>
                                                    <td>Preview:</td>
                                                    <td>
                                                        <input class="form-control" type="file" name="image">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Video:</td>
                                                    <td>
                                                        <input class="form-control" type="file" name="video">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-body">
                                        <table class="table">
                                            <tr>
                                                <td>Title:</td>
                                                <td>
                                                    <input class="form-control" type="text" name="title">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Description:</td>
                                                <td>
                                                    <textarea class="form-control" name="description"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Type:</td>
                                                <td>
                                                    <select class="form-control" name="type">
                                                        <option value="0">Public</option>
                                                        <option value="1">Member</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Display:</td>
                                                <td>
                                                    <select class="form-control" name="is_display">
                                                        <option value="0">Hide</option>
                                                        <option value="1">Show</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <button class="btn btn-primary" type="submit">Upload</button>
                                                </td>
                                            </tr>
                                        </table>
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
