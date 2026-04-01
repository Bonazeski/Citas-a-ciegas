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
  <title>Perfiles | Citas a ciegas</title>
</head>

<body class="d-flex flex-column min-vh-100 fondo-gris">
<?php include(__DIR__ . '/../navbar.php'); ?>

<main class="container py-4 flex-grow-1">
  <h1 class="mb-3">Explorar perfiles</h1>
  <p class="text-muted">Mostrando resultados según tus filtros seleccionados.</p>

  <form method="GET" action="/citasaciegas/controlador/perfiles.php" class="row g-4" id="filtroForm">

    <!-- Columna 1: Ubicación -->
    <div class="col-md-4">
      <div class="btn-group w-100">
        <button type="button" class="btn btn-outline-primary dropdown-toggle w-100" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-geo-alt"></i> Ubicación
        </button>
        <ul class="dropdown-menu p-3" style="min-width: 280px;">
          <li><label class="form-label">Provincia</label></li>
          <li>
            <select name="provincia" id="provincia" class="form-select mb-3">
              <option value="">Seleccionar provincia...</option>
              <?php foreach ($provincias as $prov): ?>
                <option value="<?= $prov['idprovincia'] ?>" <?= ($filtros['provincia'] == $prov['idprovincia']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($prov['provincia']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </li>

          <li><label class="form-label">Departamento</label></li>
          <li>
            <select name="departamento" id="departamento" class="form-select" <?= empty($filtros['provincia']) ? 'disabled' : '' ?>>
              <option value="">Seleccionar departamento...</option>
              <?php if (!empty($departamentos)): ?>
                <?php foreach ($departamentos as $dep): ?>
                  <option value="<?= $dep['iddepa'] ?>" <?= ($filtros['departamento'] == $dep['iddepa']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($dep['departamento']) ?>
                  </option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </li>
        </ul>
      </div>
    </div>

    <!-- Columna 2: Datos personales -->
    <div class="col-md-4">
      <div class="btn-group w-100">
        <button type="button" class="btn btn-outline-success dropdown-toggle w-100" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person"></i> Datos personales
        </button>
        <ul class="dropdown-menu p-3" style="min-width: 280px;">
          <li><label class="form-label">Sexo</label></li>
          <li>
            <select name="sexo" class="form-select mb-3">
              <option value="">Cualquiera</option>
              <?php foreach ($sexos as $s): ?>
                <option value="<?= $s['idsexo'] ?>" <?= ($filtros['sexo'] == $s['idsexo']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($s['sex']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </li>

          <li><label class="form-label">Género</label></li>
          <li>
            <select name="genero" class="form-select mb-3">
              <option value="">Cualquiera</option>
              <?php foreach ($generos as $g): ?>
                <option value="<?= $g['idgenero'] ?>" <?= ($filtros['genero'] == $g['idgenero']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($g['genero']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </li>

          <li><label class="form-label">Orientación sexual</label></li>
          <li>
            <select name="orientacion" class="form-select">
              <option value="">Cualquiera</option>
              <?php foreach ($orientaciones as $o): ?>
                <option value="<?= $o['idorientacion'] ?>" <?= ($filtros['orientacion'] == $o['idorientacion']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($o['orientacionsexual']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </li>
        </ul>
      </div>
    </div>

    <!-- Columna 3: Gustos e intereses -->
    <div class="col-md-4">
      <div class="btn-group w-100">
        <button type="button" class="btn btn-outline-warning dropdown-toggle w-100" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-stars"></i> Gustos e intereses
        </button>
        <ul class="dropdown-menu p-3" style="min-width: 280px;">
          <li><label class="form-label">Tiempo libre</label></li>
          <li>
            <select name="tiempolibre" class="form-select mb-3">
              <option value="">Cualquiera</option>
              <?php foreach ($tiemposLibres as $t): ?>
                <option value="<?= $t['id_tiempo_libre'] ?>" <?= ($filtros['tiempoLibre'] == $t['id_tiempo_libre']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($t['actividad']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </li>

          <li><label class="form-label">Cita ideal</label></li>
          <li>
            <select name="citaideal" class="form-select mb-3">
              <option value="">Cualquiera</option>
              <?php foreach ($citasIdeales as $c): ?>
                <option value="<?= $c['id_cita_ideal'] ?>" <?= ($filtros['citaIdeal'] == $c['id_cita_ideal']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($c['cita_ideal']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </li>

          <li><label class="form-label">Relación personal</label></li>
          <li>
            <select name="relacion" class="form-select mb-3">
              <option value="">Cualquiera</option>
              <?php foreach ($relaciones as $r): ?>
                <option value="<?= $r['id_relacion'] ?>" <?= ($filtros['relacion'] == $r['id_relacion']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($r['descripcion_relacion']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </li>

          <li><label class="form-label">Estilo de vida</label></li>
          <li>
            <select name="estilo" class="form-select mb-3">
              <option value="">Cualquiera</option>
              <?php foreach ($estilosDeVida as $e): ?>
                <option value="<?= $e['id_estilo'] ?>" <?= ($filtros['estilo'] == $e['id_estilo']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($e['estilo_de_vida']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </li>

          <li><label class="form-label">Motivación del día</label></li>
          <li>
            <select name="motivacion" class="form-select">
              <option value="">Cualquiera</option>
              <?php foreach ($motivaciones as $m): ?>
                <option value="<?= $m['id_motivacion'] ?>" <?= ($filtros['motivacion'] == $m['id_motivacion']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($m['motivacion_del_dia']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </li>
        </ul>
      </div>
    </div>

    <!-- Botones de acción -->
    <div class="col-12 text-end mt-4">
      <button type="submit" class="btn btn-primary">Buscar perfiles</button>
      <a href="/citasaciegas/controlador/perfiles.php" class="btn btn-outline-secondary">Limpiar filtros</a>
    </div>

  </form>

  <div class="mt-4">
    <h3>Resultados</h3>

    <?php if (!empty($perfiles)) { ?>
      <div class="d-flex flex-column gap-3">
        <?php foreach ($perfiles as $p) { ?>
          <div class="card shadow-sm w-100">
            <div class="card-body">
              <h5 class="card-title mb-2"><?= htmlspecialchars($p['nombre']) . " " . htmlspecialchars($p['apellido']) ?></h5>

              <p class="card-text border-top mb-2 pt-2">
                <b>Descripción: </b><br>
                <?= htmlspecialchars($p['libredescripcion']) ?>
              </p>

              <?php if ($tieneCitaActiva): ?>
                <button class="btn btn-secondary w-100" disabled>
                    No podés solicitar una cita hasta finalizar la actual
                </button>
            <?php else: ?>
                <form action="/citasaciegas/controlador/solicitarcita.php" method="GET">
                    <input type="hidden" name="receptor" value="<?= $p['idusuario'] ?>">
                    <button class="btn btn-outline-success">Solicitar cita</button>
                </form>
            <?php endif; ?>


            </div>
          </div>
        <?php } ?>
      </div>

    <?php } else { ?>
      <p class="text-muted">No se encontraron perfiles con los filtros seleccionados.</p>
    <?php } ?>
  </div>

</main>

<?php include(__DIR__ . '/../footer.php'); ?>
<script src="/citasaciegas/vista/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>

<script>
// Este array se genera desde PHP con todos los departamentos
const departamentosPorProvincia = <?= json_encode($departamentosTodos ?? obtenerdepartamentos()); ?>;

const provinciaSelect = document.getElementById('provincia');
const departamentoSelect = document.getElementById('departamento');

provinciaSelect.addEventListener('change', function() {
  const provinciaSeleccionada = this.value;

  departamentoSelect.innerHTML = '<option value="">Seleccionar departamento...</option>';

  if (provinciaSeleccionada === '') {
    departamentoSelect.disabled = true;
    return;
  }

  const departamentosFiltrados = departamentosPorProvincia.filter(
    dep => dep.idprovincia === provinciaSeleccionada
  );

  departamentosFiltrados.forEach(dep => {
    const option = document.createElement('option');
    option.value = dep.iddepa;
    option.textContent = dep.departamento;
    departamentoSelect.appendChild(option);
  });

  departamentoSelect.disabled = false;
});
</script>

</body>
</html>
