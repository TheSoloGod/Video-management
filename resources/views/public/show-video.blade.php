@extends('layouts.master')

@section('title')
    Video+
@endsection

@section('content')
    <div class="container">

        <!-- navbar -->
        @include('layouts.navbar')

        <div class="row">

            <!-- video -->
            <div class="col-md-7 mt-5">
                <div>
                    <video width="100%" height="auto" controls>
                        <source src="{{ 'https://docs.google.com/uc?id=' . $video->path}}" type="video/mp4">
                    </video>
                </div>
                <div class="card card-body mt-1 mb-3">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="">
                                <p class="mb-0">
                                    <strong>{{ $video->title }}</strong>
                                </p>
                            </div>
                            <div class="">
                                <p class="mb-0" style="color: gray">
                                    {{ $video->description }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-6">
                                    <div>Favorites</div>
                                    <div class="text-center">
                                        <p class="mb-0"><strong>50</strong></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <a class="text-danger" href="">
                                        <i class="far fa-heart" style="font-size: 40px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <textarea class="form-control" style="height: 200px" placeholder="View comments here"></textarea>
                </div>
            </div>

            <!-- Recommend -->
            <div class="col-md-5 mt-5 mb-5">

                <div class="mb-3">
                    <strong>Up next</strong>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="card card-body p-0 w-100 ">
                            <a href="{{ route('public.video.show', $video->id) }}">
                                <img class="w-100" style="height: 110px" src="{{ asset('storage/preview/' . $video->image ) }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-6 p-0">
                        <div>
                            <p class="mb-0">
                                <strong>{{ $video->title }}</strong>
                            </p>
                        </div>
                        <div>
                            <p style="color: gray">{{ $video->description }}</p>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="mb-3">
                    <strong>Recommended</strong>
                </div>
                @foreach($recommendedVideos as $key => $value)
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="card card-body p-0 w-100 ">
                                <a href="{{ route('public.video.show', $value->id) }}">
                                    <img class="w-100" style="height: 110px" src="{{ asset('storage/preview/' . $value->image ) }}">
                                </a>
                            </div>
                        </div>
                        <div class="col-6 p-0">
                            <div>
                                <p class="mb-0">
                                    <strong>{{ $value->title }}</strong>
                                </p>
                            </div>
                            <div>
                                <p style="color: gray">{{ $value->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')
    </div>
@endsection
