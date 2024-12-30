document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-user').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-user-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#083344',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete the user!'
            }).then((result) => {
                if(result.isConfirmed){
                    fetch(`/admin-users/${userId}`, {
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
                                    data.message || 'User deleted!',
                                    'success'
                                ).then(() => location.reload());
                            } else{
                                Swal.fire(
                                    'Error',
                                    data.message || 'Error removing user!',
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
