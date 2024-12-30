<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('components.navbar')

<main>
    <form id="reserve-form" action="{{route('reserve.store', $car)}}" method="post" data-url="{{route('reserve.store', $car->id)}}">
        @csrf
        <input type="hidden" name="car_id" value="{{ $car->id }}">

        <h1 class="text-8xl capitalize font-semibold text-center">{{$car->make}} {{$car->model}}</h1>

        <div class="bg-zinc-900 py-2 flex gap-4 flex-col px-9 sm:flex-row my-4 pb-4">
            <div>
                <label for="pickup_location" class="text-white">Location: </label>
                <select id="pickup_location" name="pickup_location" class="rounded-md bg-zinc-700 text-white border-gray-700 w-full" required>
                    @foreach($locations as $location)
                        <option value="{{ $location }}" class="bg-zinc-700 text-white">{{ $location }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="pickup_date" class="text-white">Date: </label>
                <input type="date" id="pickup_date" name="pickup_date" class="rounded-md bg-zinc-700 text-white border-gray-700 w-full" required>
            </div>
            <div>
                <label for="pickup_time" class="text-white">Time: </label>
                <input type="time" id="pickup_time" name="pickup_time" class="rounded-md bg-zinc-700 text-white border-gray-700 w-full" required>
            </div>
        </div>

        <div class="px-9  my-4">
            <div id="mapContainer" class="pb-4"></div>
            <button type="submit" class="bg-cyan-950 text-white px-4 py-3 rounded-lg">Reserve</button>
        </div>

    </form>
</main>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite(['resources/js/mapHandler.js', 'resources/js/reservationPopup.js'])
@include('components.footer')
</body>
</html>
