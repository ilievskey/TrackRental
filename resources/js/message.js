document.addEventListener('DOMContentLoaded', function (){
    let dismissedMessage = sessionStorage.getItem('dismissedMessage');

    fetch('/message')
        .then(response => response.json())
        .then(data => {
            if(data && data.content && data.id.toString() !== dismissedMessage) {
                Swal.fire({
                    title: 'Note!',
                    text: data.content,
                    icon: 'info',
                    confirmButtonColor: '#083344',
                    confirmButtonText: 'Okay'
                }).then(() => {
                    sessionStorage.setItem('dismissedMessage', data.id);
                });
            }
        });
});
