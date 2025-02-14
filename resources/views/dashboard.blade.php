{{--too lazy to refactor so this is simply reservations for user instad of dashboard--}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-lg">Your reservations</h1>
                    <div>
                        @if($reservations->isEmpty())
                            <p>You have made no reservations.</p>
                        @else
                            <table class="table-auto">
                                <thead>
                                <tr>
                                    <th class="px-4 py-2">Car</th>
                                    <th class="px-4 py-2">Location</th>
                                    <th class="px-4 py-2">Date</th>
                                    <th class="px-4 py-2">Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td class="border px-4 py-2 capitalize">{{ $reservation->car->make }} {{$reservation->car->model}}</td>
                                        <td class="border px-4 py-2">{{ $reservation->pickup_location }}</td>
                                        <td class="border px-4 py-2">{{ $reservation->pickup_date }}</td>
                                        <td class="border px-4 py-2">{{ $reservation->pickup_time }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('components.footer')
