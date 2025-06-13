<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuidado de Si</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="login.css">
</head>

<body class="vh-100">
    <main class="d-flex align-items-center justify-content-center vh-100">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="text-center mb-4">
                        <h1 class="fw-bold">Cuidado de Sí</h1>
                        <p class="text-muted">¡Bienvenido al sistema!</p>
                    </div>
                    <form action="#" method="POST" id="form" class="p-4 border rounded shadow">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control border-0 border-bottom rounded-0" id="email"
                                name="email" placeholder="name@example.com" autocomplete="email">
                            <label for="email">Correo Electrónico</label>
                            <i
                                class="fas fa-envelope position-absolute end-0 top-50 translate-middle-y me-3 text-muted"></i>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control border-0 border-bottom rounded-0" id="password"
                                name="password" placeholder="Contraseña" autocomplete="current-password">
                            <label for="password">Contraseña</label>
                            <i class="fas fa-lock position-absolute end-0 top-50 translate-middle-y me-3 text-muted"
                                style="cursor: pointer;" onclick="togglePassword(this)"></i>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-dark btn-lg w-100" type="submit">
                                Iniciar Sesión
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="login.js"></script>
</body>

</html>