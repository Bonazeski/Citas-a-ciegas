<?php
include_once(__DIR__ . '/../../../controlador/seguridad.php');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/citasaciegas/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/citasaciegas/vista/csspersonalizado/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Mi perfil | Citas a ciegas</title>
</head>
<body class="fondo-gris">
    <?php include(__DIR__ . '/../navbar.php');?>
    
    <main class="container mt-5 mb-5 col-12 col-lg-8"> 
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            
            <h1 class="h1 mb-0 degradado-texto">Mi perfil</h1>
            
            <div class="d-flex">
                
                <a href="/citasaciegas/controlador/editarperfil.php" class="btn btn-outline-primary me-2" role="button">Editar perfil</a>

                <a href="/citasaciegas/controlador/editarusuario.php" class="btn btn-outline-secondary" role="button">Editar usuario</a>
                
            </div>
            
        </div>

        <section class="card shadow-sm border-0 mb-4 p-4">
            
            <div class="d-flex align-items-start mb-2">
                <i class="color1 bi bi-person-fill fs-2 me-3 text-primary"></i>
                <div>
                    <p class="mb-0 fs-3 fw-bold"><?php echo $perfil['nombre']; ?></p>
                </div>
            </div>
            
            <div class="d-flex align-items-start mb-3">
                <i class="bi bi-envelope fs-5 me-3 text-secondary"></i>
                <div>
                    <p class="mb-0 text-dark"><?php echo $usuario['email']; ?> <span class="small text-muted fst-italic">(Solo tú puedes verlo)</span></p>
                </div>
            </div>
            
            <div class="d-flex align-items-start mb-3">
                <i class="bi bi-cake2 fs-5 me-3 text-secondary"></i>
                <p class="mb-0 text-dark">Fecha de nacimiento: <?php echo $perfil['fecha_nac']; ?></p>
            </div>
            <div class="d-flex align-items-start mb-3">
                <i class="bi bi-stars fs-5 me-3 text-secondary"></i>
                <p class="mb-0 text-dark"> 
                    <?php echo "Sexo ". $sexoperfil['sex']. ", género " . $generoperfil['genero'] . ", "
                     . $orientacionperfil['orientacionsexual'];?>
                </p>
            </div>
            <div class="d-flex align-items-start mb-3">
                <i class="bi bi-pin-map fs-5 me-3 text-secondary"></i>
                <p class="mb-0 text-dark">
                    <?php echo $departamentoperfil['departamento']. ", " . $provinciaperfil['provincia']; ?>
                </p>
            </div>
        </section>
        <!--si hay datos en gustos y preferencias cargados, se visualizan los mismos, sino:-->
        <section class="card shadow-sm border-0 mb-4 p-4">
            <h2 class="h5 card-title mb-3">Gustos y preferencias</h2>

            <?php foreach ($gustosypreferencias as $gusto): ?>
                <p class="mb-2"><?= $gusto ?></p>
            <?php endforeach; ?>
        </section>


        <section class="card shadow-sm border-0 mb-5 p-4">
            <h2 class="h5 card-title mb-3">Mi descripción</h2>
            <p class="mb-0">
                <?php echo $perfil['libredescripcion']; ?>
            </p>
        </section>
        <div class="d-flex justify-content-end">
            <!-- Botón que abre el modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmarEliminacion">
                Eliminar perfil
            </button>
        </div>
        <!-- Modal de confirmación de eliminación -->
        <div class="modal fade" id="confirmarEliminacion" tabindex="-1" aria-labelledby="confirmarEliminacionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-sm">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmarEliminacionLabel">Eliminar perfil</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">¿Estás seguro de que deseas eliminar tu perfil de forma permanente? 
                    Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                    <!-- Este formulario ejecuta la eliminación -->
                    <form action="/citasaciegas/controlador/eliminarperfil.php" method="post" class="d-inline">
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                    </form>
                </div>
                </div>
            </div>
        </div>


    </main>

    <?php include(__DIR__ . '/../footer.php');?>
    <script src="/citasaciegas/vista/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>