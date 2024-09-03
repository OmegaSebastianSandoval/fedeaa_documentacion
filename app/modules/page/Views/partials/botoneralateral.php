<ul>



	<!-- Configuracion -->



	<?php if ($this->level == 1 || $this->level == 4) { ?>
		<li class="nav-item <?php if ($this->botonpanel == 1) { ?>active<?php } ?> ">
			<a href="/page/asociados"><i class="fa-solid fa-users-between-lines"></i> Administrar Asociados</a>
		</li>
		<li class="nav-item <?php if ($this->botonpanel == 2) { ?>active<?php } ?> ">
			<a href="/page/documentos"><i class="fa-solid fa-file"></i> Administrar Documentos</a>
		</li>
		<li class="nav-item <?php if ($this->botonpanel == 3) { ?>active<?php } ?> ">
			<a href="/page/usuario"><i class="fa-solid fa-users"></i> Administrar Usuarios</a>
		</li>
		<li class="nav-item <?php if ($this->botonpanel == 4) { ?>active<?php } ?> ">
			<a href="/page/archivos"><i class="fa-solid fa-file-excel"></i> Cargar Archivo Asociado Asociados</a>
		</li>
	<?php } ?>

	<?php if ($this->level == 1 || $this->level == 4) { ?>
		<style>
			.button-panel {
				display: flex !important;
			}
		</style>
	<?php } ?>



</ul>