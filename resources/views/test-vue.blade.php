<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>VueJS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
<div id="app">
    <app></app>
</div>
<script src="/js/app.js"></script>
</body>
</html>
