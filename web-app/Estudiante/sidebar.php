    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo __SERVER__.'web-app/Login/'; ?>" class="brand-link">
        <img src="<?php echo __SERVER__.__DIST__; ?>img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="text-info">VINCULACION<span class="text-success"><sub> v1.0</sub></span></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">        

        <!-- Sidebar Menu -->
        <nav class="mt-5">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">            
            <li class="nav-item has-treeview">
              <a href="<?php echo __SERVER__.'web-app/Login/'; ?> " class="nav-link">                
                <p>
                  Home                  
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">              
                <p>
                  Requerimiento                  
                  <span class="badge badge-info right"><?php echo count($requerimiento->consulta_pendiente_requerimiento_estudiante_business()); ?> (Pendiente)</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="Pendiente.php" class="nav-link">
                    <i class="far fa-clock nav-icon"></i>
                    <p>Pendientes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="Resuelto.php" class="nav-link">
                    <i class="fas fa-clipboard-check nav-icon"></i>
                    <p>Resueltos</p>
                  </a>
                </li>                
              </ul>
            </li> 
            <li class="nav-item has-treeview">
              <a href="Evidencia.php" class="nav-link">              
                <p>
                  Evidencias                  
                </p>
              </a>              
            </li>
            <li class="nav-item has-treeview">
              <a href="Certificado.php" class="nav-link">              
                <p>
                  Certificado
                </p>
              </a>              
            </li>
            <li>
              <div class="user-panel mt-3 pb-3 mb-3 d-flex"></div>
            </li>            
            <li class="nav-item has-treeview">              
              <a id="btnLogout" class="nav-link" href="
                <?php               
                  echo $usuario->encryption($_SESSION['token_vin']); 
                ?>">
                <p>
                  Cerrar Sesi&oacute;n              
                  <i class="fas fa-sign-out-alt right"></i>
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>