document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-reservation').forEach(button => {
        button.addEventListener('click', function () {
            const reservationId = this.getAttribute('data-reservation-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#083344',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete reservation!'
            }).then((result) => {
                if(result.isConfirmed){
                    fetch(`/admin-dashboard/${reservationId}`, {
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
                                    data.message || 'Reservation deleted!',
                                    'success'
                                ).then(() => location.reload());
                            } else{
                                Swal.fire(
                                    'Error',
                                    data.message || 'Error removing reservation!',
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
