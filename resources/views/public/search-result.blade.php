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
                @if(Auth::user())
                    @include('layouts.sidebar-member')
                @else
                    @include('layouts.sidebar-public')
                @endif

            </div>

            <!-- content -->
            <div class="col-md-10">

                <!-- Favorite video of user -->
                <div class="card card-body mt-3 mb-5">
                    <div class="mb-3">
                        <strong>Results</strong>
                    </div>
                    <div class="row">
                        @foreach($videos as $key => $value)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center p-0">
                                        <a href="{{ route('public.video.show', [Auth::user()->id, $value->id]) }}">
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
                                    <p style="color: gray">{{ $value->description }}</p>
                                </div>
                            </div>
                        @endforeach

                        @foreach($videos as $key => $value)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center p-0">
                                        <a href="{{ route('public.video.show', [Auth::user()->id, $value->id]) }}">
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
                                    <p style="color: gray">{{ $value->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <div class="float-right">
                            {{ $videos->appends(request()->query()) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')

    </div>
@endsection
