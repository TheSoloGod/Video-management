@extends('back_end.layouts.master')

@section('title')
    Views statistics
@endsection

@section('content')
    <div class="container">

        <!-- navbar -->
        @include('back_end.layouts.navbar')

        <div class="row">
            <!-- sidebar -->
            <div class="col-md-2">
                @include('back_end.layouts.sidebar')
            </div>

            <!-- content -->
            <div class="col-md-10">
                <div class="card mt-3 mb-3">
                    <div class="card-header">
                        <span>Views statistic</span>

                        <form method="post" action="{{ route('analytics.search.date') }}" class="float-right">
                            @csrf
                            <span class="input-group">
                                <span><input type="date" name="date" class="form-control"></span>
                                <span>
                                    <button type="submit" class="btn btn-outline-info" style="border-radius: 0px 25px 25px 0px">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </span>
                            </span>
                        </form>
                        <span class="float-right"><a class="btn btn-outline-info" href="{{ route('analytics.index') }}" style="border-radius: 25px 0px 0px 25px">View all</a></span>
                        @if (session('status'))
                            <div class="alert alert-success mt-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger mt-4" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Video</th>
                                        <th>Views</th>
                                        <th>Views before</th>
                                        <th>View rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($allVideoViewHistory) == 0)
                                        <tr class="text-center"><td colspan="6"><p>No body saw any video in this day!</p></td></tr>
                                    @endif
                                    @foreach($allVideoViewHistory as $key => $value)
                                        <tr class="text-center">
                                            <th>{{ ++$key }}</th>
                                            <td>{{ $value->date }}</td>
                                            <td><a href="{{ route('videos.show', $value->video->id) }}">{{ $value->video->title }}</a></td>
                                            <td>{{ $value->today_views }}</td>
                                            <td>{{ $value->yesterday_views }}</td>
                                            <td>{{ $value->view_rate }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <span class="float-left">
                                <a class="btn btn-outline-primary"
                                   href="{{ route('analytics.export.excel', $date) }}">Download</a>
                            </span>
                            <span class="float-right">
                                {{ $allVideoViewHistory->appends(request()->query()) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        @include('back_end.layouts.footer')
    </div>
@endsection
