<div>
	<div class="row">
		<div <?php if($contenido->contenido_imagen){ ?>class="col-sm-7"<?php } else { ?>class="col-sm-12"<?php } ?>>
			<div class="descripcion">
				<?php echo $contenido->contenido_descripcion; ?>
			</div>
		</div>
		<?php if($contenido->contenido_imagen){ ?>
			<div class="col-sm-5">
				<div class="text-center"><img src="/images/<?php echo $contenido->contenido_imagen; ?>"></div>
			</div>
		<?php } ?>
	</div>
</div>