document.addEventListener('DOMContentLoaded', () => {
    const makeFilter = document.getElementById('filter-make-dropdown');
    const seatsFilter = document.getElementById('filter-seats-slider');
    const drivetrainFilter = document.getElementsByName('drivetrain');
    const transmissionFilter = document.getElementsByName('transmission');
    const resetButton = document.getElementById('resetFilters');


    seatsValueUpdater(seatsFilter.value);

    const fetchFilters = () => {
        const make = makeFilter.value;
        const seats = seatsFilter.value;
        let drivetrain = Array.from(drivetrainFilter)
            .filter(cb => cb.checked)
            .map(cb =>cb.value);
        let transmission = Array.from(transmissionFilter)
            .filter(cb => cb.checked)
            .map(cb => cb.value);


        const parameters = new URLSearchParams();
        if(make) parameters.append('make', make);
        if(seats && seats > 0) parameters.append('seats', seats);
        if(drivetrain.length) parameters.append('drivetrain', drivetrain.join(','));
        if(transmission.length) parameters.append('transmission', transmission.join(','));

        fetch(`/api/cars?${parameters.toString()}`)
            .then(response => response.json())
            .then(cars => {
                const carsContainer = document.getElementById('cars-container');
                carsContainer.innerHTML = '';

                cars.forEach(car => {
                    const carElement = document.createElement('div');
                    carElement.className = 'bg-white rounded-lg shadow-md';
                    if(car.is_reserved){
                        carElement.innerHTML = `
                        <div class="max-w-sm w-full h-full rounded overflow-hidden shadow-lg flex flex-col bg-gray-200">
                            <div class="h-40 blur-md">
                                <img class="w-full h-full object-cover" src="https://cdn.motor1.com/images/mgl/6ZNqmZ/s3/2024-toyota-gr-yaris.jpg" alt="car"/>
                            </div>
                            <div class="px-6 py-4 flex flex-col flex-grow justify-between">
                                <div class="font-bold text-xl mb-2 capitalize"><s>${car.make} ${car.model}</s></div>
                                <p class="text-gray-700 text-base"><s>Seats: <span class="font-bold capitalize">${car.seats}</s></span></p>
                                <p class="text-gray-700 text-base"><s>Drivetrain: <span class="font-bold uppercase">${car.drivetrain}</s></span></p>
                                <p class="text-gray-700 text-base"><s>Transmission: <span class="font-bold capitalize">${car.transmission}</s></span></p>
                            </div>
                            <button class="py-2 bg-gray-200"><s>See Details >></s></button>
                        </div>`;
                    } else {
                        carElement.innerHTML = `
                        <div class="max-w-sm w-full h-full rounded overflow-hidden shadow-lg flex flex-col">
                            <div class="h-40">
                                <img class="w-full h-full object-cover" src="https://cdn.motor1.com/images/mgl/6ZNqmZ/s3/2024-toyota-gr-yaris.jpg" alt="car"/>
                            </div>
                            <div class="px-6 py-4 flex flex-col flex-grow justify-between">
                                <div class="font-bold text-xl mb-2 capitalize">${car.make} ${car.model}</div>
                                <p class="text-gray-700 text-base">Seats: <span class="font-bold capitalize">${car.seats}</span></p>
                                <p class="text-gray-700 text-base">Drivetrain: <span class="font-bold uppercase">${car.drivetrain}</span></p>
                                <p class="text-gray-700 text-base">Transmission: <span class="font-bold capitalize">${car.transmission}</span></p>
                            </div>
                            <button onclick="window.location.href='/cars/${car.id}'" class="py-2 bg-gray-200">See Details >></button>
                        </div>`;
                    }
                    carsContainer.appendChild(carElement);
                });
            });
    };

    makeFilter.addEventListener('change', fetchFilters);
    seatsFilter.addEventListener('change', fetchFilters);
    Array.from(drivetrainFilter).forEach(cb => cb.addEventListener('change', fetchFilters));
    Array.from(transmissionFilter).forEach(cb => cb.addEventListener('change', fetchFilters));

    resetButton.addEventListener('click', () => {
        makeFilter.value = '';
        seatsFilter.value = 0;
        Array.from(drivetrainFilter).forEach(cb => cb.checked = false);
        Array.from(transmissionFilter).forEach(cb => cb.checked = false);
        fetchFilters();
    });

    fetchFilters();
});
