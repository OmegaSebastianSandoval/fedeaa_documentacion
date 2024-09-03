<div class='carouselsection' >
	<div class='left_scroll'> <i class="fas fa-caret-left"></i> </div>
	<div class="carousel_inner">
		<ul>
			<?php $colorfondo = $columna->contenido_fondo_color; ?>
			<?php foreach ($carrousel as $key => $contenido): ?>
				<li>

					<?php include($disenio); ?>
				</li>
			<?php endforeach ?>
		</ul>
	</div>
	<div class='right_scroll'> <i class="fas fa-caret-right"></i>  </div>
</div>