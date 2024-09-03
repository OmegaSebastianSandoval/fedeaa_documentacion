<div class="content-fluid">
	<div class="row sin-margin">
		<h1 class="titulo-principal py-2"><i class="fas fa-file-invoice"></i> <?php echo $this->titlesection; ?></h1>

		<div class="col-2 bd-sidebar ">
			<div id="jstree" class="botonera1">
				<?php print_r($this->menuV) ?>
			</div>
		</div>
		<article class="contenido_panel col-10">


			<section>
				<div class="container-fluid">
					<?php
					//  print_r($this->filters)
					?>
					<form action="<?php echo $this->route; ?>" method="post">
						<div class="content-dashboard">
							<div class="row">
								<div class="col-3 form-group">
									<label for="contenido_buscar" class="control-label">Busqueda</label>
									<label class="input-group">
										<input type="text" value="<?php echo $this->getArrayVariable($this->filters, 'contenido_buscar') ?>" class="form-control" name="contenido_buscar" placeholder="Buscar:" id="contenido_buscar">
									</label>
								</div>
								<div class="col-3 form-group">
									<label for="contenido_cedula_asociado" class="control-label">Cedula Asociado</label>
									<label class="input-group">

										<span class="input-group-text input-icono "><i class="fas fa-pencil-alt"></i></span>

										<input type="text" value="<?php echo $this->getArrayVariable($this->filters, 'contenido_cedula_asociado') ?>" name="contenido_cedula_asociado" id="contenido_cedula_asociado" placeholder="Cedula Asociado:" class="form-control" autofocus readonly required>
										<label class="control-label"> </label>
										<button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-azul btn-xs"><i class="fa-solid fa-magnifying-glass"></i></button>
									</label>
								</div>
								<div class="col-3">
									<label>Fecha inicio</label>
									<label class="input-group">

										<span class="input-group-text  input-icono"><i class="fa-solid fa-calendar"></i></span>

										<input type="date" class="form-control" name="contenido_fecha_inicio" value="<?php echo $this->getArrayVariable($this->filters, 'contenido_fecha_inicio') ?>"></input>
									</label>
								</div>
								<div class="col-3">
									<label>Fecha final</label>
									<label class="input-group">

										<span class="input-group-text input-icono "><i class="fa-solid fa-calendar"></i></span>

										<input type="date" class="form-control" name="contenido_fecha_fin" value="<?php echo $this->getArrayVariable($this->filters, 'contenido_fecha_fin') ?>"></input>
									</label>
								</div>
								<div class="col-3">
									<label class="form-label">Nombre</label>
									<label class="input-group">

										<span class="input-group-text input-icono "><i class="fas fa-pencil-alt"></i></span>

										<input type="text" class="form-control" placeholder="Nombre:" name="contenido_nombre" value="<?php echo $this->getArrayVariable($this->filters, 'contenido_nombre') ?>"></input>
									</label>
								</div>

								<div class="col-3">
									<label>Tags</label>
									<label class="input-group flex-nowrap">

										<span class="input-group-text input-icono "><i class="fas fa-pencil-alt"></i></span>

										<input type="text" class="form-control" data-role="tagsinput" name="contenido_tags" value="<?php echo $this->getArrayVariable($this->filters, 'contenido_tags') ?>"></input>
									</label>
								</div>

								<div class="col-6">
									<label>Descripcion</label>
									<label class="input-group">

										<span class="input-group-text input-icono "><i class="fas fa-pencil-alt"></i></span>

										<input type="text" class="form-control" placeholder="Descripcion:" name="contenido_descripcion" value="<?php echo $this->getArrayVariable($this->filters, 'contenido_descripcion') ?>"></input>
									</label>
								</div>
								<div class="col-6">
									<label>&nbsp;</label>
									<a class="btn btn-azul-claro " href="<?php echo $this->route; ?>?cleanfilter=1"> <i class="fas fa-eraser"></i> Limpiar Filtro</a>
								</div>
								<div class="col-6 d-grid">
									<label>&nbsp;</label>
									<button type="submit" class="btn btn-azul enviar"> <i class="fas fa-filter"></i> Filtrar</button>
								</div>
							</div>
						</div>
					</form>
					<div id="exampleModal" class="modal" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title morado">Cedula Asociado</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

								</div>
								<div class="modal-body">
									<table width="100%" class="tabla_contactos" id="myTable">
										<tr class="header">
											<th>Cedula</th>
											<th>Nombre</th>
											<th></th>
										</tr>
										<tr>
											<th><input class="ancho_filtro form-control" type="text" id="myInput1" onkeyup="filtrar_tabla(1)"></th>
											<th><input class="ancho_filtro form-control" type="text" id="myInput2" onkeyup="filtrar_tabla(2)"></th>
											<th></th>
										</tr>
										<?php foreach ($this->list_contenido_cedula_asociado as $key => $value): ?>
											<tr>
												<td><?php echo $key; ?></td>
												<td><?php echo $value; ?></td>
												<td align="center"><button class="btn btn-sm btn-morado" type="button" onclick=" set_contrato('<?php echo $key; ?>','<?php echo $value ?>'); document.getElementById('cerrar_modal1').click();">Seleccionar</button></td>
											</tr>
										<?php endforeach ?>
									</table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrar_modal1">Cerrar</button>
								</div>
							</div>
						</div>
					</div>

				</div>
				<? ?>
				<div class="container-fluid">
					<div class="content-dashboard">
						<?php if ($this->bread) { ?>
							<a href="/page/documentos?cleanfilter=1"><i class="fas fa-home"></i> Inicio</a> /
							<?php foreach ($this->bread as $key => $value) { ?>
								<?php echo $value; ?> /
							<?php } ?>
						<?php } else { ?>
							<a href="/page/documentos?cleanfilter=1"><i class="fas fa-home"></i> Inicio</a>
						<?php } ?>
					</div>
				</div>
				<div align="center">
					<ul class="pagination justify-content-center">
						<?php
						$url = $this->route;
						$min = $this->page - 10;
						$max = $this->page + 10;
						if ($this->totalpages > 1) {
							if ($this->page != 1) {
								echo '<li class="page-item" ><a class="page-link"  href="' . $url . '?page=' . ($this->page - 1) . '&padre=' . $_GET['padre'] . '"> &laquo; Anterior </a></li>';
							}
							for ($i = 1; $i <= $this->totalpages; $i++) {
								if ($this->page == $i) {
									echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
								} else {
									if ($i >= $min and $i <= $max) {
										echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '&padre=' . $_GET['padre'] . '">' . $i . '</a></li>  ';
									}
								}
							}
							if ($this->page != $this->totalpages) {
								echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '&padre=' . $_GET['padre'] . '">Siguiente &raquo;</a></li>';
							}
						}
						?>
					</ul>
				</div>
				<div class="container-fluid">
					<div class="content-dashboard">
						<div class="franja-paginas">

							<div id="div_masivo" class="row" style="display:none;">
								<h4>Carga masiva (puede arrastrar multiples archivos y carpetas)</h4>
								<iframe src="/scripts/dropzone/" width="100%" height="400" frameborder="0" class="mb-2"></iframe>
							</div>

							<div class="row">
								<div class="col-3">
									<div class="titulo-registro">SE ENCONTRARON <?php echo $this->register_number; ?> Registros</div>
								</div>
								<div class="col-2 text-right">
									<div class="texto-paginas">Registros por página:</div>
								</div>
								<div class="col-1">
									<select class="form-control form-control-sm selectpagination">
										<option value="20" <?php if ($this->pages == 20) {
																echo 'selected';
															} ?>>20</option>
										<option value="30" <?php if ($this->pages == 30) {
																echo 'selected';
															} ?>>30</option>
										<option value="50" <?php if ($this->pages == 50) {
																echo 'selected';
															} ?>>50</option>
										<option value="100" <?php if ($this->pages == 100) {
																echo 'selected';
															} ?>>100</option>
									</select>
								</div>
								<div class="col-5">
									<div class="row justify-content-between contenedor-enlaces">
										<?php if ($this->padre != 0) { ?>
											<?php if ($this->level == 1 || $this->level == 4) { ?>
												<div class="col-2">
													<a href="<?php echo $this->route; ?>?padre=<?= $this->ant ?>" class="btn btn-azul-1-claro btn-sm" title="Atras"><span class="fas fa-arrow-left"></span></a>
												</div>
												<div class="col-2">
													<a href="/page/documentos?cleanfilter=1" class="btn btn-azul-1-claro btn-sm ocultar_avanzado" title="Raiz"><span class="fas fa-home"></span></a>
												</div>
												<div class="col-2">
													<a class="btn btn-mostaza btn-sm" href="<?php echo $this->route . "/manage"; ?><?php if ($this->padre) {
																																		echo "?padre=" . $this->padre . "&tipo=5";
																																	} else {
																																		echo "?tipo=5";
																																	} ?>" title="Crear Carpeta"><i class="fas fa-plus"></i> <i class="fas fa-folder"></i></a>
												</div>
												<div class="col-2">
													<a class="btn btn-verde btn-sm" href="<?php echo $this->route . "/manage"; ?><?php if ($this->padre) {
																																		echo "?padre=" . $this->padre . "&tipo=0&op=1";
																																	} else {
																																		echo "?tipo=0&op=1";
																																	} ?>" title="Subir Archivo"><i class="fas fa-arrow-up"></i> <i class="fas fa-file"></i></a>
												</div>

												<?php if ($_GET['masivo'] == "") { ?>
													<div class="col-2">
														<a class="btn btn-verde btn-sm" title="Subir Masivo" onclick="$('#div_masivo').show();" style="cursor:pointer;"><i class="fas fa-arrow-up"></i> <i class="fas fa-cloud-upload-alt"></i></a>
													</div>
												<?php } ?>

											<?php } else if ($this->level == 2 && $this->com == true) { ?>
												<div class="col-3">
													<a href="<?php echo $this->route; ?>?padre=<?= $this->ant ?>" class="btn btn-azul-1-claro btn-sm" title="Atras"><span class="fas fa-arrow-left"></span></a>
												</div>
												<div class="col-3">
													<a href="/page/documentos?cleanfilter=1" class="btn btn-azul-1-claro btn-sm ocultar_avanzado" title="Raiz"><span class="fas fa-home"></span></a>
												</div>
												<div class="col-3">
													<a class="btn btn-mostaza btn-sm" href="<?php echo $this->route . "/manage"; ?><?php if ($this->padre) {
																																		echo "?padre=" . $this->padre . "&tipo=5";
																																	} else {
																																		echo "?tipo=5";
																																	} ?>" title="Crear Carpeta"><i class="fas fa-plus"></i> <i class="fas fa-folder"></i></a>
												</div>
												<div class="col-3">
													<a class="btn btn-verde btn-sm" href="<?php echo $this->route . "/manage"; ?><?php if ($this->padre) {
																																		echo "?padre=" . $this->padre . "&tipo=0&op=1";
																																	} else {
																																		echo "?tipo=0&op=1";
																																	} ?>" title="Subir Archivo"><i class="fas fa-arrow-up"></i> <i class="fas fa-file"></i></a>
												</div>



											<?php } else { ?>
												<div class="col-3">
													<a href="<?php echo $this->route; ?>?padre=<?= $this->ant ?>" class="btn btn-azul-1-claro btn-sm" title="Atras"><span class="fas fa-arrow-left"></span></a>
												</div>
												<div class="col-3">
													<a href="/page/documentos?cleanfilter=1" class="btn btn-azul-1-claro btn-sm ocultar_avanzado" title="Raiz"><span class="fas fa-home"></span></a>
												</div>
											<?php } ?>
										<?php } else { ?>
											<?php if (is_array($this->filters2) && sizeof($this->filters2) == 1) { ?>
												<div class="col-3">
												</div>
												<div class="col-3">
												</div>
												<?php if ($this->level == 1 || $this->level == 4) { ?>
													<div class="col-3">
														<a class="btn btn-mostaza btn-sm" href="<?php echo $this->route . "/manage"; ?><?php if ($this->padre) {
																																			echo "?padre=" . $this->padre . "&tipo=5";
																																		} else {
																																			echo "?tipo=5";
																																		} ?>"><i class="fas fa-plus"></i> <i class="fas fa-folder"></i></a>
													</div>
												<?php }  ?>
											<?php }  ?>
										<?php }  ?>
									</div>
								</div>
							</div>
						</div>
						<div class="content-table">
							<table class=" table table-striped  table-hover table-administrator text-left">
								<thead>
									<tr>
										<?php if (is_array($this->filters2) && sizeof($this->filters2) == 8) { ?>
											<td class="trans_table" style="width: 30%;"> Nombre</td>
											<td>Ruta</td>
										<?php } else { ?>
											<td class="trans_table" style="width: 50%;"> Nombre</td>
										<?php }  ?>
										<td>Fecha de Creación</td>
										<td>Fecha de Modificación</td>
										<?php if ($this->level == 1 || $this->level == 4) { ?>
											<td>Estado</td>
										<?php } ?>
										<?php if ($this->level == 1 || $this->level == 4 && sizeof($this->lists) != 0 || $this->level == 2 && $this->hijo == $this->cat && sizeof($this->lists) != 0) { ?>
											<td width="130"></td>
										<?php }  ?>
									</tr>
								</thead>
								<tbody>
									<?php //print_r($this->lists)
									?>
									<?php if (sizeof($this->lists) == 0) { ?>
										<tr>
											<td><?php echo "Este directorio está vacío." ?></td>
											<td></td>
											<td></td>
											<td></td>
										<tr>
										<?php } else {  ?>

											<?php foreach ($this->lists as $content) { ?>
												<?php $id =  $content->contenido_id; ?>
										<tr>
											<?php if ($content->contenido_tipo == 5) { ?>
												<?php if ($_GET['solicitudes'] == "") { ?>
													<td><a class="btn botones btn-sm trans_table" href="<?php echo $this->route; ?>?padre=<?= $id ?>&cleanfilter=1" data-bs-toggle="tooltip" data-placement="top" title="interna"><i class="fas fa-folder"></i>
															<p><?= $content->contenido_nombre; ?></p>
														</a>
													</td>
												<?php } else { ?>
													<td><a class="btn botones btn-sm trans_table" href="<?php echo $this->route; ?>?documento_creditos=1&credito=<?php echo $content->id; ?>&cleanfilter=1" data-bs-toggle="tooltip" data-placement="top" title="interna"><i class="fas fa-folder"></i>
															<p><?= $content->contenido_nombre; ?></p>
														</a>
													</td>
												<?php } ?>
											<?php } else if ($content->contenido_tipo == 4) { ?>
												<td><a data_ruta="<?php echo $this->host; ?>" data_archivo="<?php echo $content->contenido_archivo; ?>" class="btn btn-sm botones abrir" data-bs-toggle="tooltip" data-placement="top" title="imagen"><i class="far fa-file-image"></i><?= $content->contenido_nombre; ?></a></td>
											<?php } else if ($content->contenido_tipo == 2) { ?>
												<?php if ($_GET['solicitudes'] == 2) { ?>
													<?php if ($content->contenido_nombre == "Afiliacion pdf") { ?>
														<td><a class="btn btn-sm botones" href="<?php echo $content->contenido_archivo; ?>" target="_blank"><i class="far fa-file-pdf"></i><?= $content->contenido_nombre; ?></a></td>
													<?php } else { ?>
														<td><a target="_blank" href="http://fedeaaafiliaciones.omegasolucionesweb.com/files/<?php echo $content->contenido_archivo ?>" class="btn btn-sm botones" data-bs-toggle="tooltip" data-placement="top" title="pdf"><i class="far fa-file-pdf"></i><?= $content->contenido_nombre; ?></a></td>
													<?php } ?>
												<?php
													} else ?>
												<?php if ($_GET['documento_creditos'] == "" and $_GET['solicitudes'] != 2) { ?>
													<td><a data_ruta="<?php echo $this->host; ?>" data_archivo="<?php echo $content->contenido_archivo; ?>" class="btn btn-sm botones visualizar" data-bs-toggle="tooltip" data-placement="top" title="pdf"><i class="far fa-file-pdf"></i><?= $content->contenido_nombre; ?></a></td>
												<?php } else if ($_GET['solicitudes'] != 2) { ?>
													<?php if ($content->contenido_nombre == "Reporte Aseguradora") { ?>
														<td><a class="btn btn-sm botones" href="<?php echo $content->contenido_archivo; ?>" target="_blank"><i class="far fa-file-pdf"></i><?= $content->contenido_nombre; ?></a></td>

													<?php } else { ?>
														<td><a class="btn btn-sm botones" href="https://creditos.fedeaa.com/files/<?php echo $content->contenido_archivo; ?>" target="_blank"><i class="far fa-file-pdf"></i><?= $content->contenido_nombre; ?></a></td>
													<?php } ?>
												<?php } ?>
											<?php } else if ($content->contenido_tipo == 3) { ?>
												<td><a data_ruta="<?php echo $this->host; ?>" data_archivo="<?php echo $content->contenido_archivo; ?>" class="btn btn-sm botones visualizar" data-bs-toggle="tooltip" data-placement="top" title="word"><i class="far fa-file-word"></i><?= $content->contenido_nombre; ?></a></td>
											<?php } else if ($content->contenido_tipo == 1) { ?>
												<td><a data_ruta="<?php echo $this->host; ?>" data_archivo="<?php echo $content->contenido_archivo; ?>" class="btn btn-sm botones visualizar" data-bs-toggle="tooltip" data-placement="top" title="excel"><i class="far fa-file-excel"></i><?= $content->contenido_nombre; ?></a></td>
											<?php } ?>
											<?php if (is_array($this->filters2) && sizeof($this->filters2) == 8) { ?>
												<td style="text-transform: lowercase!important"><?= $content->contenido_ruta; ?></td>
											<?php }  ?>
											<td><?= $content->contenido_fecha_creacion; ?></td>
											<?php if ($content->contenido_fecha_modificacion) { ?>
												<td><?= $content->contenido_fecha_modificacion; ?></td>
											<?php } ?>
											<?php if ($this->level == 1 && $content->contenido_estado == 1 || $this->level == 4 && $content->contenido_estado == 1) { ?>
												<td> Activado </td>
											<?php } else if ($this->level == 1 && $content->contenido_estado == 0 || $this->level == 4 && $content->contenido_estado == 0) { ?>
												<td> Desactivado </td>
											<?php } ?>
											<?php if ($this->level == 1 || $this->level == 4 || $this->level == 2 && $this->hijo == $this->cat) { ?>
												<td class="text-right <?php if ($_GET['solicitudes'] == "1" or $_GET['documento_creditos'] == "1") {
																			echo 'd-none';
																		} ?>">
													<div>
														<?php if ($this->level == 1 || $this->level == 4 || $this->level == 2 && $this->hijo == $this->cat) { ?>
															<?php if ($content->contenido_tipo == 5) { ?>
																<a class="btn btn-azul-1 btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>&tipo=5" data-bs-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen-alt"></i></a>
															<?php } else { ?>
																<a class="btn btn-azul-1 btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>" data-bs-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen-alt"></i></a>
															<?php } ?>

														<?php } ?>
														<?php if ($this->level == 1 && $this->padre != 0 || $this->level == 4 && $this->padre != 0) { ?>
															<span data-bs-toggle="tooltip" data-placement="top" title="Mover">
																<a class="btn btn-morado btn-sm" data-bs-toggle="modal" data-bs-target="#modal2<?= $id ?>" title="Mover"><i class="fas fa-people-carry"></i></a>
															</span>
														<?php } ?>
														<?php if ($this->level == 1 || $this->level == 4) {  ?>
															<span data-bs-toggle="tooltip" data-placement="top" title="Eliminar">
																<a class="btn btn-rojo-claro btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>"><i class="fas fa-trash-alt"></i></a></span>
														<?php } ?>
													</div>
													<!-- Modal -->
													<div class="modal fade text-left" id="modal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

																</div>
																<div class="modal-body">
																	<div class="">¿Esta seguro de eliminar este registro?</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
																	<a class="btn btn-danger" href="<?php echo $this->route; ?>/delete?id=<?= $id ?>&csrf=<?= $this->csrf; ?><?php echo ''; ?>">Eliminar</a>
																</div>
															</div>
														</div>
													</div>
													<!-- Modal HTML Markup -->
													<div class="modal text-left" id="modal2<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">>
														<form role="form" method="POST" action="/page/documentos/mover">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title text-xs-center">Mover Registro</h4>
																	</div>
																	<div class="modal-body">
																		<input type="hidden" name="id" id="id" value="<?= $id ?>">
																		<div class="form-group">
																			<label class="control-label">¿Esta seguro de mover este contenido?</label>
																			<div>
																				<select class="form-control" name="mov" id="mov" required>
																					<option value="">Ninguno</option>
																					<?php print_r($this->selectV); ?>
																				</select>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-azul-1" data-bs-dismiss="modal">Cancelar</button>
																		<button type="submit" class="btn btn-morado">Mover</button>
																	</div>
																</div><!-- /.modal-content -->
															</div><!-- /.modal-dialog -->
														</form>
													</div><!-- /.modal -->
												</td>
											<?php } ?>
										</tr>
									<?php } ?>
								<?php } ?>


								<?php if ($this->es_socio == 1) { ?>
									<tr>
										<td><a class="btn botones btn-sm trans_table" href="<?php echo $this->route; ?>?solicitudes=1&documento=<?php echo $this->documento; ?>&cleanfilter=1" data-bs-toggle="tooltip" data-placement="top" title="interna"><i class="fas fa-folder"></i>
												<p>SOLICITUDES DE CRÉDITO</p>
											</a></td>
										<?php if (is_array($this->filters2) && sizeof($this->filters2) == 8) { ?>
											<td style="text-transform: lowercase!important"></td>
										<?php }  ?>
										<td></td>
										<?php if ($content->contenido_fecha_modificacion) { ?>
											<td></td>
										<?php } ?>
										<td> Activado </td>
										<td></td>
									</tr>
									<tr>
										<td><a class="btn botones btn-sm trans_table" href="<?php echo $this->route; ?>?solicitudes=2&documento=<?php echo $this->documento; ?>&cleanfilter=1" data-bs-toggle="tooltip" data-placement="top" title="interna"><i class="fas fa-folder"></i>
												<p>AFILIACIÓN</p>
											</a></td>
										<?php if (is_array($this->filters2) && sizeof($this->filters2) == 8) { ?>
											<td style="text-transform: lowercase!important"></td>
										<?php }  ?>
										<td></td>
										<?php if ($content->contenido_fecha_modificacion) { ?>
											<td></td>
										<?php } ?>
										<td> Activado </td>
										<td></td>
									</tr>
								<?php } ?>

								</tbody>
							</table>
							<input type="hidden" id="csrf" value="<?php echo $this->csrf ?>"><input type="hidden" id="order-route" value="<?php echo $this->route; ?>/order"><input type="hidden" id="page-route" value="<?php echo $this->route; ?>/changepage">
						</div>
					</div>
				</div>
				<div align="center">
					<ul class="pagination justify-content-center">
						<?php
						$url = $this->route;
						if ($this->totalpages > 1) {
							if ($this->page != 1) {
								echo '<li class="page-item" ><a class="page-link"  href="' . $url . '?page=' . ($this->page - 1) . '&padre=' . $_GET['padre'] . '"> &laquo; Anterior </a></li>';
							}
							for ($i = 1; $i <= $this->totalpages; $i++) {
								if ($this->page == $i) {
									echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
								} else {
									if ($i >= $min and $i <= $max) {
										echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '&padre=' . $_GET['padre'] . '">' . $i . '</a></li>  ';
									}
								}
							}
							if ($this->page != $this->totalpages) {
								echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '&padre=' . $_GET['padre'] . '">Siguiente &raquo;</a></li>';
							}
						}
						?>
					</ul>
				</div>
			</section>
		</article>
	</div>
</div>
<script>
	function set_contrato(id, titulo) {
		$('#contenido_cedula_asociado').val(id);
		$('#nombre').val(titulo);
	}

	function filtrar_tabla(x) {
		// Declare variables
		var input, filter, table, tr, td, i;
		input = document.getElementById("myInput" + x);
		filter = input.value.toUpperCase();
		table = document.getElementById("myTable");
		tr = table.getElementsByTagName("tr");

		// Loop through all table rows, and hide those who don't match the search query
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[x - 1];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}

	$('#jstree').jstree({
		"types": {
			"default": {
				"icon": "fa-solid fa-folder bg-gris"
			},
			
		},
		"plugins": ["types"]
	});

	$('#jstree').on('changed.jstree', function(e, data) {
		var i, j, r = [];
		for (i = 0, j = data.selected.length; i < j; i++) {
			r.push(data.instance.get_node(data.selected[i]).text);
		}
		$('#event_result').html('Selected: ' + r.join(', '));
	})
</script>