<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin-Panel</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    @viteReactRefresh      
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    @vite('resources/css/panelAdmin.css')

</head>
<body>
<div id="adminPanel"></div>


</body>
</html>
