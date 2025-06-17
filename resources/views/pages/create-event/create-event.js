$(function () {
    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
        FilePondPluginImageCrop,
        FilePondPluginImageResize,
        FilePondPluginImageTransform,
        FilePondPluginImageEdit
    );

    FilePond.create(
        document.querySelector('input'),
        {
            labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            styleLoadIndicatorPosition: 'center bottom',
            styleProgressIndicatorPosition: 'right bottom',
            styleButtonRemoveItemPosition: 'left bottom',
            styleButtonProcessItemPosition: 'right bottom',
        }
    );

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
            date: $('#date').val()
        }
        clearError('#name')
        clearError('#place')
        clearError('#date')

        if (!formData.name) {
            showError('#name', 'El nombre es requerido')
            hasErrors = true
        } else if (formData.name.lenght > 255) {
            showError('#name', 'El nombre no puede ser mayor a 255 caracteres')
        }

        if (!formData.place) {
            showError('#place', 'El lugar es requerido')
            hasErrors = true
        }

        if (!formData.date) {
            showError('#date', 'La fecha es requerida')
            hasErrors = true
        }

        if (hasErrors) return
    })
})