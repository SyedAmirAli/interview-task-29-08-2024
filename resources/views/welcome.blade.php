<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Interview Test | Laravel - Vue Js</title>

        @vite(['resources/js/app.js', 'resources/css/app.css'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script> 
            var apiUrl = "{{ url('/') }}/api"; 
            var asset = (endpoint) => `{{ asset('/') }}${endpoint}`
        </script>
    </head>
    <body id="app">
    </body>
</html>
