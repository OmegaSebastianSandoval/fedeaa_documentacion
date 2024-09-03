<ul>
	<li class="d-none" <?php if($this->botonpanel == 1){ ?>class="activo"<?php } ?>><a href="/administracion/panel"><i class="fas fa-info-circle"></i> Información pagina</a></li>
	<li class="d-none" <?php if($this->botonpanel == 2){ ?>class="activo"<?php } ?>><a href="/administracion/publicidad"><i class="far fa-images"></i> Administrar Banner</a></li>
	<li class="d-none" <?php if($this->botonpanel == 3){ ?>class="activo"<?php } ?>>><a href="/administracion/contenidos"><i class="fas fa-file-invoice"></i> Administrar Contenidos</a></li>

	<li <?php if($this->botonpanel == 5){ ?>class="activo"<?php } ?>><a href="/administracion/lineas"><i class="fas fa-file-invoice"></i> Líneas de crédito</a></li>
	<li <?php if($this->botonpanel == 6){ ?>class="activo"<?php } ?>><a href="/administracion/solicitudes"><i class="fas fa-file-invoice"></i> Solicitudes</a></li>

	<li <?php if($this->botonpanel == 4){ ?>class="activo"<?php } ?>><a href="/administracion/usuario"><i class="fas fa-users"></i> Administrar Usuarios</a></li>
</ul>