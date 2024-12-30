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
});
