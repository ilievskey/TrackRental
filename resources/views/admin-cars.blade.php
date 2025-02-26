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
            <h1>Cars</h1>
            <button type="button" class="bg-green-300 add-car">Add car</button>
            <table>
                <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Seats</th>
                    <th>Drivetrain</th>
                    <th>Transmission</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td class="capitalize">{{ $car->make }}</td>
                        <td class="capitalize">{{ $car->model }}</td>
                        <td>{{ $car->seats }}</td>
                        <td class="uppercase">{{ $car->drivetrain }}</td>
                        <td class="capitalize">{{ $car->transmission }}</td>
                        <td>
                            {{--                            <a href="{{ route('reserve.edit', $reservation) }}">Edit</a>--}}
                            <button type="button" class="bg-yellow-300 edit-car" data-car-id="{{ $car->id }}">Edit</button>
                        </td>
                        <td>
                            {{--                            <a href="{{ route('reserve.edit', $reservation) }}">Edit</a>--}}
                            <button type="button" class="bg-red-300 delete-car" data-car-id="{{ $car->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@include('components.footer')
</main>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite('resources/js/adminCarHandler.js')
</body>
</html>
