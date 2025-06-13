<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h2 class="card-title">
                        <i class="fas fa-hand-wave me-2"></i>
                        ¡Bienvenido, <?php echo $_SESSION['user']['name'] ?? 'Usuario' ?>!
                    </h2>
                    <p class="card-text">
                        Panel de administración del sistema Cuidado de Sí
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>