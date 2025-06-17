$(() => {
    $.ajax({
        url: '../routes/web.php',
        type: 'GET',
        data: { REQUEST_URI: '/users/find-by-id', id: $('#id').val() },
        success: (response) => {
            if (response.success) {
                $('#name').val(response.user.name)
                $('#username').val(response.user.username)
                $('#email').val(response.user.email)
                $('#role').val(response.user.role)
                $('#status').val(response.user.status)
            }
        },
        error: (error) => {
            console.log('Error: ', error)
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'Hubo un error al obtener los datos del usuario'
            });
        }
    })

    const showError = (input, message) => {
        $(input).after(`<span class="text-danger ms-2">${message}</span>`)
    }

    const clearError = (input) => {
        $(input).next('.text-danger').remove()
    }

    $('#form').on('submit', async (e) => {
        e.preventDefault();
        let hasErrors = false

        const formData = {
            id: $('#id').val(),
            name: $('#name').val(),
            username: $('#username').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val(),
            role: $('#role').val(),
            status: $('#status').val()
        }

        clearError('#name')
        clearError('#username')
        clearError('#email')
        clearError('#password_confirmation')
        clearError('#role')
        clearError('#status')

        if (!formData.name) {
            showError('#name', 'El nombre es requerido')
            hasErrors = true
        } else if (formData.name.length > 255) {
            showError('#name', 'El nombre no puede tener más de 255 caracteres')
            hasErrors = true
        }

        if (!formData.username) {
            showError('#username', 'El nombre de usuario es requerido')
            hasErrors = true
        } else if (formData.username.length > 255) {
            showError('#username', 'El nombre de usuario no puede tener más de 255 caracteres')
            hasErrors = true
        }

        if (!formData.email) {
            showError('#email', 'El correo electrónico es requerido')
            hasErrors = true
        }

        if (formData.password !== formData.password_confirmation) {
            showError('#password_confirmation', 'Las contraseñas no coinciden')
            hasErrors = true
        }

        if (!formData.role) {
            showError('#role', 'El rol es requerido')
            hasErrors = true
        }

        if (!formData.status) {
            showError('#status', 'El estado es requerido')
            hasErrors = true
        }

        const checkDuplicate = (type, value) => {
            return new Promise((resolve) => {
                $.ajax({
                    url: '../routes/web.php',
                    type: 'POST',
                    data: {
                        REQUEST_URI: `/users/check-${type}`,
                        [type]: value
                    },
                    success: (response) => {
                        if (response.success) {
                            showError(`#${type}`, response.message);
                            hasErrors = true;
                        }
                        resolve();
                    },
                    error: (error) => {
                        console.log('Error: ', error);
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Error en la verificación' });
                        resolve();
                    }
                });
            })
        }

        await Promise.all([
            checkDuplicate('email', formData.email),
            checkDuplicate('username', formData.username)
        ])

        if (hasErrors) return

        $.ajax({
            url: '../routes/web.php',
            type: 'POST',
            data: { REQUEST_URI: '/users/update', data: formData, id: formData.id },
            success: (response) => {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Exito!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = '?page=users'
                    });
                }
            },
            error: (error) => {
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