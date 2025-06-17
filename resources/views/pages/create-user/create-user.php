<div class="container-fluid h-100 d-flex flex-column">
    <div class="">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="fw-bold">Crear Usuario</h1>
            <a href="?page=users" class="btn btn-secondary fw-bold">
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
                                <input type="text" class="form-control border-0 border-bottom rounded-0" id="username" name="username" placeholder="Nombre de Usuario" >
                                <label for="username" class="form-label">Nombre de Usuario</label>
                            </div>
                            <div class="form-floating mb-2">  
                                <input type="email" class="form-control border-0 border-bottom rounded-0" id="email" name="email" placeholder="Correo Electronico" >
                                <label for="email" class="form-label">Correo Electronico</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="password" class="form-control border-0 border-bottom rounded-0" id="password" name="password" placeholder="Contraseña">
                                <label for="password" class="form-label">Contraseña</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control border-0 border-bottom rounded-0" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña" >
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            </div>
                            <div class="mb-4">
                                <select class="form-select border-0 border-bottom rounded-0" name="role" id="role" placeholder="Rol">
                                    <option disabled selected value="">Seleccione un rol</option>
                                    <option value="admin">Administrador</option>
                                </select>
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