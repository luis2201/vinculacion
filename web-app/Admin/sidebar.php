    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo __SERVER__; ?>" class="brand-link">
        <!--<img src="<?php //echo __SERVER__.__DIST__; ?>img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
        <span class="text-info" style="color: #e94e1b  !important;">VINCULACION<span class="text-light"><sub> v1.0</sub></span></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">                
        <!-- Sidebar Menu -->
        <nav class="mt-5">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
              <a href="<?php echo __SERVER__.'web-app/Login'; ?> " class="nav-link">                
                <p>
                  Home
                  <i class="fas fa-home right"></i>
                </p>                
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">                            
                <p>
                  Registro
                  <i class="fas fa-angle-left right"></i>                  
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="Carrera.php" class="nav-link">
                    <i class="nav-icon fas fa-university nav-icon"></i>
                    <p>Carrera</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="Tutor.php" class="nav-link">
                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                    <p>Tutor</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="Estudiante.php" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <p>Estudiante</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="TipoRequerimiento.php" class="nav-link">
                    <i class="far fa-list-alt nav-icon"></i>
                    <p>Tipo Requerimiento</p>
                  </a>
                </li>                
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="Solicitud.php" class="nav-link">                
                <p>
                  Solicitud
                  <span class="badge badge-info right"><?php echo count($asistencia->consulta_todos_asistencia_business()); ?>
                </p>                
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="Seguimiento.php" class="nav-link">                
                <p>
                  Seguimiento
                  <i class="far fa-calendar-alt right"></i>
                </p>                
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">                
                <p>
                  Encuesta
                  <i class="fas fa-angle-left right"></i>
                </p>                
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="Pregunta.php" class="nav-link">
                    <i class="nav-icon fas fa-question nav-icon"></i>
                    <p>Pregunta</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="Resultado.php" class="nav-link">
                    <i class="fas fa-chart-bar nav-icon"></i>
                    <p>Resultados</p>
                  </a>
                </li>            
              </ul>
            </li>
            <li class="nav-item">
              <a id="btnLogout" class="nav-link" data-widget="control-sidebar" data-slide="true" href="<?php echo $usuario->encryption($_SESSION['token_vin']); ?>" role="button">
                Salir
                <i class="fas fa-power-off right"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>