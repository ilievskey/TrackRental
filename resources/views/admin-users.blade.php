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
<main class="flex flex-row min-h-screen-755rem">
    {{--        sidebar--}}
    <div class="w-1/4 min-w-32 flex flex-col place-items-center justify-center">
        <a href="{{ route('admin-dashboard') }}" class="admin-option">Reservations</a>
        <a href="{{ route('admin-cars') }}" class="admin-option">Manage Cars</a>
        <a href="{{ route('admin-users') }}" class="admin-option">Manage Users</a>
        <a href="{{ route('admin-message') }}" class="admin-option">Daily message</a>
    </div>

    {{--        content--}}
    <div class="grow p-8">
        <div class="admin-bg">
            <h1>Users</h1>
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{--                            <a href="{{ route('reserve.edit', $reservation) }}">Edit</a>--}}
                            <button type="button" class="bg-red-300 delete-user" data-user-id="{{ $user->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

@include('components.footer')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite('resources/js/adminUserHandler.js')
</body>
</html>
