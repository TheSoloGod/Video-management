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

                <!-- Your groups -->
                <div class="card mt-3">
                    <div class="card-header">
                        Your groups
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($groups as $key => $value)
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="">
                                                <img style="width: 150px; height: 150px"
                                                    src="{{ asset('storage/group/' . $value->image) }}">
                                            </a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-center">
                                                {{ $value->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <span class="float-right">
                                {{ $groups->appends(request()->query()) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Other groups -->
                <div class="card mt-3 mb-5">
                    <div class="card-header">
                        Other groups
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($otherGroups as $key => $value)
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="text-center">
                                                {{ $value->name }}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="">
                                                <img style="width: 150px; height: 150px"
                                                     src="{{ asset('storage/group/' . $value->image) }}">
                                            </a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-center">
                                                <a class="btn btn-outline-primary" href="">Join</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <span class="float-right">
                                {{ $otherGroups->appends(request()->query()) }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- footer -->
        @include('layouts.footer')

    </div>
@endsection
