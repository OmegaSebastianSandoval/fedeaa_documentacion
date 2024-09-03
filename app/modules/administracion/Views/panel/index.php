<div class="container-fluid">
	<div class="row">
		<div class="col-9 col-xl-10">
			<div class="div-dashboard">
				<h2>
					<img src="/skins/administracion/images/redessociales.png"> Redes Sociales <a href="/administracion/informacion/#redes"><i class="fas fa-marker"></i></a>
				</h2>
				<div align="center">
					<div align="center" class="redes">
						<div><img src="/skins/administracion/images/facebook.png"></div>
						<?php if ($this->info->info_pagina_facebook){ ?>
							<div><img src="/skins/administracion/images/chulo.png"></div>
						<?php }else{ ?>
							<div><img src="/skins/administracion/images/x.png"></i></div>
						<?php } ?>
					</div>
					<div align="center" class="redes">
						<div><img src="/skins/administracion/images/twitter.png"></div>
						<?php if ($this->info->info_pagina_twitter){ ?>
							<div><img src="/skins/administracion/images/chulo.png"></div>
						<?php }else{ ?>
							<div><img src="/skins/administracion/images/x.png"></i></div>
						<?php } ?>
					</div>
					<div align="center" class="redes">
						<div><img src="/skins/administracion/images/instagram.png"></div>
						<?php if ($this->info->info_pagina_instagram){ ?>
							<div><img src="/skins/administracion/images/chulo.png"></div>
						<?php }else{ ?>
							<div><img src="/skins/administracion/images/x.png"></i></div>
						<?php } ?>
					</div>
					<div align="center" class="redes">
						<div><img src="/skins/administracion/images/pinterest.png"></div>
						<?php if ($this->info->info_pagina_pinterest){ ?>
							<div><img src="/skins/administracion/images/chulo.png"></div>
						<?php }else{ ?>
							<div><img src="/skins/administracion/images/x.png"></i></div>
						<?php } ?>
					</div>
					<div align="center" class="redes">
						<div><img src="/skins/administracion/images/youtube.png"></div>
						<?php if ($this->info->info_pagina_youtube){ ?>
							<div><img src="/skins/administracion/images/chulo.png"></div>
						<?php }else{ ?>
							<div><img src="/skins/administracion/images/x.png"></i></div>
						<?php } ?>
					</div>
					<div align="center" class="redes">
						<div><img src="/skins/administracion/images/google.png"></div>
						<?php if ($this->info->info_pagina_google){ ?>
							<div><img src="/skins/administracion/images/chulo.png"></div>
						<?php }else{ ?>
							<div><img src="/skins/administracion/images/x.png"></i></div>
						<?php } ?>
					</div>
					<div align="center" class="redes">
						<div><img src="/skins/administracion/images/linkedin.png"></div>
						<?php if ($this->info->info_pagina_linkedin){ ?>
							<div><img src="/skins/administracion/images/chulo.png"></div>
						<?php }else{ ?>
							<div><img src="/skins/administracion/images/x.png"></i></div>
						<?php } ?>
					</div>
					<div align="center" class="redes">
						<div><img src="/skins/administracion/images/flickr.png"></div>
						<?php if ($this->info->info_pagina_flickr){ ?>
							<div><img src="/skins/administracion/images/chulo.png"></div>
						<?php }else{ ?>
							<div><img src="/skins/administracion/images/x.png"></i></div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-3 col-xl-2">
			<div class="div-whatsapp">
				<div>
					<img src="/skins/administracion/images/whatsapp.png">
					<h2>Whatsapp:</h2>
					<p><?php echo $this->info->info_pagina_whatsapp; ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="div-dashboard">
		<h2>
			<img src="/skins/administracion/images/informaciondecotactenos.png"> Información de Contáctenos <a href="/administracion/informacion/#contactenos"><i class="fas fa-marker"></i></a>
		</h2>
		<div class="pading-dashboard">
			<div class="row">
				<div class="col-4">
					<div class="contenedor-informacion">
						<div class="icono telefono">
							<img src="/skins/administracion/images/telefono.png" >
						</div>
						<div class="contenido">
							<h4>Teléfonos:</h4>
							<div><?php echo $this->info->info_pagina_telefono; ?></div>
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="contenedor-informacion">
						<div class="icono correo">
							<img src="/skins/administracion/images/correo.png" >
						</div>
						<div class="contenido">
							<h4>Correo Contacto:</h4>
							<div><?php echo $this->info->info_pagina_correos_contacto; ?></div>
						</div>
					</div>
				</div>

				<div class="col-4">
					<div class="contenedor-informacion">
						<div class="icono direccion">
							<img src="/skins/administracion/images/direccion.png" >
						</div>
						<div class="contenido">
							<h4>Dirección:</h4>
							<div><?php echo $this->info->info_pagina_direccion_contacto; ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="div-dashboard">
		<h2>
			<img src="/skins/administracion/images/googlemaps.png"> Google Maps <a href="/administracion/informacion/#maps"><i class="fas fa-marker"></i></a>
		</h2>
		<div class="pading-dashboard">
			<div class="row">
				<div class="col-3">
					<div class="contenedor-informacion">
						<div class="icono-mapa latitud">
							<img src="/skins/administracion/images/mapa-latitud.png">
						</div>
						<div class="contenido">
							<h4>Latitud:</h4>
							<?php echo $this->info->info_pagina_latitud; ?>
						</div>
					</div>
					<div class="contenedor-informacion">
						<div class="icono-mapa longitud">
							<img src="/skins/administracion/images/mapa-longitud.png">
						</div>
						<div class="contenido">
							<h4>Longitud:</h4>
							<?php echo $this->info->info_pagina_longitud; ?>
						</div>
					</div>
					<div class="contenedor-informacion">
						<div class="icono-mapa zoom">
							<img src="/skins/administracion/images/mapa-zoom.png">
						</div>
						<div class="contenido">
							<h4>Zoom:</h4>
							<?php echo $this->info->info_pagina_zoom; ?>
						</div>
					</div>
				</div>
				<div class="col-9">
					<div class="mapa">
						<div id="map" style="width:100%; height:100%;display: inline-block;"></div>
						<script type="text/javascript">
							setValuesMap('<?php echo $this->info->info_pagina_latitud; ?>','<?php echo $this->info->info_pagina_longitud; ?>',true,'<?php echo $this->info->info_pagina_zoom; ?>');
							google.maps.event.addDomListener(window, 'load', initializeMap);
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="div-dashboard">
		<h2>
			<img src="/skins/administracion/images/seo.png"> Archivo SEO <a href="/administracion/informacion/#seo"><i class="fas fa-marker"></i></a>
		</h2>
		<div class="pading-dashboard">
			<div class="row">
				<div class="col-4">
					<h5> Descripción: </h5>
					<div class="contenedor-informacion">
						<div class="icono-seo descripcion">
							<img src="/skins/administracion/images/descripcion.png" >
						</div>
						<div class="contenido">
							<div><?php echo $this->info->info_pagina_descripcion; ?></div>
						</div>
					</div>
				</div>
				<div class="col-4">
					<h5> Tags: </h5>
					<div class="contenedor-informacion">
						<div class="icono-seo tags">
							<img src="/skins/administracion/images/tags.png" >
						</div>
						<div class="contenido">
							<div><?php echo $this->info->info_pagina_tags; ?></div>
						</div>
					</div>
				</div>
				<div class="col-4">
					<h5> Archivos SEO: </h5>
					<div class="contenedor-informacion">
						<div class="icono-seo archivos">
							<img src="/skins/administracion/images/archivos-seo.png" >
						</div>
						<div class="contenido">
							<a  <?php if ($this->info->info_pagina_robot): ?>href="/robots.txt" target="_blank"<?php endif ?> class="btn btn-block btn-robot <?php if(!$this->info->info_pagina_robot){ ?>disabled <?php } ?>"><i class="fas fa-robot"></i> Robot</a>
							<br>
							<a <?php if ($this->info->info_pagina_sitemap){ ?>href="/sitemap.xml" target="_blank"<?php } ?> class="btn btn-block btn-sitemap <?php if(!$this->info->info_pagina_sitemap){ ?>disabled <?php } ?>"> <i class="fas fa-sitemap"></i> SiteMap</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="div-dashboard">
		<h2>
			<img src="/skins/administracion/images/logo-scripts.png"> Scripts Head <a href="/administracion/informacion/#scripts"><i class="fas fa-marker"></i></a>
		</h2>
		<div class="pading-dashboard">
			<div class="row">
				<div class="col-5">
					<div class="contenedor-informacion">
						<div class="icono-seo scripts">
							<img src="/skins/administracion/images/scripts.png">
						</div>
						<div class="contenido">
							<h4>Scripts:</h4>
							<?php echo  htmlentities($this->info->info_pagina_scripts); ?>
						</div>
					</div>
				</div>
				<div class="col-7">
					<div class="contenedor-informacion">
						<div class="icono-seo log">
							<img src="/skins/administracion/images/log-de-usuario.png">
						</div>
						<div class="contenido">
							<h4>Log de usuarios:</h4>
							<table width="100%" class="tabla_log">
								<tr>
									<th>Usuario</th>
									<th>Fecha ingreso</th>
									<th>Hora ingreso</th>
									<th><a href="/administracion/log/"><button class="btn-xs btn-azul-claro">Detalle</button></a></th>
								<tr>
								<?php foreach ($this->log as $log): ?>
									<?php $aux = explode(" ",$log->log_fecha); ?>
									<tr>
										<td><?php echo $log->log_usuario; ?></td>
										<td><?php echo $aux[0]; ?></td>
										<td><?php echo $aux[1]; ?></td>
										<td><a href="/administracion/log/?log_usuario=<?php echo $log->log_usuario; ?>"><button class="btn-xs btn-verde-claro">Detalle</button></a></td>
									</tr>
								<?php endforeach ?>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="div-dashboard">
		<h2>
			<i class="fas fa-chart-pie"></i> Métricas <a href="/administracion/informacion/#metricas"><i class="fas fa-marker"></i></a>
		</h2>
		<div class="pading-dashboard">
			<div class="row">
				<div class="col-12">
					<div class="contenedor-informacion">
						<div class="contenido">
							<?php echo $this->info->info_pagina_metricas; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br>