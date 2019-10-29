<!-- Sidebar -->

<div class="sticky-top">
    <div class="card card-body mt-3">
        <div style="">
            <div class="text-center mb-3">
                <img src="{{ asset('storage/avatar/avatar-default.jpg') }}" class="h-75 w-75 border rounded-circle">
            </div>
            <div class="text-center mb-3">
                <h5><strong>{{ Auth::guard('admin')->user()->name }}</strong></h5>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="{{ route('videos.index') }}">Videos</a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="{{ route('users.index') }}">Users</a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="{{ route('groups.index') }}">Groups</a>
            </div>
            <div class="btn btn-light w-100 mb-2">
                Categories
            </div>
            <div class="btn btn-light w-100 mb-2">
                Analytics
            </div>
        </div>
    </div>
</div>
