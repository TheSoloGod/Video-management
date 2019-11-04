<div class="sticky-top">
    <div class="card card-body mt-3 mb-5">
        <div style="">
            <div class="text-center mb-3">
                <img src="{{ asset('storage/avatar/' . Auth::user()->image) }}" class="h-75 w-75 border rounded-circle">
            </div>
            <div class="text-center mb-3">
                <h5><strong>{{ Auth::user()->name }}</strong></h5>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="">Trending</a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="">New</a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="">Categories</a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="{{ route('member.group.all', Auth::user()->id) }}">Groups</a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="">Favorites</a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" href="">History</a>
            </div>
        </div>
    </div>
</div>
