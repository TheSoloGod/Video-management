<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
</head>
<body>
<h1 class="text-center">Report {{$date}}</h1>
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Video ID</th>
        <th>Video Title</th>
        <th>Today Views</th>
        <th>Yesterday Views</th>
        <th>View Rate</th>
    </tr>
    </thead>
    <tbody>
    @foreach($allVideoViewHistory as $key => $value)
        <tr>
            <th>{{ ++$key }}</th>
            <td>{{ $value->id }}</td>
            <td>{{ $value->video->title }}</td>
            <td>{{ $value->today_views }}</td>
            <td>{{ $value->yesterday_views }}</td>
            <td>{{ $value->view_rate }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
