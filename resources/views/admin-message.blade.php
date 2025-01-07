<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
{{--main--}}
<header>
    @include('layouts.navigation')
</header>
<main class="flex flex-row h-screen">
    {{--        sidebar--}}
    <div class="w-1/4 min-w-32" style="border: 10px solid red">
        <div>
            <a href="{{ route('admin-dashboard') }}">Reservations</a>
        </div>
        <div>
            <a href="{{ route('admin-cars') }}">Manage Cars</a>
        </div>
        <div>
            <a href="{{ route('admin-users') }}">Manage Users</a>
        </div>
        <div>
            <a href="{{ route('admin-message') }}">Daily message</a>
        </div>
    </div>

    {{--        content--}}
    <div class="grow" style="border: 10px solid blue">
        <div>
            <h1>Daily message</h1>
            <p>Let site visitors be greeted by a message</p>
        </div>
        <div>
            <form action="{{ route('admin-message.store') }}" method="POST">
                @csrf
                <textarea name="message" required></textarea>
                <button type="submit">Set message</button>
            </form>
        </div>
    </div>
</main>

@include('components.footer')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite('resources/js/adminUserHandler.js')
</body>
</html>
