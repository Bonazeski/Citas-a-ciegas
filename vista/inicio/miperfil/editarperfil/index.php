<?php
include_once(__DIR__ . '/../../../../controlador/seguridad.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/citasaciegas/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/citasaciegas/vista/csspersonalizado/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Editar perfil | Citas a ciegas</title>
</head>

<body class="fondo-gris">
<main class="container mt-5 mb-5">
    <h1 class="text-center display-6 mb-5 mt-5"> 🖤 Editar perfil </h1>
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger text-center col-12 col-md-10 col-lg-8 mb-4">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="/citasaciegas/controlador/editarperfil.php" method="post" class="card p-4 shadow-sm border-0 rounded-5">
        <div class="card-body">
            <!-- ===================== DATOS PERSONALES ===================== -->
            <h5 class="card-title mb-4">Datos personales</h5>

            <div class="row g-3">
                <!-- Nombre -->
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" 
                           required value="<?= htmlspecialchars($perfil['nombre']) ?>">
                </div>

                <!-- Apellido -->
                <div class="col-md-6">
                    <label for="apellido" class="form-label">Apellido *</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" 
                           required value="<?= htmlspecialchars($perfil['apellido']) ?>">
                </div>

                <!-- Fecha de nacimiento -->
                <div class="col-md-6">
                    <label for="nacimiento" class="form-label">Fecha de nacimiento *</label>
                    <input type="date" class="form-control" id="nacimiento" name=""
                           value="<?= htmlspecialchars($perfil['fecha_nac']) ?>" readonly>
                </div>

                <!-- Provincia -->
                <div class="col-md-6">
                    <label for="provincia" class="form-label">Provincia *</label>
                    <select name="provincia" id="provincia" class="form-select" required>
                        <?php foreach ($provincias as $p): ?>
                            <option value="<?= $p['idprovincia']; ?>"
                                <?= ($perfil['idprovincia'] == $p['idprovincia']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($p['provincia']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Departamento -->
                <div class="col-md-6">
                    <label for="departamento" class="form-label">Departamento *</label>
                    <select name="departamento" id="departamento" class="form-select" required>
                        <?php foreach ($departamentos as $d): ?>
                            <option value="<?= $d['iddepa']; ?>"
                                <?= ($perfil['iddepa'] == $d['iddepa']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($d['departamento']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Sexo -->
                <div class="col-md-6">
                    <label for="sexo" class="form-label">Sexo *</label>
                    <select name="sexo" id="sexo" class="form-select" required>
                        <?php foreach ($sexos as $s): ?>
                            <option value="<?= $s['idsexo']; ?>"
                                <?= ($perfil['idsexo'] == $s['idsexo']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($s['sex']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Género -->
                <div class="col-md-6">
                    <label for="genero" class="form-label">Género *</label>
                    <select name="genero" id="genero" class="form-select" required>
                        <?php foreach ($generos as $g): ?>
                            <option value="<?= $g['idgenero']; ?>"
                                <?= ($perfil['idgenero'] == $g['idgenero']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($g['genero'] . " - " . $g['descripcion']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Orientación sexual -->
                <div class="col-md-6">
                    <label for="orientacion" class="form-label">Orientación sexual *</label>
                    <select name="orientacion" id="orientacion" class="form-select" required>
                        <?php foreach ($orientacionessexuales as $os): ?>
                            <option value="<?= $os['idorientacion']; ?>"
                                <?= ($perfil['idorientacion'] == $os['idorientacion']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($os['orientacionsexual'] . " - " . $os['descripcion']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
        </div>

        <!-- ===================== GUSTOS Y PREFERENCIAS ===================== -->
        <div class="card-body border-top mt-4 pt-4">
            <h5 class="card-title mb-4">Gustos y preferencias</h5>

            <div class="row g-3">
                <!-- Tiempo libre -->
                <div class="col-md-6">
                    <label for="tiempolibre" class="form-label">En mi tiempo libre me gusta...</label>
                    <select name="tiempolibre" id="tiempolibre" class="form-select">
                        <option value="">Selecciona una opción</option>
                        <?php foreach ($tiempolibre as $t): ?>
                            <option value="<?= $t['id_tiempo_libre']; ?>"
                                <?= ($perfil['id_tiempo_libre'] == $t['id_tiempo_libre']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($t['posible_respuesta']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Cita ideal -->
                <div class="col-md-6">
                    <label for="citaideal" class="form-label">Mi cita ideal sería...</label>
                    <select name="citaideal" id="citaideal" class="form-select">
                        <option value="">Selecciona una opción</option>
                        <?php foreach ($citaideal as $c): ?>
                            <option value="<?= $c['id_cita_ideal']; ?>"
                                <?= ($perfil['id_cita_ideal'] == $c['id_cita_ideal']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($c['posible_respuesta']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Relación personal -->
                <div class="col-md-6">
                    <label for="relacion" class="form-label">Creo que algo importante en una relacion es...</label>
                    <select name="relacion" id="relacion" class="form-select">
                        <option value="">Selecciona una opción</option>
                        <?php foreach ($relacionespersonales as $r): ?>
                            <option value="<?= $r['id_relacion']; ?>"
                                <?= ($perfil['id_relacion'] == $r['id_relacion']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($r['posible_respuesta']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Estilo de vida -->
                <div class="col-md-6">
                    <label for="estilo" class="form-label">Mi estilo de vida es...</label>
                    <select name="estilo" id="estilo" class="form-select">
                        <option value="">Selecciona una opción</option>
                        <?php foreach ($estilodevida as $e): ?>
                            <option value="<?= $e['id_estilo']; ?>"
                                <?= ($perfil['id_estilo'] == $e['id_estilo']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($e['posible_respuesta']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Motivación del día -->
                <div class="col-md-6">
                    <label for="motivacion" class="form-label">Mi motivación diaria es...</label>
                    <select name="motivacion" id="motivacion" class="form-select">
                        <option value="">Selecciona una opción</option>
                        <?php foreach ($motivacionesdeldia as $m): ?>
                            <option value="<?= $m['id_motivacion']; ?>"
                                <?= ($perfil['id_motivacion'] == $m['id_motivacion']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($m['posible_respuesta']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                 <!-- Descripción -->
                <div class="col-12 border-top mt-4 pt-4">
                    <label for="descripcion" class="form-label">Descripción *</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required><?= htmlspecialchars($perfil['libredescripcion']) ?></textarea>
                </div>
            </div>
        </div>

        <!-- ===================== BOTÓN GUARDAR ===================== -->
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary btn-lg">Guardar cambios</button>
        </div>
    </form>
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

</body>
</html>
