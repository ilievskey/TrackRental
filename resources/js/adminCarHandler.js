document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-car').forEach(button => {
        button.addEventListener('click', function () {
            const carId = this.getAttribute('data-car-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#083344',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete the car!'
            }).then((result) => {
                if(result.isConfirmed){
                    fetch(`/admin-cars/${carId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success){
                                Swal.fire(
                                    'Deleted!',
                                    data.message || 'Car deleted!',
                                    'success'
                                ).then(() => location.reload());
                            } else{
                                Swal.fire(
                                    'Error',
                                    data.message || 'Error removing car!',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error',
                                error.message || 'Internal server error.',
                                'error'
                            );
                        });
                }
            });
        });
    });

    document.querySelector('.add-car').addEventListener('click', function () {
        Swal.fire({
            title: 'Add new car to database',
            html: `
            <div class="">
                <div>
                    <label for="car-make">Make</label>
                    <input type="text" id="car-make" class="" placeholder="Make">
                </div>
                <div>
                    <label for="car-model">Model</label>
                    <input type="text" id="car-model" class="" placeholder="Model">
                </div>
                <div>
                    <label for="car-seats">Seats</label>
                    <input type="number" id="car-seats" class="" placeholder="Seats">
                </div>
                <div>
                    <label for="car-drivetrain">Drivetrain</label>
                    <select id="car-drivetrain" class="">
                        <option value="fwd">FWD</option>
                        <option value="rwd">RWD</option>
                        <option value="awd">AWD</option>
                    </select>
                </div>
                <div>
                    <label for="car-transmission">Transmission</label>
                    <select id="car-transmission" class="">
                        <option value="auto">Auto</option>
                        <option value="manual">Manual</option>
                    </select>
                </div>
            </div>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Add car',
            confirmButtonColor: '#083344',
            cancelButtonColor: '#d33',
            preConfirm: () => {
                const make = document.getElementById('car-make').value;
                const model = document.getElementById('car-model').value;
                const seats = document.getElementById('car-seats').value;
                const drivetrain = document.getElementById('car-drivetrain').value;
                const transmission = document.getElementById('car-transmission').value;

                if(!make || !model || !seats || !drivetrain || !transmission){
                    Swal.showValidationMessage('All fields need to be filled out');
                    return false;
                }
                // number check

                return {make, model, seats, drivetrain, transmission};
            }
        }).then((result) => {
            if(result.isConfirmed) {
                fetch('/admin-cars', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(result.value)
                })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success){
                            Swal.fire(
                                'Success!',
                                data.message || 'Car successfully added to database',
                                'success'
                            );

                            const tableBody = document.querySelector('table tbody');

                            const newRow = `
                            <tr>
                                <td class="capitalize">${data.car.make}</td>
                                <td class="capitalize">${data.car.model}</td>
                                <td class="">${data.car.seats}</td>
                                <td class="uppercase">${data.car.drivetrain}</td>
                                <td class="capitalize">${data.car.transmission}</td>
                                <td>
                                    <button type="button" class="bg-yellow-300 edit-car" data-car-id="${data.car.id}">Edit</button>
                                </td>
                                <td>
                                    <button type="button" class="bg-red-300 delete-car" data-car-id="${data.car.id}">Delete</button>
                                </td>
                            </tr>
                            `;

                            tableBody.insertAdjacentHTML('beforeend', newRow);
                        } else{
                            Swal.fire('Error!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error!', error.message || 'Something went very wrong.', 'error');
                    });
            }
        });
    });
    document.querySelectorAll('.edit-car').forEach(button => {
        button.addEventListener('click', function () {
            const carId = this.getAttribute('data-car-id');

            fetch(`/admin-cars/${carId}`)
                .then(response => response.json())
                .then(car => {
                    Swal.fire({
                        title: 'Edit existing car',
                        html: `
                        <div class="">
                            <div>
                                <label for="car-make">Make</label>
                                <input type="text" id="car-make" class="" value="${car.make}">
                            </div>
                            <div>
                                <label for="car-model">Model</label>
                                <input type="text" id="car-model" class="" value="${car.model}">
                            </div>
                            <div>
                                <label for="car-seats">Seats</label>
                                <input type="number" id="car-seats" class="" value="${car.seats}">
                            </div>
                            <div>
                                <label for="car-drivetrain">Drivetrain</label>
                                <select id="car-drivetrain" class="">
                                    <option value="fwd" ${car.drivetrain === 'fwd' ? 'selected' : ''}>FWD</option>
                                    <option value="rwd" ${car.drivetrain === 'rwd' ? 'selected' : ''}>RWD</option>
                                    <option value="awd" ${car.drivetrain === 'awd' ? 'selected' : ''}>AWD</option>
                                </select>
                            </div>
                            <div>
                                <label for="car-transmission">Transmission</label>
                                <select id="car-transmission" class="">
                                    <option value="auto" ${car.transmission === 'auto' ? 'selected' : ''}>Auto</option>
                                    <option value="manual" ${car.transmission === 'manual' ? 'selected' : ''}>Manual</option>
                                </select>
                            </div>
                        </div>
                        `,
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: 'Confirm',
                        confirmButtonColor: '#083344',
                        cancelButtonColor: '#d33',

                        preConfirm: () => {
                            const make = document.getElementById('car-make').value;
                            const model = document.getElementById('car-model').value;
                            const seats = document.getElementById('car-seats').value;
                            const drivetrain = document.getElementById('car-drivetrain').value;
                            const transmission = document.getElementById('car-transmission').value;

                            if(!make || !model || !seats || !drivetrain || !transmission){
                                Swal.showValidationMessage('All fields need to be filled out');
                                return false;
                            }

                            return {make, model, seats, drivetrain, transmission};
                        }
                    }).then((result) => {
                        if(result.isConfirmed){
                            fetch(`/admin-cars/${carId}`, {
                                method: 'PUT',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(result.value)
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if(data.success){
                                        Swal.fire('Success!', data.message, 'success');
                                        const row = button.closest('tr');
                                        row.querySelector('td:nth-child(1)').textContent = data.car.make;
                                        row.querySelector('td:nth-child(2)').textContent = data.car.model;
                                        row.querySelector('td:nth-child(3)').textContent = data.car.seats;
                                        row.querySelector('td:nth-child(4)').textContent = data.car.drivetrain.toUpperCase();
                                        row.querySelector('td:nth-child(5)').textContent = data.car.transmission.charAt(0).toUpperCase() + data.car.transmission.slice(1);
                                    } else{
                                        Swal.fire('Error!', data.message, 'error');
                                    }
                                })
                                .catch(error => {
                                    Swal.fire('Something went wrong!', error.message, 'error');
                                });
                        }
                    });
                })
                .catch(error => {
                    Swal.fire('Error!', error.message, 'error');
                })
        });
    });
});
