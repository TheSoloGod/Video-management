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


            <!-- content -->
            <div class="col-md-12">

                <!-- Favorite video of user -->
                <div class="card card-body mt-3 mb-5">
                    <div class="mb-3">
                        <strong>Category name</strong>
                        @if (Session::has('error'))
                            <div class="alert alert-warning alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ Session::get('error') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        @foreach($videos as $key => $value)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center p-0">
                                        @guest
                                            <a href="{{ route('public.video.show', $value->id) }}">
                                                <img class="w-100" style="height: 140px" src="{{ asset('storage/preview/' . $value->image ) }}">
                                            </a>
                                        @else
                                            <a href="{{ route('member.video.show', [Auth::user()->id, $value->id]) }}">
                                                <img class="w-100" style="height: 140px" src="{{ asset('storage/preview/' . $value->image ) }}">
                                            </a>
                                        @endguest
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
