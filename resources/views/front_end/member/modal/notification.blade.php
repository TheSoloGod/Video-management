<!-- Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModallLabel">Your notifications (Demo)</h5>
                <a class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                @foreach(Auth::user()->unreadNotifications as $notification)
                    <div class="alert alert-info" role="alert">
                        Group {{ $notification->data['group_id'] }} has new video, click
                        <a href="{{ route('member.group.video.all', [Auth::user()->id, $notification->data['group_id']]) }}" class="alert-link"> here</a> to view this one
                        <a class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                @endforeach
            </div>
{{--            <div class="modal-footer">--}}
{{--                <a class="btn btn-secondary" data-dismiss="modal">Close</a>--}}
{{--                <a class="btn btn-primary">Save changes</a>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
