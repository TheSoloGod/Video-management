@extends('layouts.master')

@section('title')
    Video+
@endsection

@section('content')
    <div class="container">

        <!-- navbar -->
        @include('layouts.navbar')

        <div class="row">
            @foreach($videos as $key => $value)
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body text-center p-0">
                            <a href="{{ route('public.video.show', $value->id) }}">
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

        <!-- footer -->
        @include('layouts.footer')

    </div>
@endsection
