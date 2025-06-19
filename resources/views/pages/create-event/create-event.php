<div class="container-fluid h-100 d-flex flex-column">
    <div class="">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="fw-bold">Crear Evento</h1>
            <a href="?page=events" class="btn btn-secondary fw-bold">
                <i class="fas fa-arrow-left me-2"></i>Volver 
            </a>
        </div>
    </div>
    <div class="flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="row w-100 justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card p-2 border-0 shadow">
                    <div class="card-body">
                        <form action="" method="POST" id="form">
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control border-0 border-bottom rounded-0" id="name" name="name" placeholder="Nombre">
                                <label for="name" class="form-label">Nombre</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control border-0 border-bottom rounded-0" id="place" name="place" placeholder="Lugar" >
                                <label for="place" class="form-label">Lugar</label>
                            </div>
                            <div class="form-floating mb-2">  
                                <input type="date" class="form-control border-0 border-bottom rounded-0" id="date" name="date" placeholder="Fecha" min="<?php echo date('Y-m-d'); ?>" >
                                <label for="date" class="form-label">Fecha</label>
                            </div>
                            <div class="my-4">
                                <label for="banner" class="form-label">Banner del Evento</label>
                                <input type="file" class="filepond" id="banner" name="event_banner" accept="image/*">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg" id="submit">
                                    <i class="fas fa-save me-2"></i>Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>