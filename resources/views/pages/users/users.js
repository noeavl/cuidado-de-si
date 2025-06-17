$(() => {
    $('#usersTable').DataTable({
        ajax: {
            url: '../routes/web.php',
            type: 'GET',
            data: function (d) {
                d.REQUEST_URI = '/users/list'
            },
            dataSrc: 'users'
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'username' },
            { data: 'email' },
            { data: 'role' }, {
                data: null,
                render: function (data, type, row, meta) {
                    return row.status ? `<span class="badge text-bg-success">Activo</span>` : '<span class="badge text-bg-danger">Inactivo</span>'
                }
            },
            {
                data: null,
                render: function (data, type, row, meta) {
                    return `
                    <a class="btn btn-primary" href="?page=edit-user&id=${row.id}">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    ${row.status
                            ? `<button class="btn btn-success" onclick="activateUser(${row.id},0)">
                        <i class="fa-solid fa-eye"></i>
                       </button>`
                            : `<button class="btn btn-danger" onclick="activateUser(${row.id},1)">
                         <i class="fa-solid fa-eye-slash"></i>
                        </button>`}
                    `

                }
            }
        ],
        language: {
            url: 'assets/datatables/es-Es.json',
        },
    })


})

function activateUser(id, status) {
    Swal.fire({
        title: `${status ? 'Activar' : 'Desactivar'} Usuario`,
        text: `¿Estás seguro de ${status ? 'Activar' : 'Desactivar'} este usuario?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: `${status ? '#198754' : '#dc3545'}`,
        cancelButtonColor: "#808080",
        confirmButtonText: `${status ? 'Activar' : 'Desactivar'}`
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../routes/web.php',
                type: 'POST',
                data: { REQUEST_URI: '/users/status', id: id, status: status },
                success: (response) => {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Estado actualizado',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
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
                    console.log('Error: ', error, xhr, status)
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'Hubo un error al procesar la solicitud'
                    });
                }
            })
        }
    });
}