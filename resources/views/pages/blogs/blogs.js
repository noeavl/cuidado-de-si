$(() => {
    $('#blogsTable').DataTable({
        ordering: false,
        ajax: {
            url: '../routes/web.php',
            type: 'GET',
            data: function (d) {
                d.REQUEST_URI = '/blogs/list'
            },
            dataSrc: 'blogs'
        },
        columns: [
            { data: 'id' },
            { data: 'img' },
            { data: 'title' },
            { data: 'description' },
            {
                data: null,
                render: function (data, type, row, meta) {
                    return row.status ? `<span class="badge text-bg-success">Activo</span>` : '<span class="badge text-bg-danger">Inactivo</span>'
                }
            },
            {
                data: null,
                render: function (data, type, row, meta) {
                    return `
                    <button class="btn btn-primary">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    ${row.status
                            ? `<button class="btn btn-success" onclick="activateBlog(${row.id},0)">
                        <i class="fa-solid fa-check"></i>
                       </button>`
                            : ` <button class="btn btn-danger" onclick="activateBlog(${row.id},1)">
                         <i class="fa-solid fa-x"></i>
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
function activateBlog(id, status) {
    Swal.fire({
        title: `${status ? 'Activar' : 'Desactivar'} Blog`,
        text: `¿Estás seguro de ${status ? 'Activar' : 'Desactivar'} este blog?`,
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
                data: { REQUEST_URI: '/blogs/status', id: id, status: status },
                success: (response) => {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Estado actualizado',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#eventsTable').DataTable().ajax.reload();
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