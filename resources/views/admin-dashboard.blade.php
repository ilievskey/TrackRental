<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
{{--main--}}
    @include('components.navbar')
<main>
{{--    <div class="container mx-auto px-4">--}}
    <div class="flex">
        <div class="grow-0 p-40" style="border: 10px solid red">
            <div>
                <a href="">Reservations</a>
            </div>
            <div>
                <a href="">Manage Cars</a>
            </div>
            <div>
                <a href="">Manage Users</a>
            </div>
            <div>
                <a href="">Daily message</a>
            </div>
        </div>
        <div class="grow" style="border: 10px solid blue">

        </div>
    </div>
</main>

@include('components.footer')

{{--@vite('resources/js/script.js')--}}
</body>
</html>
