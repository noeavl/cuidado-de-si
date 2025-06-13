$(() => {
    $('#eventsTable').DataTable({
        ajax: {
            url: '../routes/web.php',
            type: 'GET',
            data: function (d) {
                d.REQUEST_URI = '/events/list'
            },
            dataSrc: 'events'
        },
        columns: [
            { data: 'id' },
            { data: 'banner' },
            { data: 'name' },
            { data: 'place' },
            { data: 'date' },
            {
                data: null,
                render: function (data, type, row, meta) {
                    return row.status ? `<span class="badge text-bg-success">Activo</span>` : '<span class="badge text-bg-danger">Inactivo</span>'
                }
            },
            { data: null }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/2.3.2/i18n/es-ES.json',
        },
    })
})