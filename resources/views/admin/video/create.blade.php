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
{{--                        <a class="btn btn-outline-danger" href="{{ route('test') }}">test</a>--}}
                        @if (Session::has('error'))
                            <div class="alert alert-warning alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ Session::get('error') }}</strong>
                            </div>
                        @endif
                        @if($errors->any())
                            <div>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li style="color: red">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                     role="progressbar" aria-valuenow=""
                                                     aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="status" class="w-100 text-center">
                                                        <img src="{{ asset('storage/preview/preview-default.jpg') }}" class="w-100">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <form id="uploadForm" method="post"
                                                  action="{{ route('admin.video.upload') }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <input type="file" name="video" id="file" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <span>
                                                            <button type="submit" name="upload" id="upload"
                                                                    class="btn btn-outline-primary">Upload</button>
                                                        </span>
                                                        <span>
                                                            <a class="btn btn-outline-danger" href=""
                                                               id="cancel">Cancel</a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="uploadInfoVideoSuccess" class="text-center" hidden>
                                        <div class="alert alert-success alert-block mt-3">
                                            Upload video infomation success
                                        </div>
                                        <a class="btn btn-outline-success" href="{{ route('videos.index') }}" target="_blank">Show videos list</a>
                                    </div>
                                    <div id="uploadInfoVideoError" class="text-center" hidden>
                                        <div class="alert alert-danger alert-block mt-3">
                                            Title and description are required
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <form id="formInfoVideo" method="post" action="" enctype="multipart/form-data">
                                    @csrf
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
                                                <td>Category:</td>
                                                <td>
                                                    <input id="category" name="category">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Group:</td>
                                                <td>
                                                    <input id="group" name="group">
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
                                                <td>Thumbnail:</td>
                                                <td>
                                                    <input class="form-control" type="file" name="image">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <button id="formInfoVideoSubmit" class="btn btn-outline-info" type="submit" name="create">
                                                        Upload Info
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/upload/jquery.form.js') }}"></script>
    <script src="{{ asset('js/tokenInput/jquery.tokeninput.js') }}"></script>
    <script src="{{ asset('admin/video/js/video.create.upload.js') }}"></script>
    <script>
        $(document).ready(function ($) {
            $("#category").tokenInput("{{asset('api/categories?q=categories')}}", {
                hintText: 'Choose category for this video',
                noResultsText: "Not found category",
                searchingText: 'Searching...',
                theme: 'facebook',
                preventDuplicates: true,
                prePopulate: '',
            });

            $("#group").tokenInput("{{asset('api/groups?q=groups')}}", {
                hintText: 'Choose group for this video',
                noResultsText: "Not found group",
                searchingText: 'Searching...',
                theme: 'facebook',
                preventDuplicates: true,
                prePopulate: '',
            });
        });
    </script>
@endsection
