@extends('layouts.master')

@section('title')
    Video+
@endsection

@section('content')
    <div class="container">

        <!-- navbar -->
        @include('layouts.navbar')

        <div class="row">
            <!-- side bar -->
            <div class="col-md-2">
                @include('layouts.sidebar-member')
            </div>

            <!-- content -->
            <div class="col-md-10">

                <!-- recommended -->
                <div class="card card-body mt-3">
                    <div class="mb-3">
                        <strong>Recommended</strong>
                    </div>
                    <div class="row">
                        @foreach($memberVideos as $key => $value)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center p-0">
                                        <a href="{{ route('home.public.show', $value->id) }}">
                                            <img class="w-100" style="height: 110px" src="{{ asset('storage/preview/' . $value->image ) }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="ml-1">
                                    <p class="mb-0">
                                        <strong>{{ $value->title }}</strong>
                                    </p>
                                </div>
                                <div class="ml-1">
                                    <p style="font-size: small">{{ $value->description }}</p>
                                </div>
                            </div>
                        @endforeach

                        @foreach($memberVideos as $key => $value)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center p-0">
                                        <a href="">
                                            <img class="w-100" style="height: 110px" src="{{ asset('storage/preview/' . $value->image ) }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="ml-1">
                                    <p class="mb-0">
                                        <strong>{{ $value->title }}</strong>
                                    </p>
                                </div>
                                <div class="ml-1">
                                    <p style="font-size: small">{{ $value->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <div class="float-right">
                            {{ $memberVideos->appends(request()->query()) }}
                        </div>
                    </div>
                </div>

                <!-- Recently uploaded -->
                <div class="card card-body mt-3 mb-5">
                    <div class="mb-3">
                        <strong>Recently uploaded</strong>
                    </div>
                    <div class="row">
                        @foreach($allVideos as $key => $value)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center p-0">
                                        <a href="">
                                            <img class="w-100" style="height: 110px" src="{{ asset('storage/preview/' . $value->image ) }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="ml-1">
                                    <p class="mb-0">
                                        <strong>{{ $value->title }}</strong>
                                    </p>
                                </div>
                                <div class="ml-1">
                                    <p style="font-size: small">{{ $value->description }}</p>
                                </div>
                            </div>
                        @endforeach

                        @foreach($allVideos as $key => $value)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center p-0">
                                        <a href="">
                                            <img class="w-100" style="height: 110px" src="{{ asset('storage/preview/' . $value->image ) }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="ml-1">
                                    <p class="mb-0">
                                        <strong>{{ $value->title }}</strong>
                                    </p>
                                </div>
                                <div class="ml-1">
                                    <p style="font-size: small">{{ $value->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <div class="float-right">
                            {{ $allVideos->appends(request()->query()) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')
    </div>
@endsection
