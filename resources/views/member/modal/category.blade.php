<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Choose category</h5>
                <a class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($categories as $key => $value)
                        <div class="col-2 text-center">
                            <a class="btn btn-outline-info" href="{{ route('category.filter', $value->id) }}">{{ $value->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
{{--            <div class="modal-footer">--}}
{{--                <a class="btn btn-outline-primary">Search</a>--}}
{{--                <a class="btn btn-outline-secondary" data-dismiss="modal">Close</a>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
