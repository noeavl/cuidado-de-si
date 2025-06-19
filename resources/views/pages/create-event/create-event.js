$(function () {
    // Configurar FilePond
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.registerPlugin(FilePondPluginImageResize);
    FilePond.registerPlugin(FilePondPluginImageCrop);
    FilePond.registerPlugin(FilePondPluginFileValidateSize);

    let uploadedBanner = null
    const pond = FilePond.create(document.getElementById('banner'), {
        labelIdle: 'Arrastra tu imagen aquí o <span class="filepond--label-action">Selecciona</span>',
        labelInvalidField: 'Campo inválido',
        labelFileLoading: 'Cargando',
        labelFileLoadError: 'Error al cargar',
        labelFileProcessing: 'Procesando',
        labelFileProcessingComplete: 'Procesado',
        labelFileProcessingAborted: 'Procesamiento cancelado',
        labelFileProcessingError: 'Error al procesar',
        labelFileProcessingRevertError: 'Error al revertir',
        labelFileRemoveError: 'Error al eliminar',
        labelTapToCancel: 'Toca para cancelar',
        labelTapToRetry: 'Toca para reintentar',
        labelTapToUndo: 'Toca para deshacer',
        labelButtonRemoveItem: 'Eliminar',
        labelButtonAbortItemLoad: 'Abortar',
        labelButtonAbortItemProcessing: 'Cancelar',
        labelButtonUndoItemProcessing: 'Deshacer',
        labelButtonRetryItemProcessing: 'Reintentar',
        labelButtonProcessItem: 'Subir',
        labelMaxFileSizeExceeded: 'El archivo es demasiado grande',
        labelMaxFileSize: 'El tamaño máximo del archivo es {filesize}',
        maxFiles: 1,
        acceptedFileTypes: ['image/*'],
        maxFileSize: '1MB',
        imagePreviewHeight: 200,
        imageCropAspectRatio: '16:9',
        imageResizeTargetWidth: 800,
        imageResizeTargetHeight: 450,
        styleItemPanelAspectRatio: 0.5,
        styleLoadIndicatorPosition: 'center bottom',
        styleProgressIndicatorPosition: 'right bottom',
        styleButtonRemoveItemPosition: 'left bottom',
        styleButtonProcessItemPosition: 'right bottom',
        server: {
            url: '../routes/upload.php',
            method: 'POST',
            withCredentials: false,
            headers: {},
            timeout: 7000,
            process: {
                onload: (response) => {
                    uploadedBanner = response
                    return response
                }
            },
            revert: (uniqueFileId, load, error) => {
                const formData = new FormData()
                formData.append('REQUEST_URI', '/events/delete-banner')
                formData.append('filename', uniqueFileId)

                fetch('../routes/remove.php', {
                    method: 'POST',
                    body: formData
                }).then((response) => {
                    if (response.ok) {
                        uploadedBanner = null
                        load()
                    } else {
                        error()
                    }
                }).catch(err => {
                    console.error('Error: ', err)
                    error()
                })
            }
        }
    });

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
            name: $('#name').val(),
            place: $('#place').val(),
            date: $('#date').val(),
            banner: uploadedBanner
        }

        clearError('#name')
        clearError('#place')
        clearError('#date')
        clearError('#banner')

        if (!formData.name) {
            showError('#name', 'El nombre es requerido')
            hasErrors = true
        } else if (formData.name.lenght > 255) {
            showError('#name', 'El nombre no puede ser mayor a 255 caracteres')
            hasErrors = true
        }

        if (!formData.place) {
            showError('#place', 'El lugar es requerido')
            hasErrors = true
        } else if (formData.place.length > 255) {
            showError('#place', 'El lugar no puede ser mayor a 255 caracteres')
            hasErrors = true
        }

        if (!formData.date) {
            showError('#date', 'La fecha es requerida')
            hasErrors = true
        }

        if (!uploadedBanner) {
            showError('#banner', 'La imagen es requerida');
            hasErrors = true;
        }

        if (hasErrors) return

        $.ajax({
            url: '../routes/web.php',
            type: 'POST',
            data: { REQUEST_URI: '/events/store', data: formData, },
            success: (response) => {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '!Exito¡',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        //window.location.href = '?page=events'
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