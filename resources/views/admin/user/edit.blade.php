@extends('layouts.master')

@section('title')
    User edit form
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
                    <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            Update user infomation
                            @if($errors->any())
                                <div>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li style="color: red;">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="card card-body">
                                        <div>
                                            <table class="table">
                                                <div class="input-group">
                                                    <tr>
                                                        <td>Name:</td>
                                                        <td>
                                                            <input class="form-control" type="text" name="name"
                                                                   value="{{ $user->name }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email:</td>
                                                        <td>
                                                            <input class="form-control" value="{{ $user->email }}"
                                                                   readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone:</td>
                                                        <td>
                                                            <input class="form-control" type="text" name="phone"
                                                                   value="{{ $user->phone }}">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address:</td>
                                                        <td>
                                                            <input class="form-control" type="text" name="address"
                                                                   value="{{ $user->address }}"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="text-center">
                                                            <button type="submit" class="btn btn-primary">Update
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </div>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div>
                                        <div class="text-center">
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/avatar/' . $user->image) }}"
                                                     class="border rounded-circle" style="width: 150px; height: 150px">
                                                <div class="input-group mb-3 mt-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input"
                                                               id="inputGroupFile01">
                                                        <label class="custom-file-label" for="inputGroupFile01">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">Groups:</div>
                                                <div class="card-body">
                                                    <div>
                                                        @foreach($groups as $key => $value)
                                                            <span>
                                                        <a class="badge badge-info" href="{{ route('groups.show', $value->group->id) }}">
                                                        {{ $value->group->name }}
                                                        </a>
                                                    </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <a class="btn btn-outline-warning">Set Admin</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
