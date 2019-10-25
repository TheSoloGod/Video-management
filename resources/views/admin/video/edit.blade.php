@extends('layouts.master')

@section('title')
    Edit video
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
                        Edit video infomation
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('videos.update', $video->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-body">
                                        <table class="table">
                                            <div class="input-group">
                                                <tr>
                                                    <td>Title:</td>
                                                    <td colspan="2">
                                                        <input class="form-control" type="text" name="title" value="{{ $video->title }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Description:</td>
                                                    <td colspan="2">
                                                        <input class="form-control" type="text" name="description" value="{{ $video->description }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Categories:</td>
                                                    <td colspan="2">Chua biet cach sua</td>
                                                </tr>
                                                <tr>
                                                    <td>Groups:</td>
                                                    <td colspan="2">Chua biet cach sua</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span>Display:</span>
                                                        <span>
                                                            <select class="form-control" name="is_display">
                                                                <option value="{{ $video->is_display }}" selected disabled hidden>
                                                                    @if($video->is_display)
                                                                        On
                                                                    @else
                                                                        Off
                                                                    @endif
                                                                </option>
                                                                <option value="1">On</option>
                                                                <option value="0">Off</option>
                                                            </select>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>Type:</span>
                                                        <span>
                                                            <select class="form-control" name="type">
                                                                <option value="{{ $video->type }}" selected disabled hidden>
                                                                    @if($video->type)
                                                                        Member
                                                                    @else
                                                                        Public
                                                                    @endif
                                                                </option>
                                                                <option value="0">Public</option>
                                                                <option value="1">Member</option>
                                                            </select>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>Status:</span>
                                                        <span>{{ $video->status }}</span>
                                                    </td>
                                                </tr>
                                            </div>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center">
                                        <img src="{{ asset('storage/preview/' . $video->image) }}" style="width: 250px; height: 150px">
                                        <div class="input-group mb-3 mt-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-outline-primary" type="submit">Update</button>
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
