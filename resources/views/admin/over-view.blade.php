@extends('layouts.master')

@section('title')
    Over view
@endsection

@section('content')
    <div class="container">

        <!-- navbar -->
        @include('admin.layouts.navbar')

        <div class="row">
            <!-- side bar -->
            <div class="col-md-2">
                @include('admin.layouts.sidebar')
            </div>

            <!-- content -->
            <div class="col-md-10 mb-3">
                <div class="card card-body mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    Users
                                </div>
                                <div class="card-body text-center">
                                    <p>Total users: </p>
                                    <h1>{{ $totalArray[0] }}</h1>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    Videos
                                </div>
                                <div class="card-body text-center">
                                    <p>Total videos:</p>
                                    <h1>{{ $totalArray[2] }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    Groups
                                </div>
                                <div class="card-body text-center">
                                    <p>Total groups:</p>
                                    <h1>{{ $totalArray[1] }}</h1>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    Categories
                                </div>
                                <div class="card-body text-center">
                                    <p>Total categories:</p>
                                    <h1>{{ $totalArray[3] }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        @include('admin.layouts.footer')
    </div>
@endsection
