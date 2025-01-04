<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Track Rental</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
{{--######################## ASIDE--}}
@include('components.side-filter')
{{--main--}}
<div class="flex-1 flex flex-col min-h-screen md:pl-64">
    @include('components.navbar')


    {{--    ###################### ACTUAL MAIN ######################--}}
    <main>
        <div class="container mx-auto px-4">
            <div id="cars-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-8 py-8">
                <div class="col-span-full text-center">
                    <img src="https://media.tenor.com/_62bXB8gnzoAAAAj/loading.gif" alt="loading...">
                </div>
            </div>
        </div>
    </main>

</div>

@include('components.footer')



<script>
    function seatsValueUpdater(value) {
        document.getElementById('seatsValue').textContent = value;
        if(value < 1) document.getElementById('seatsValue').innerHTML = 'any';
    }

</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite(['resources/js/script.js', 'resources/js/message.js'])
</body>
</html>
