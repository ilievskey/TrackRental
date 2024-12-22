<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Details</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('components.navbar')

<main>
    <div class="flex flex-col">
        <div class="title-container flex flex-col">
            <h1 class="text-white capitalize text-6xl font-semibold drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">{{$car->make}}</h1>
            <p class="text-white uppercase text-9xl font-bold drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">{{$car->model}}</p>
        </div>
        <div>
            @include('components.details-navbar')
        </div>
        <section id="overview" class="w-full px-4 bg-cyan-950">
            <div class="flex justify-center pt-32">
                <h1 class="text-8xl text-white font-bold py-9">Where size meets power.</h1>
            </div>
            <div class="pt-32 pb-48 flex flex-wrap gap-9 items-center">
                <div class="detail-card text-3xl text-white font-semibold">
                    <p>Seats: {{$car->seats}}</p>
                </div>
                <div class="detail-card text-3xl text-white font-semibold">
                    <p>Drivetrain: <span class="uppercase">{{$car->drivetrain}}</span></p>
                </div>
                <div class="detail-card text-3xl text-white font-semibold">
                    <p class="capitalize">Transmission: {{$car->transmission}}</p>
                </div>
                <div class="detail-card text-3xl text-white font-semibold">
                    <p>Horsepower: 306HP</p>
                </div>
            </div>
        </section>
        <section id="gallery" class="w-full px-4">
            <div class="flex justify-center pt-32">
                <h1 class="text-8xl text-zinc-900 font-bold py-9">Gallery</h1>
            </div>
            <div class="sm:flex pb-32">
                <div class="image-card">
                    <img src="https://picsum.photos/id/698/1280/720" alt="">
                </div>
                <div class="flex-col">
                    <div class="image-card">
                        <img src="https://picsum.photos/id/698/1280/720" alt="">
                    </div>
                    <div class="image-card">
                        <img src="https://picsum.photos/id/698/1280/720" alt="">
                    </div>
                </div>
            </div>
        </section>
    </div>
{{--@vite('resources/js/script.js')--}}
</main>
@include('components.footer')
</body>
</html>
