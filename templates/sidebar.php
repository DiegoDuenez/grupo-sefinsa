<?php

$ruta = basename($_SERVER['PHP_SELF']);

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Nuevo proyecto</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            </div>
                <div class="info">
                <a href="#" class="d-block" id="usuario">...</a>
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
                        <li class="nav-item">
                            <a href="usuarios.php " class="nav-link <?php if($ruta == 'usuarios.php') echo ' active'; ?>">
                                <i class="fa-solid fa-users"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="rutas.php" class="nav-link <?php if($ruta == 'rutas.php') echo ' active'; ?>">
                                <i class="fa-solid fa-route"></i>
                                <p>Rutas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="poblaciones.php" class="nav-link <?php if($ruta == 'poblaciones.php') echo ' active'; ?>">
                                <i class="fa-solid fa-map-location-dot"></i>
                                <p>Poblaciones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="empleados.php" class="nav-link <?php if($ruta == 'empleados.php') echo ' active'; ?>">
                                <i class="fa-solid fa-users"></i>
                                <p>Empleados</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="colocadoras.php" class="nav-link <?php if($ruta == 'colocadoras.php') echo ' active'; ?>">
                                <i class="fa-solid fa-users"></i>
                                <p>Colocadoras</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="clientes.php"  class="nav-link <?php if($ruta == 'clientes.php') echo ' active'; ?>">
                                <i class="fa-solid fa-handshake"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                    </li>
                </ul>
            </li>


            <!--
            <li class="nav-item has-treeview ">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-route"></i>
                    <p>
                    Rutas
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <li class="nav-item">
                            <a href="rutas_empleado.php" class="nav-link <?php if($ruta == 'rutas_empleado.php') echo ' active'; ?>">
                                <i class="fa-solid fa-route"></i>
                                <p>Rutas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-user"></i>
                                <p>Rutas por empleado</p>
                            </a>
                        </li>
                    </li>
                </ul>
            </li>-->



            <li class="nav-item"> 
                <a  class="nav-link" id="cerrarSesion" style="cursor: pointer;" onclick="logout()">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <p>Cerrar sesión</p>
                </a>
            </li>


        </ul>

        
    </nav>
    </div>
</aside>

