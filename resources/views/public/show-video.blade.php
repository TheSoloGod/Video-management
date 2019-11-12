@extends('layouts.master')

@section('title')
    Video+
@endsection

@section('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0&appId=504468856807224&autoLogAppEvents=1"></script>
    <div class="container">

        <!-- navbar -->
        @include('layouts.navbar')

        <div class="row">

            <!-- video -->
            <div class="col-md-7 mt-5">
                <div>
                    <video width="100%" height="auto" controls>
{{--                        <source src="{{ 'https://docs.google.com/uc?id=' . $video->path}}" type="video/mp4">--}}
                        <source src="{{ asset('storage/video/' . $video->name) }}" type="video/mp4">
                    </video>
                </div>
                <div class="card card-body mt-1 mb-3">
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-2 text-center">
                            <div>Views</div>
                            <div>
                                <p class="mb-0"><strong>{{ $video->views }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <div>Favorites</div>
                                    <div>
                                        <p id="totalFavorite" class="mb-0" favorite="{{ $video->favorite }}">
                                            <strong>{{ $video->favorite }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if(Auth::user())
                                        <a class="text-danger" id="favorite" video_id="{{ $video->id }}" user_id="{{ Auth::user()->id }}">
                                            @if($favoriteStatus)
                                                <i class="fas fa-heart" style="font-size: 40px"></i>
                                            @else
                                                <i class="far fa-heart" style="font-size: 40px"></i>
                                            @endif
                                        </a>
                                    @else
                                        <a class="text-danger" data-container="body" data-toggle="popover" data-placement="bottom" data-content="You must login to favorite this video">
                                            <i class="far fa-heart" style="font-size: 40px"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <div class="fb-comments" data-href="http://thesologod.tk/video-{{$video->id}}" data-width="100%" data-order-by="reverse_time" data-numposts="5"></div>
                </div>
            </div>

            <!-- Recommend -->
            <div class="col-md-5">
                <div class="card card-body mt-5 mb-5">
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
        </div>

        <!-- footer -->
        @include('layouts.footer')
    </div>

    <script src="{{ asset('js/favorite.js') }}"></script>

@endsection
