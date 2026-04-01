<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/citasaciegas/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/citasaciegas/vista/csspersonalizado/style.css">

    
    <title>Inicio de sesión | Citas a ciegas</title>
</head>
<body class="fondo-gris">
<main class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    
    <div class="col-12 col-md-8 col-lg-5">
        
        <div class="card p-4 shadow-lg border-0 rounded-5">
            <div class="card-body"> 
                
                <h1 class="text-center display-6 mb-4">🖤Título</h1>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger text-center rounded-4 py-2">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                
                <form action="/citasaciegas/controlador/iniciarsesion.php" method="POST">
                    
                    <div class="mb-4">
                        <label for="user" class="form-label">Nombre de usario *</label>
                        <input type="text" class="form-control" id="user" name="user" required placeholder="Usuario"
                        value="<?= isset($user) ? htmlspecialchars($user) : '' ?>">
                    </div>
                   
                    
                    <div class="mb-4">
                        <label for="pass" class="form-label">Contraseña *</label>
                        <input type="password" class="form-control" id="pass" name="pass" required placeholder="Contrseña">
                    </div>
                    
                    
                   
                    <p class="text-start small mb-4">
                        ¿Olvidaste tu contraseña? <a href="#" class="enlacevioleta text-decoration-none"> Recuperar contraseña</a> 
                    </p>
                     <div class="d-grid gap-2 mb-3">
                        <input type="submit" class="btn btn-primary btn-lg" Value="Acceder">
                    </div>
                    <p class="text-center small">
                        ¿Aún no tienes una cuenta? <a href="/citasaciegas/controlador/registrarse.php" class=" enlacevioleta text-decoration-none">Registrate</a> 
                    </p>
                </form>
                
            </div>
        </div>
        
    </div>
</main>
<script src="/citasaciegas/vista/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>