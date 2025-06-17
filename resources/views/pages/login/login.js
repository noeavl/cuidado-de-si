$(() => {
    const showError = (input, message) => {
        $(input).after(`<span class="text-danger">${message}</span>`)
    }

    const clearError = (input) => {
        $(input).next('.text-danger').remove()
    }

    $('#form').on('submit', (e) => {
        e.preventDefault()
        let hasErrors = false

        const formData = {
            email: $('#email').val(),
            password: $('#password').val()
        }

        clearError('#email')
        clearError('#password')

        if (!formData.email) {
            showError('#email', 'El correo electrónico es requerido')
            hasErrors = true
        }

        if (!formData.password) {
            showError('#password', 'La contraseña es requerida')
            hasErrors = true
        }

        if (hasErrors) return

        $.ajax({
            url: '../../../../routes/web.php',
            type: 'POST',
            data: { data: formData, REQUEST_URI: '/auth/login' },
            success: (response) => {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = '../../../../public/index.php'
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

    window.togglePassword = (icon) => {
        const passwordInput = $('#password');

        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            $(icon).removeClass('fa-lock').addClass('fa-lock-open');
        } else {
            passwordInput.attr('type', 'password');
            $(icon).removeClass('fa-lock-open').addClass('fa-lock');
        }
    }
})