<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Advertisement list</title>
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>
@include('header.header')

<body>
    <div id="advertisementList"></div>
    <script type="text/javascript">
        window.postsData = @json($posts);
        window.communityData = @json($community);
    </script>
</body>
@include('footer.footer')

</html>