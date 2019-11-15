<!-- navbar -->
<div class="">
    <nav class="navbar navbar-expand-lg navbar-light border rounded" style="background-color: #EEEEEE">
        <a class="navbar-brand"><strong>Video Management System</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.over-view') }}">Home <span
                            class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <a class="btn btn-outline-info my-2 my-sm-0"
                   data-container="body" data-toggle="popover" data-placement="bottom"
                   data-content="developing feature">
                    Search
                </a>
            </form>
        </div>
    </nav>
</div>
