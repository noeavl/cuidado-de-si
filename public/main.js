$(() => {
    $('#logout').on('click', () => {
        $.ajax({
            url: '../routes/web.php',
            type: 'POST',
            data: { REQUEST_URI: '/auth/logout' },
            success: (response) => {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload()
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            error: (xhr, status, error) => {
                console.log('Error: ', error)
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Hubo un error al procesar la solicitud'
                });
            }
        })
    })
})