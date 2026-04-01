<?php
include_once(__DIR__ . '/../../controlador/seguridad.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/citasaciegas/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/citasaciegas/vista/csspersonalizado/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <title>Inicio del sistema | Citas a ciegas</title>
</head>
<body class="fondo-gris d-flex flex-column min-vh-100">
    
    <div id="wrapper" class="flex-grow-1"> 
        
        <?php include(__DIR__ . '/navbar.php'); ?>

        <main class="container mt-5 mb-5">
            
            <h1 class="h1">Inicio del sitio</h1>
            <p class="lead mb-5">Descripción del inicio del sitio</p>

            <div class="row g-4"> 
                
                <!-- Mi Perfil -->
                <div class="col-12 col-md-6">
                    <div class="card shadow-sm h-100 position-relative">
                        <div class="card-body d-flex align-items-center">
                            <i class="color1 bi bi-person-fill fs-3 me-3"></i>
                            <div>
                                <h5 class="card-title mb-0">Mi Perfil</h5> 
                                <p class="card-text small mb-0">Gestiona tus datos, fotos y preferencias.</p>
                            </div>
                            <a href="/citasaciegas/controlador/miperfil.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <!-- Perfiles -->
                <div class="col-12 col-md-6">
                    <div class="card shadow-sm h-100 position-relative">
                        <div class="card-body d-flex align-items-center">
                            <i class="color2 bi bi-search-heart-fill fs-3 me-3"></i>
                            <div>
                                <h5 class="card-title mb-0">Explorar Perfiles</h5>
                                <p class="card-text small mb-0">Busca y filtra usuarios según tus criterios.</p>
                            </div>
                            <a href="/citasaciegas/controlador/perfiles.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <!-- Citas -->
                <div class="col-12 col-md-6">
                    <div class="card shadow-sm h-100 position-relative">
                        <div class="card-body d-flex align-items-center">
                            <i class="color3 bi bi-calendar-heart fs-3 me-3"></i>
                            <div>
                                <h5 class="card-title mb-0">Mis Citas</h5>
                                <p class="card-text small mb-0">Revisa las solicitudes de citas y tu agenda.</p>
                            </div>
                            <a href="/citasaciegas/controlador/citas.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <!-- Devoluciones -->
                <div class="col-12 col-md-6">
                    <div class="card shadow-sm h-100 position-relative">
                        <div class="card-body d-flex align-items-center">
                            <i class="color4 bi bi-book-half fs-3 me-3"></i>
                            <div>
                                <h5 class="card-title mb-0">Devoluciones</h5>
                                <p class="card-text small mb-0">Procesa devoluciones y pagos pendientes.</p>
                            </div>
                            <a href="/citasaciegas/controlador/devoluciones.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
    </div> 
    
    <?php include(__DIR__ . '/footer.php'); ?> 
<script src="/citasaciegas/vista/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
