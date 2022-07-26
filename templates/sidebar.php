<?php

$ruta = basename($_SERVER['PHP_SELF']);

?>

<aside class="main-sidebar sidebar-light-secondary elevation-4">
    <a href="usuarios.php" class="brand-link">
        <img src="resources/assets/logo.png" alt="Grupo SEFINSA" class="brand-image " title="GRUPO SEFINSA" style="width: 10rem;">
        <br>
        <span span class="brand-text font-weight-light  d-none">GRUPO SEFINSA</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            </div>
            <div class="info">
                <a href="#" class="d-block" id="usuario">... </a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview menu-open ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa-solid fa-book"></i>
                        <p>
                            Catálogos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <li class="nav-item d-none" id="Perfiles">
                                <a href="perfiles.php" class="nav-link <?php if ($ruta == 'perfiles.php') echo ' active'; ?>">
                                    <i class="fa-solid fa-user"></i>
                                    <p>Perfiles</p>
                                </a>
                            </li>
                            <li class="nav-item d-none" id="Usuarios">
                                <a href="usuarios.php " class="nav-link <?php if ($ruta == 'usuarios.php') echo ' active'; ?>">
                                    <i class="fa-solid fa-users"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                            <li class="nav-item d-none" id="Empleados">
                                <a href="empleados.php" class="nav-link <?php if ($ruta == 'empleados.php') echo ' active'; ?>">
                                    <i class="fa-solid fa-users"></i>
                                    <p>Empleados</p>
                                </a>
                            </li>
                            <li class="nav-item d-none" id="Rutas">
                                <a href="rutas.php" class="nav-link <?php if ($ruta == 'rutas.php') echo ' active'; ?>">
                                    <i class="fa-solid fa-route"></i>
                                    <p>Rutas</p>
                                </a>
                            </li>
                            <li class="nav-item d-none" id="Poblaciones">
                                <a href="poblaciones.php" class="nav-link <?php if ($ruta == 'poblaciones.php') echo ' active'; ?>">
                                    <i class="fa-solid fa-map-location-dot"></i>
                                    <p>Poblaciones</p>
                                </a>
                            </li>
                            <li class="nav-item d-none" id="Colocadoras">
                                <a href="colocadoras.php" class="nav-link <?php if ($ruta == 'colocadoras.php') echo ' active'; ?>">
                                    <i class="fa-solid fa-users"></i>
                                    <p>Colocadoras</p>
                                </a>
                            </li>
                            <li class="nav-item d-none" id="Clientes">
                                <a href="clientes.php" class="nav-link <?php if ($ruta == 'clientes.php') echo ' active'; ?>">
                                    <i class="fa-solid fa-handshake"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>
                            <li class="nav-item d-none" id="Prestamos">
                                <a href="prestamos.php" class="nav-link <?php if ($ruta == 'prestamos.php') echo ' active'; ?>">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                    <p>Prestamos</p>
                                </a>
                            </li>
                            <li class="nav-item d-none" id="Pagos">
                                <a href="pagos.php" class="nav-link <?php if ($ruta == 'pagos.php') echo ' active'; ?>">
                                    <i class="fa-solid fa-money-bill"></i>
                                    <p>Pagos</p>
                                </a>
                            </li>
                    </li>

                </ul>
            </li>
            <li class="nav-item d-none" id="Configuraciones">
                <a href="configuraciones.php" class="nav-link <?php if ($ruta == 'configuraciones.php') echo ' active'; ?>">
                    <i class="fa-solid fa-gears"></i>
                    <p>Configuraciones</p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="cerrarSesion" style="cursor: pointer;" onclick="logout()">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <p>Cerrar sesión</p>
                </a>
            </li>

            </ul>

        </nav>
    </div>
</aside>


