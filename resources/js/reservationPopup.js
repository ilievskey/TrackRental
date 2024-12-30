document.querySelector('#reserve-form').addEventListener('submit', function (e) {
    e.preventDefault();

    let form = this;
    let reserveUrl = form.getAttribute('data-url');

    let pickupDate = document.getElementById('pickup_date').value;
    let pickupTime = document.getElementById('pickup_time').value;

    let inputDateTime = new Date(`${pickupDate}T${pickupTime}`);
    let currentDateTime = new Date();

    if(inputDateTime < currentDateTime) {
        Swal.fire({
            title: 'Invalid date/time',
            text: 'Selected date or time cannot be earlier than currently',
            icon: 'warning',
            confirmButtonText: 'Barnacles',
            confirmButtonColor: '#083344',
        });
        return;
    }

    fetch(reserveUrl, {
        method: 'post',
        body: new FormData(form),
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                Swal.fire({
                    title: 'Success!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'Yipee!'
                }).then(() => {
                    window.location.href = '/';
                });
            } else{
                Swal.fire({
                    title: 'Error',
                    text: 'Something went wrong on our end. Please try again in a moment',
                    icon: 'success',
                    confirmButtonText: 'Barnacles',
                    confirmButtonColor: '#083344',
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        })
});
