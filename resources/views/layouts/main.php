<div class="d-flex vh-100">
    <?php require_once __DIR__ . '/sidebar.php' ?>
    <div class="flex-grow-1 d-flex flex-column">
        <header class="bg-dark text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h4 m-0">Cuidado de Sí</h1>
            </div>
        </header>
        <main class="flex-grow-1 p-4 bg-light">
            <?php
            $page = $_GET['page'] ?? 'dashboard';
            $path = __DIR__ . "/../pages/{$page}/{$page}.php";


            if (file_exists($path)) {
                require_once $path;
            } else {
                require_once __DIR__ . "/../pages/not-found/not-found.php";
            }
            ?>
        </main>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

<?php
$pathjs = __DIR__ . "/../pages/{$page}/{$page}.js";
if (file_exists($pathjs)) {
    echo "<script src='../resources/views/pages/{$page}/{$page}.js'></script>";
}
?>