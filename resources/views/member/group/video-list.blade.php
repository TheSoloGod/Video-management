@extends('layouts.master')

@section('title')
    Video+
@endsection

@section('content')
    <div class="container">

        <!-- navbar -->
        @include('layouts.navbar')

        <!-- group info -->
        <div class="card card-body">
            <div class="row text-center">
                <div class="col-md-3">
                    <span>
                        <img class="border rounded-circle" style="width: 30px; height: 30px" src="{{ asset('storage/group/' . $group->image) }}">
                    </span>
                    <span>
                        <strong>{{ $group->name }}</strong>
                    </span>
                </div>
                <div class="col-md-3">
                    <div>
                        <p class="m-0" style="font-size: larger">{{ count($groupVideos) }} videos</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <p class="m-0" style="font-size: larger">{{ count($members) }} members</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dropdown mr-1">
                        <a class="btn btn-outline-secondary dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
                            Option
                            <i class="fas fa-sliders-h"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                            <a class="dropdown-item" href="#">Leave group</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- vidoes -->
        <div class="card mt-5 mb-4">
            <div class="card-body">
                <div class="mb-4">
                    <p>
                        <strong>Recently uploaded</strong>
                    </p>
                </div>
                <div class="row">
                    @foreach($groupVideos as $key => $value)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center p-0">
                                    <a href="{{ route('member.group.video.show', [Auth::user()->id, $group->id, $value->id]) }}">
                                        <img class="w-100" style="height: 140px"
                                             src="{{ asset('storage/preview/' . $value->image ) }}">
                                    </a>
                                </div>
                            </div>
                            <div class="ml-1">
                                <p class="mb-0">
                                    <strong>{{ $value->title }}</strong>
                                </p>
                            </div>
                            <div class="ml-1">
                                <p style="color: gray">{{ $value->description }}</p>
                            </div>
                        </div>
                    @endforeach
                    <div>
                        <span class="float-right">
                            {{ $groupVideos->appends(request()->query()) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Members -->
        <div class="card mb-5">
            <div class="card-body">
                <div class="mb-4">
                    <p>
                        <strong>Members</strong>
                    </p>
                </div>
                <div class="row">
                    @foreach($members as $key => $value)
                        <div class="col-3 text-center">
                            <img class="w-75 border rounded-circle" src="{{ asset('storage/avatar/' . $value->image) }}">
                            <p class="text-center mt-2">{{ $value->name }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')

    </div>
@endsection
