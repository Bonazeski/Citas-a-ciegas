<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/citasaciegas/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="/citasaciegas/vista/csspersonalizado/style.css">

    <title>Registrarse | Citas a ciegas</title>
</head>
<body class="fondo-gris">
<main class="container d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh;">
    
    <h1 class="text-center display-6 mb-5 mt-5"> 🖤 Registro de usuario </h1>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger text-center col-12 col-md-10 col-lg-8 mb-4">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    
    <div class="col-12 col-md-10 col-lg-8 mb-5">    

        <form action="/citasaciegas/controlador/registrarse.php" method="POST">
            <section class="card p-4 shadow-sm border-0 rounded-5 mb-4">
                <div class="card-body">
                <h5 class="card-title mb-4">Datos de usuario</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                    <label for="nombreuser" class="form-label">Nombre de usuario: *</label>
                    <input type="text" class="form-control" name="nombreuser" id="nombreuser" required
                            placeholder="Nombre de usuario"
                            value="<?= isset($nombreuser) ? htmlspecialchars($nombreuser) : '' ?>">
                    </div>

                    <div class="col-md-6">
                    <label for="email" class="form-label">Email: *</label>
                    <input type="email" class="form-control" name="email" id="email" required
                            placeholder="Email"
                            value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
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

            <section class="card p-4 shadow-sm border-0 rounded-5 mb-4">
                <div class="card-body">
                <h5 class="card-title mb-4">Datos personales</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre: *</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required
                            placeholder="Nombre"
                            value="<?= isset($nombre) ? htmlspecialchars($nombre) : '' ?>">
                    </div>

                    <div class="col-md-6">
                    <label for="apellido" class="form-label">Apellido: *</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" required
                            placeholder="Apellido"
                            value="<?= isset($apellido) ? htmlspecialchars($apellido) : '' ?>">
                    </div>

                    <div class="col-md-6">
                    <label for="nacimiento" class="form-label">Fecha de nacimiento: *</label>
                    <input type="date" class="form-control" name="nacimiento" id="nacimiento"
                            required max="<?= date('Y-m-d') ?>"
                            value="<?= isset($nacimiento) ? htmlspecialchars($nacimiento) : '' ?>">
                    </div>

                    <div class="col-md-6">
                    <label for="provincia_selector" class="form-label">Provincia: *</label>
                    <select name="provincia" id="provincia_selector" class="form-select" required>
                        <option disabled <?= !isset($provincia_selector) ? 'selected' : '' ?> value="">
                        Seleccione su provincia *
                        </option>
                        <?php foreach ($provincias as $p): ?>
                        <option value="<?= $p['idprovincia']; ?>"
                            <?= (isset($provincia_selector) && $provincia_selector == $p['idprovincia']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p['provincia']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label for="departamento" class="form-label">Departamento: *</label>
                    <select name="departamento" id="departamento_selector" class="form-select" required>
                        <?php if (isset($departamento_selector)): ?>
                        <option value="<?= htmlspecialchars($departamento_selector) ?>" selected>Su selección anterior</option>
                        <?php else: ?>
                        <option selected disabled value="">Seleccione una provincia primero</option>
                        <?php endif; ?>
                    </select>
                    </div>

                    <div class="col-md-6">
                    <label for="sexo" class="form-label">Sexo: *</label>
                    <select name="sexo" id="sexo" class="form-select" required>
                        <option disabled <?= !isset($sexo) ? 'selected' : '' ?> value="">Seleccione su sexo *</option>
                        <?php foreach ($sexos as $s): ?>
                        <option value="<?= $s['idsexo']; ?>"
                            <?= (isset($sexo) && $sexo == $s['idsexo']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($s['sex']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    </div>

                    <div class="col-12">
                    <label for="genero" class="form-label">Género: *</label>
                    <select name="genero" id="genero" class="form-select" required>
                        <option disabled <?= !isset($genero) ? 'selected' : '' ?> value="">Seleccione su género *</option>
                        <?php foreach ($generos as $g): ?>
                        <option value="<?= $g['idgenero']; ?>"
                            <?= (isset($genero) && $genero == $g['idgenero']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($g['genero']." - ".$g['descripcion']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    </div>

                    <div class="col-12">
                    <label for="sexualidad" class="form-label">Orientación sexual: *</label>
                    <select name="sexualidad" id="sexualidad" class="form-select" required>
                        <option disabled <?= !isset($orientacionsexual) ? 'selected' : '' ?> value="">
                        Seleccione su orientación sexual *
                        </option>
                        <?php foreach ($orientacionessexuales as $os): ?>
                        <option value="<?= $os['idorientacion']; ?>"
                            <?= (isset($orientacionsexual) && $orientacionsexual == $os['idorientacion']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($os['orientacionsexual']." - ".$os['descripcion']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripción: *</label>
                        <div id="descripcionAyuda" class="bg-danger-subtle p-2 mb-2 rounded border">
                            <small class="text-dark">
                                <span class="fw-bold">¡Sé real y transparente!</span> Te invitamos a describirte a tu manera. Piensa en tu interior: ¿qué aspectos de la vida te representan? ¿Qué te apasiona? Incluye esas "cositas" que te caracterizan, <span class="fw-bold">sin miedo a mostrar tus matices o aquello que consideras menos perfecto.</span>
                                </small>
                            </div>
                            
                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required 
                            placeholder="Ejemplo: Soy una persona curiosa y un poco torpe. Me encanta la historia, pero odio lavar los platos. Busco alguien con quien compartir mis ratos libres y que no le importe mi obsesión por los gatos."><?= isset($descripcion) ? htmlspecialchars($descripcion) : '' ?></textarea>
                    </div>
                </div>
                </div>
            </section>

            <div class="d-grid gap-2 mb-3 mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Registrarse</button>
            </div>

            <p class="text-center small">
                ¿Ya tienes una cuenta?
                <a href="/citasaciegas/controlador/iniciarsesion.php" class="enlacevioleta text-decoration-none">Iniciar sesión aquí</a>
            </p>
        </form>

    </div>
</main>
<!--js para mostrar los departamentos segun la provincia seleccionada ODIO JS-->
<script>
    // 1. OBTENER LOS ELEMENTOS
    const provincia = document.getElementById('provincia_selector');
    const departamento = document.getElementById('departamento_selector');

    // 2. ESCUCHAR EL CAMBIO
    provincia.addEventListener('change', () => {
        const id = provincia.value;
        
        const url = '/citasaciegas/controlador/obtener_departamentos.php?id_provincia=' + id;
        
        fetch(url) // Envía la solicitud al servidor
            .then(res => res.json()) // Espera el JSON de vuelta
            .then(data => {
                let options = '<option selected disabled value="">Seleccione su departamento *</option>';
                
                // Construye el HTML con los datos (d = departamento)
                data.forEach(d => {
                    options += `<option value="${d.iddepa}">${d.departamento}</option>`;
                });

                departamento.innerHTML = options; // Reemplaza las opciones
            })
            // Opcional: Manejo de error para depuración
           // .catch(() => departamento.innerHTML = '<option disabled value="">Error de carga</option>');
    });
</script>
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