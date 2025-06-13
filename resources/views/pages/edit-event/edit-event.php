<div>
    <h1 class="fw-bold">Editar Evento</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <a href="?page=events" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver
            </a>
            <div class="card">
                <div class="card-header">
                    <h4>Editar Evento</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="place" class="form-label">Lugar</label>
                            <input type="text" class="form-control" id="place" name="place" required>
                        </div>
                        <div class="mb-3">
                            <label for="place" class="form-label">Fecha</label>
                            <input type="text" class="form-control" id="place" name="place" required>
                        </div>
                        <div class="mb-3">
                            <label for="place" class="form-label">Estado</label>
                            <select class="form-select" name="status" id="status">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>