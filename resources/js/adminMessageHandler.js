document.addEventListener('DOMContentLoaded', function (){
    document.querySelectorAll('.clear-message').forEach(button => {
        button.addEventListener('click', function (){
            const msgId = this.getAttribute('data-message-id');

            Swal.fire({
                title: 'Delete message?',
                text: "You sure?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#083344',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if(result.isConfirmed){
                    fetch(`admin-message/${msgId}`, {
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
                                    'Deleted',
                                    data.message || 'Message removed!',
                                    'success'
                                ).then(() => location.reload());
                            } else {
                                Swal.fire(
                                    'Error',
                                    data.message || 'Error deleting message!',
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
                        })
                }
            })
        })
    })
})
