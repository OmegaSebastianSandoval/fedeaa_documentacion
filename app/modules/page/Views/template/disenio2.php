<div class="caja-contenido-simple" style="background-color: <?php if($contenido->contenido_fondo_color){ echo  $contenido->contenido_fondo_color;  } else if($colorfondo){ echo $colorfondo; }   ?>">
	<?php if($contenido->contenido_titulo_ver == 1){ ?>
		<h2><?php echo $contenido->contenido_titulo; ?></h2>
	<?php } ?>
	<div class="row">
		<?php if($contenido->contenido_imagen){ ?>
			<div class="col-sm-5">
				<div class="text-center"><img src="/images/<?php echo $contenido->contenido_imagen; ?>"></div>
			</div>
		<?php } ?>
		<div <?php if($contenido->contenido_imagen){ ?>class="col-sm-7"<?php } else { ?>class="col-sm-12"<?php } ?>>
			<div class="descripcion">
				<?php echo $contenido->contenido_descripcion; ?>
			</div>
			<div>
				<a href="" class="btn btn-block btn-vermas"> <?php if( $contenido->contenido_vermas){ ?><?php echo $contenido->contenido_vermas; ?><?php } else { ?>Ver Más<?php } ?></a>
			</div>
		</div>
		
	</div>
</div>