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
</main>

@include('components.footer')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite('resources/js/adminCarHandler.js')
</body>
</html>
