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
            <h1>Reservations</h1>
            <table>
                <thead>
                <tr>
                    <th>User</th>
                    <th>Car make</th>
                    <th>Car model</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->user->name }}</td>
                        <td class="capitalize">{{ $reservation->car->make }}</td>
                        <td class="capitalize">{{ $reservation->car->model }}</td>
                        <td>{{ $reservation->pickup_location }}</td>
                        <td>{{ $reservation->pickup_date }}</td>
                        <td>{{ $reservation->pickup_time }}</td>
                        <td>
{{--                            <a href="{{ route('reserve.edit', $reservation) }}">Edit</a>--}}
                            <button type="button" class="bg-red-300 delete-reservation" data-reservation-id="{{ $reservation->id }}">Delete</button>
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
@vite('resources/js/adminReservationHandler.js')
</body>
</html>
