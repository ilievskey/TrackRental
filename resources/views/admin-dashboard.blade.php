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
    @include('components.navbar')
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
