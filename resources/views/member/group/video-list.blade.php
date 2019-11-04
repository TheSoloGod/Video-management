@extends('layouts.master')

@section('title')
    Video+
@endsection

@section('content')
    <div class="container">

        <!-- navbar -->
        @include('layouts.navbar')

        <!-- content -->
        <div class="card mt-5 mb-5">
            <div class="card-header">
                <p>
                    <strong>Recently uploaded</strong>
                </p>
            </div>
            <div class="card-body">
                <div class="row">
            @foreach($groupVideos as $key => $value)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center p-0">
                            <a href="{{ route('member.video.show', [Auth::user()->id, $value->id]) }}">
                                <img class="w-100" style="height: 130px" src="{{ asset('storage/preview/' . $value->image ) }}">
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

                @foreach($groupVideos as $key => $value)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center p-0">
                                <a href="{{ route('member.video.show', [Auth::user()->id, $value->id]) }}">
                                    <img class="w-100" style="height: 130px" src="{{ asset('storage/preview/' . $value->image ) }}">
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

                @foreach($groupVideos as $key => $value)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center p-0">
                                <a href="{{ route('member.video.show', [Auth::user()->id, $value->id]) }}">
                                    <img class="w-100" style="height: 130px" src="{{ asset('storage/preview/' . $value->image ) }}">
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

        <!-- footer -->
        @include('layouts.footer')

    </div>
@endsection
