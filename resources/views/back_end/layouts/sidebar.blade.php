<!-- Sidebar -->

<div class="sticky-top">
    <div class="card card-body mt-3 mb-3">
        <div style="">
            <div class="text-center mb-3">
                <img src="{{ asset('storage/avatar/' . Auth::guard('admin')->user()->image) }}" class="h-75 w-75 border rounded-circle">
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
            <div>
                <a class="btn btn-light w-100 mb-2" href="{{ route('categories.index') }}">Categories</a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="{{ route('analytics.index') }}">Statistics</a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="{{ route('admin.logout') }}">Log out</a>
            </div>
        </div>
    </div>
</div>
