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
<main class="flex flex-row h-screen">
    {{--        sidebar--}}
    <div class="w-1/4 min-w-32" style="border: 10px solid red">
        <div>
            <a href="{{ route('admin-dashboard') }}">Reservations</a>
        </div>
        <div>
            <a href="{{ route('index') }}">Manage Cars</a>
        </div>
        <div>
            <a href="{{ route('index') }}">Manage Users</a>
        </div>
        <div>
            <a href="{{ route('index') }}">Daily message</a>
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
                        <td>{{ $reservation->car->make }}</td>
                        <td>{{ $reservation->car->model }}</td>
                        <td>{{ $reservation->pickup_location }}</td>
                        <td>{{ $reservation->pickup_date }}</td>
                        <td>{{ $reservation->pickup_time }}</td>
                        <td>
{{--                            <a href="{{ route('reserve.edit', $reservation) }}">Edit</a>--}}
                            <form action="{{ route('admin-dashboard.destroy', $reservation) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

@include('components.footer')

{{--@vite('resources/js/script.js')--}}
</body>
</html>
