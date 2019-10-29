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
            <div class="col-md-10">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <p>Users</p>
                                </div>
                                <div class="card-body">
                                    <p>Total users: </p>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <p>Videos</p>
                                </div>
                                <div class="card-body">
                                    <p>Total videos:</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <p>Groups</p>
                                </div>
                                <div class="card-body">
                                    <p>Total groups:</p>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <p>Categories</p>
                                </div>
                                <div class="card-body">
                                    <p>Total categories:</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
