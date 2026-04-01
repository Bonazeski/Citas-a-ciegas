<?php
include_once(__DIR__ . '/../../../controlador/seguridad.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/citasaciegas/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/citasaciegas/vista/csspersonalizado/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Citas | Citas a ciegas</title>
</head>
<body class="bg-body-secondary">

<?php include(__DIR__ . '/../navbar.php'); ?>

<div class="container mt-4">
    <h1 class="fw-bold mb-2">Gestión de citas</h1>
    <p class="text-muted">Detalles de tus solicitudes de citas.</p>
</div>

<?php if (!empty($alerta)) echo $alerta; ?>

<?php if ($tieneCitaActiva && $haySolicitud): ?>
    <div class="alert alert-warning container">
        Tenés una cita pendiente o aceptada. Para aceptar otra solicitud, primero finalizá o cancelá la actual.
    </div>
<?php endif; ?>

<div class="container bg-light shadow-sm rounded p-4 mt-4">

    <table class="table table-bordered table-striped mt-2">
        <thead class="table-dark">
            <tr>
                <th>Perfil</th>
                <th>Punto de encuentro</th>
                <th>Fecha y hora</th>
                <th>Detalles</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($citas as $cita): ?>
                <tr>

                    <td>
                        <?php
                        if ($cita['perfil1'] == $_SESSION['usuario_id']) {
                            echo $cita['nombre_receptor'] . ' ' . $cita['apellido_receptor'];
                        } else {
                            echo $cita['nombre_solicitante'] . ' ' . $cita['apellido_solicitante'];
                        }
                        ?>
                    </td>

                    <td>
                        <?php if ($cita['puedoVerDetalles']): ?>
                            <?= htmlspecialchars($cita['place_name']) ?><br>
                            <small class="text-muted"><?= htmlspecialchars($cita['place_address']) ?></small><br>
                            <a href="https://www.google.com/maps?q=<?= urlencode($cita['latitud'] . ',' . $cita['longitud']) ?>" 
                               target="_blank" class="text-decoration-none">Ver mapa</a>
                        <?php else: ?>
                            <span class="text-muted">Detalles ocultos hasta aceptar la cita</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if ($cita['puedoVerDetalles']): ?>
                            <?= $cita['fecha'] ?>, a las: <?= $cita['hora'] ?>
                        <?php else: ?>
                            <span class="text-muted">Detalles ocultos hasta aceptar la cita</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if ($cita['puedoVerDetalles']): ?>
                            <?= $cita['detalle'] ?>
                        <?php else: ?>
                            <span class="text-muted">Detalles ocultos hasta aceptar la cita</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php
                        switch ($cita['estadocita']) {
                            case 1: echo 'En proceso'; break;
                            case 2: echo 'Pendiente'; break;
                            case 3: echo 'Aceptada'; break;
                            case 4: echo 'Cancelada'; break;
                            case 5: echo 'Finalizada'; break;
                            default: echo 'Desconocido';
                        }
                        ?>
                    </td>

                    <td>
                        <?php if ($cita['estadocita'] == 1): ?>
                            <?php if ($cita['soyReceptor']): ?>
                                <?php if ($tieneCitaActiva): ?>
                                    <button class="btn btn-secondary btn-sm" disabled>Aceptar</button>
                                <?php else: ?>
                                    <form method="post" action="/citasaciegas/controlador/miscitas.php" class="d-inline">
                                        <input type="hidden" name="accion" value="aceptar_inicial">
                                        <input type="hidden" name="idcita" value="<?= $cita['id_cita'] ?>">
                                        <button class="btn btn-success btn-sm">Aceptar</button>
                                    </form>
                                <?php endif; ?>

                                <form method="post" action="/citasaciegas/controlador/miscitas.php" class="d-inline">
                                    <input type="hidden" name="accion" value="cancelar">
                                    <input type="hidden" name="idcita" value="<?= $cita['id_cita'] ?>">
                                    <button class="btn btn-danger btn-sm">Cancelar</button>
                                </form>

                            <?php else: ?>
                                <form method="post" action="/citasaciegas/controlador/miscitas.php" class="d-inline">
                                    <input type="hidden" name="accion" value="cancelar">
                                    <input type="hidden" name="idcita" value="<?= $cita['id_cita'] ?>">
                                    <button class="btn btn-danger btn-sm">Cancelar</button>
                                </form>
                            <?php endif; ?>

                        <?php elseif ($cita['estadocita'] == 2): ?>

                            <?php if ($cita['soyReceptor']): ?>

                                <form method="post" action="/citasaciegas/controlador/editarcita.php" class="d-inline">
                                    <input type="hidden" name="idcita" value="<?= $cita['id_cita'] ?>">
                                    <button class="btn btn-warning btn-sm">Modificar</button>
                                </form>

                                <?php if (!$cita['ultimoPropusoSoyYo']): ?>
                                    <form method="post" action="/citasaciegas/controlador/miscitas.php" class="d-inline">
                                        <input type="hidden" name="accion" value="aceptar_definitivo">
                                        <input type="hidden" name="idcita" value="<?= $cita['id_cita'] ?>">
                                        <button class="btn btn-info btn-sm">Aceptar</button>
                                    </form>
                                <?php endif; ?>

                                <form method="post" action="/citasaciegas/controlador/miscitas.php" class="d-inline">
                                    <input type="hidden" name="accion" value="cancelar">
                                    <input type="hidden" name="idcita" value="<?= $cita['id_cita'] ?>">
                                    <button class="btn btn-danger btn-sm">Cancelar</button>
                                </form>

                            <?php else: ?>

                                <?php if (!$cita['ultimoPropusoSoyYo']): ?>

                                    <form method="post" action="/citasaciegas/controlador/editarcita.php" class="d-inline">
                                        <input type="hidden" name="idcita" value="<?= $cita['id_cita'] ?>">
                                        <button class="btn btn-warning btn-sm">Modificar</button>
                                    </form>

                                    <form method="post" action="/citasaciegas/controlador/miscitas.php" class="d-inline">
                                        <input type="hidden" name="accion" value="aceptar_definitivo">
                                        <input type="hidden" name="idcita" value="<?= $cita['id_cita'] ?>">
                                        <button class="btn btn-info btn-sm">Aceptar</button>
                                    </form>

                                <?php else: ?>
                                    <span class="text-muted d-block mb-1">Esperando respuesta del otro usuario</span>
                                <?php endif; ?>

                                <form method="post" action="/citasaciegas/controlador/miscitas.php" class="d-inline">
                                    <input type="hidden" name="accion" value="cancelar">
                                    <input type="hidden" name="idcita" value="<?= $cita['id_cita'] ?>">
                                    <button class="btn btn-danger btn-sm">Cancelar</button>
                                </form>

                            <?php endif; ?>

                        <?php elseif ($cita['estadocita'] == 3): ?>

                            <form method="post" action="/citasaciegas/controlador/miscitas.php" class="d-inline">
                                <input type="hidden" name="accion" value="cancelar">
                                <input type="hidden" name="idcita" value="<?= $cita['id_cita'] ?>">
                                <button class="btn btn-danger btn-sm">Cancelar</button>
                            </form>

                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<div class="container bg-light shadow-sm rounded p-4 mt-4 mb-5">
    <h2 class="fw-semibold mb-3">Historial de citas</h2>
</div>

<?php include(__DIR__ . '/../footer.php'); ?>

<script src="/citasaciegas/vista/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>