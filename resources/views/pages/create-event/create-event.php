<form action="" method="POST" id="form" enctype="multipart/form-data">
    <h1>Crear Evento</h1>
    <div class="form-floating mb-3">
        <input class="form-control border-0 border-bottom rounded-0 " type="text" name="name" id="name" placeholder="Nombre" maxlength="255">
        <label for="name">Nombre</label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control border-0 border-bottom rounded-0"  type="text" name="place" id="place" placeholder="Lugar" maxlength="255">
        <label for="place">Lugar</label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control border-0 border-bottom rounded-0" type="date" name="date" id="date" min="<?php echo date('Y-m-d') ?>" placeholder="Fecha">
        <label for="date">Fecha</label>
    </div>
    <div class="mb-3">
        <label for="banner">Banner</label>
        <input type="file" class="my-pond" name="filepond" accept="image/png, image/jpeg, image/gif"/>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" type="submit">
            Guardar
        </button>
    </div>
</form>