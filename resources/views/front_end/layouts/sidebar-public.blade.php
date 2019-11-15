<div class="sticky-top">
    <div class="card card-body mt-3">
        <div style="">
            <div class="text-center mb-3">
                <img src="{{ asset('storage/avatar/avatar-default.jpg') }}" class="h-75 w-75 border rounded-circle">
            </div>
            <div class="text-center mb-3">
                <h5><strong>Guest</strong></h5>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2"
                   data-container="body" data-toggle="popover" data-placement="right" data-content="developing feature">
                    Trending
                </a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2"
                   data-container="body" data-toggle="popover" data-placement="right" data-content="developing feature">
                    New videos
                </a>
            </div>
            <div>
                <a class="btn btn-light w-100 mb-2" data-toggle="modal" data-target="#categoryModal">Categories</a>
            </div>
        </div>
    </div>
</div>
@include('front_end.member.modal.category')
