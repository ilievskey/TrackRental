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

                const getImageSrc = (make) => {
                    switch(make){
                        case "toyota": return "https://cdn.motor1.com/images/mgl/6ZNqmZ/s3/2024-toyota-gr-yaris.jpg";
                        case "BAC": return "https://vehicle-photos-published.vauto.com/a3/b8/7f/1b-ddd2-4525-a9ba-2b0b2c0a1555/image-1.jpg";
                        case "lamborghini": return "https://www.lamborghini.com/sites/it-en/files/DAM/lamborghini/masterpieces/sesto-elemento/sesto-elemento-HEADER.jpg";
                        case "bmw": return "https://www.supercars.net/blog/wp-content/uploads/2016/03/2010_BMW_M3CompetitionPackage2.jpg";
                        case "volkswagen": return "https://autoua.net/media/cache/97/77/9777998b30dbf8398fbbb55fc3d3768b.jpg";
                        case "mercedes": return "https://www.mercedes-benzsouthwest.co.uk/media/wysiwyg/EQIconTemplate_9.jpg";
                        case "aston martin": return "https://www.motortrend.com/uploads/sites/5/2015/06/2016-Aston-Martin-DB9-GT-front-three-quarter.jpg";
                        case "audi": return "https://www.westcoastexoticcars.com/imagetag/1505/7/l/Used-2018-Audi-R8-Quattro-V10-Plus-1672262666.jpg";
                        case "skoda": return "https://www.motorgreen.fr/wp-content/uploads/2021/10/skoda-octavia-20804-1-1.jpg";
                        default: return "https://static.wikia.nocookie.net/forzamotorsport/images/4/41/HOR_XB1_Null_Car.png/revision/latest?cb=20210118173720"
                    }
                }

                cars.forEach(car => {
                    const carElement = document.createElement('div');
                    carElement.className = 'bg-white rounded-lg shadow-md';
                    const imageUrl = getImageSrc(car.make);
                    if(car.is_reserved){
                        carElement.innerHTML = `
                        <div class="max-w-sm w-full h-full rounded overflow-hidden shadow-lg flex flex-col bg-gray-200">
                            <div class="h-40" style="filter: blur(2px); opacity: 0.5;">
                                <img class="w-full h-full object-cover" src="${imageUrl}" alt="car"/>
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
                                <img class="w-full h-full object-cover" src="${imageUrl}" alt="car"/>
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
