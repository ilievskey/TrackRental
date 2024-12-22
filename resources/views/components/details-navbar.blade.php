<header class="p-4 bg-zinc-900 flex items-center justify-between">
    <div class="px-1 md:px-9 flex ms-auto text-white">
        <div class="flex gap-6 mr-6 items-center">
            <a href="#overview">Overview / Specs</a>
            <a href="#gallery">Gallery</a>
        </div>
        <div class="flex text-black">
            @auth
                <a href="{{route('reserve', ['id' => $car->id])}}" class="rounded-full py-2 px-4 bg-white"><p class="block sm:hidden">Book</p><p class="hidden sm:block">Book now</p></a>
            @endauth
            @guest
                <a href="{{route('reserve', ['id' => $car->id])}}" class="rounded-full py-2 px-4 bg-white"><p class="block sm:hidden">Log in</p><p class="hidden sm:block">Log in to book</p></a>
            @endguest
        </div>
    </div>
</header>
