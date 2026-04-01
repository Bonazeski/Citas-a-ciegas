<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">

        <!-- Ruta hacia el controlador del inicio -->
        <a class="navbar-brand me-auto" href="/citasaciegas/controlador/inicio.php"> 
            Cita a ciegas 
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            
            <ul class="navbar-nav"> 
                <li class="nav-item">
                    <a class="nav-link" href="/citasaciegas/controlador/miperfil.php">Mi perfil</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/citasaciegas/controlador/perfiles.php">Perfiles</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/citasaciegas/controlador/miscitas.php">Citas</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/citasaciegas/controlador/devoluciones.php">Devoluciones</a>
                </li>
            </ul>

            <!-- Botón de cierre de sesión -->
            <a href="/citasaciegas/controlador/logout.php" class="btn btn-primary ms-auto">
                Salir &rarr;
            </a>
        </div>
    </div>
</nav>
