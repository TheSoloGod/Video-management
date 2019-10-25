<!-- Sidebar -->

<div>
    <div class="card card-body mt-3">
        <div style="">
            <div style="">
                <img src="{{ asset('storage/avatar/avatar-default.png') }}" class="h-50 w-50 border rounded-circle">
            </div>
            <div>
                <p>{{ Auth::guard('admin')->user()->name }}</p>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="{{ route('videos.index') }}">Videos</a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="{{ route('users.index') }}">Users</a>
            </div>
            <div class="btn btn-light w-100 mb-2">
                Groups
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
