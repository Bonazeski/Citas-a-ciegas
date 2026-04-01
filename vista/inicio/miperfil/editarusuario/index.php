<?php
include_once(__DIR__ . '/../../../../controlador/seguridad.php');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/citasaciegas/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="/citasaciegas/vista/csspersonalizado/style.css">

    <title>Editar usuario | Citas a ciegas</title>
</head>
<body class="fondo-gris">
<main class="container d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh;">
    
    <h1 class="text-center display-6 mb-5 mt-5"> 🖤 Editar usuario </h1>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger text-center col-12 col-md-10 col-lg-8 mb-4">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    
    <div class="col-12 col-md-10 col-lg-8 mb-5">    

        <form action="/citasaciegas/controlador/editarusuario.php" method="POST">
            <section class="card p-4 shadow-sm border-0 rounded-5 mb-4">
                <div class="card-body">
                <h5 class="card-title mb-4">Datos de usuario</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                    <label for="nombreuser" class="form-label">Nombre de usuario: *</label>
                    <input type="text" class="form-control" name="nombreuser" id="nombreuser" required
                            placeholder="Nombre de usuario"
                            value="<?= htmlspecialchars($usuario['user'])?>">
                    </div>

                    <div class="col-md-6">
                    <label for="email" class="form-label">Email: *</label>
                    <input type="email" class="form-control" name="email" id="email" required
                            placeholder="Email"
                            value="<?= htmlspecialchars($usuario['email'])?>">
                    </div>

                    <div class="col-md-6">
                    <label for="pass" class="form-label">Contraseña: *</label>
                    <div class="input-group">
                        <input type="password" name="pass" id="pass" class="form-control" required minlength="8"
                            placeholder="Contraseña"
                            value="<?= isset($pass) ? htmlspecialchars($pass) : '' ?>">
                        <button class="btn" type="button" id="togglePass">
                        <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <div class="form-text">Debe contener mínimo 8 caracteres</div>
                    </div>

                    <div class="col-md-6">
                    <label for="pass2" class="form-label">Confirmar contraseña: *</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="pass2" id="pass2" required
                            placeholder="Confirmar contraseña"
                            value="<?= isset($pass2) ? htmlspecialchars($pass2) : '' ?>">
                        <button class="btn" type="button" id="togglePass2">
                        <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    </div>
                </div>
                </div>
            </section>
            <div class="d-grid gap-2 mb-3 mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Registrarse</button>
            </div>
              
        
        </form>

    </div>
</main>

<script>
const pass = document.getElementById('pass');
const pass2 = document.getElementById('pass2');

function validarCoincidencia() {
  if (pass.value !== pass2.value) {
    pass2.setCustomValidity('Las contraseñas no coinciden.');
    pass2.classList.add('is-invalid');
    pass2.classList.remove('is-valid');
  } else {
    pass2.setCustomValidity('');
    pass2.classList.remove('is-invalid');
    pass2.classList.add('is-valid');
  }
}

// Detectar cualquier cambio en los campos (teclado, pegar, autocompletar)
['input', 'paste', 'keyup'].forEach(evento => {
  pass.addEventListener(evento, validarCoincidencia);
  pass2.addEventListener(evento, validarCoincidencia);
});

// Mostrar / ocultar contraseña
document.getElementById('togglePass').addEventListener('click', function() {
  const input = document.getElementById('pass');
  const icon = this.querySelector('i');
  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.replace('bi-eye', 'bi-eye-slash');
  } else {
    input.type = 'password';
    icon.classList.replace('bi-eye-slash', 'bi-eye');
  }
});

document.getElementById('togglePass2').addEventListener('click', function() {
  const input = document.getElementById('pass2');
  const icon = this.querySelector('i');
  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.replace('bi-eye', 'bi-eye-slash');
  } else {
    input.type = 'password';
    icon.classList.replace('bi-eye-slash', 'bi-eye');
  }
});
</script>
</body>
</html>