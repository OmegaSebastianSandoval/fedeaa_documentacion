<div class="slider-simple">
	<div id="carouselsimple<?php echo $contenedor->contenido_id;  ?>" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php foreach ($rescontenido['hijos'] as $resbanner){ ?>
				<?php $banner = $resbanner['detalle']; ?>
				<li data-target="#carouselsimple<?php echo $contenedor->contenido_id;  ?>" data-slide-to="0"  <?php if($key == 0){ ?>class="active"<?php }  ?>></li>
			<?php } ?>
		</ol>
		<div class="carousel-inner">
			<?php foreach ($rescontenido['hijos'] as $key => $resbanner){ ?>
				<?php $banner = $resbanner['detalle']; ?>
				<div class="carousel-item <?php if($key == 0){ ?>active <?php } ?>">
					<img class="d-block w-100" src="/images/<?php echo $banner->contenido_fondo_imagen; ?>" alt="<?php echo $banner->publicidad_titulo; ?>">
					<div class="carousel-caption d-flex h-100 align-items-center  <?php if($banner->contenido_columna_alineacion == 2){ ?>justify-content-center <?php } else if($banner->contenido_columna_alineacion == 3){ ?> justify-content-end  <?php } else { ?> justify-content-start  <?php } ?>">
						<div class="<?php echo $banner->contenido_columna; ?>" >
							<div class="content-caption" style="background-color:<?php echo $banner->contenido_fondo_color; ?> ">
								<?php if($banner->contenido_titulo_ver==1){ ?>
									<h2><?php echo $banner->contenido_titulo; ?></h2>
								<?php } ?>
								<div><?php echo $banner->contenido_descripcion; ?></div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<a class="carousel-control-prev" href="#carouselsimple<?php echo $contenedor->contenido_id;  ?>" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselsimple<?php echo $contenedor->contenido_id;  ?>" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>