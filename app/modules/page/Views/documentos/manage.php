<div class="content-fluid">
	<div class="row sin-margin">
		<?php if ($this->tipo == 5) { ?>
			<h1 class="titulo-principal py-2"><i class="fas fa-file-invoice"></i> <?php echo $this->titlesection; ?> Carpeta</h1>
		<?php } else { ?>
			<h1 class="titulo-principal py-2"><i class="fas fa-file-invoice"></i> <?php echo $this->titlesection; ?> Archivo</h1>
		<?php } ?>



		<div class="col-2 bd-sidebar">
			<div id="jstree" class="botonera1">
				<?php print_r($this->menuV) ?>
			</div>
		</div>
		<article class="contenido_panel col-10">
			<section>

				<div class="container-fluid">
					<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>" data-toggle="validator">
						<div class="content-dashboard">
							<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
							<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
							<?php if ($this->content->contenido_id) { ?>
								<input type="hidden" name="id" id="id" value="<?= $this->content->contenido_id; ?>" />
							<?php } ?>
							<?php
							if ($this->content->contenido_nombre) {
								$nombre = $this->content->contenido_nombre;
							} else {
								$nombre = $this->nombre;
							}
							if ($this->content->contenido_padre) {
								$padre = $this->content->contenido_padre;
							} else {
								$padre = $this->padre;
							}
							if ($this->content->contenido_fecha_creacion) {
								$fecha_creacion = $this->content->contenido_fecha_creacion;
							} else {
								$fecha_creacion = date("Y-m-d");
							}
							if ($this->content->contenido_fecha_modificacion) {
								$fecha_modificacion = date("Y-m-d");
							} else {
								$fecha_modificacion = date("Y-m-d");
							}
							if ($this->content->contenido_tipo) {
								$tipo = $this->content->contenido_tipo;
							} else {
								$tipo = $this->tipo;
							}
							if ($this->content->contenido_level) {
								$level = $this->content->contenido_level;
							} else {
								$level = $this->level;
							}
							?>
							<div class="row">
								<?php if ($level == 1 || $level == 4) { ?>
									<div class="col-2 form-group">
										<label class="control-label">Activar Contenido</label>
										<br>
										<input type="checkbox" data-on-text="Si" data-off-text="No" name="contenido_estado" id="contenido_estado" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'contenido_estado') == 1) {
																																																	echo "checked";
																																																} ?>></input>
										<div class="help-block with-errors"></div>
									</div>
								<?php } else if ($level == 2 || $level == 3) { ?>
									<input type="hidden" name="contenido_estado" value="1">
								<?php } ?>
								<?php if ($tipo == 5) { ?>
									<div class="col-4 form-group">
										<label for="contenido_nombre" class="control-label">Nombre</label>
										<label class="input-group">

											<span class="input-group-text input-icono   "><i class="fas fa-pencil-alt"></i></span>

											<input type="text" value="<?= $this->content->contenido_nombre; ?>" name="contenido_nombre" id="contenido_nombre" class="form-control" autofocus required>
										</label>
										<div class="help-block with-errors"></div>
									</div>
									<input type="hidden" name="contenido_cedula_asociado" value="">
									<input type="hidden" name="contenido_descripcion" value="">
								<?php } else { ?>
									<div class="col-4 form-group">
										<label for="contenido_nombre" class="control-label">Nombre</label>
										<label class="input-group">

											<span class="input-group-text input-icono   "><i class="fas fa-pencil-alt"></i></span>
											<input type="text" id="contenido_nombre" name="contenido_nombre" value="<?= $this->content->contenido_nombre; ?>" class="form-control">
										</label>
									</div>
									<div class="col-4 form-group">
										<label for="contenido_cedula_asociado" class="control-label">Cedula Asociado</label>
										<label class="input-group">

											<span class="input-group-text input-icono   "><i class="fas fa-pencil-alt"></i></span>

											<input type="text" value="<?php echo $this->getObjectVariable($this->content, "contenido_cedula_asociado"); ?>" name="contenido_cedula_asociado" id="contenido_cedula_asociado" class="form-control" autofocus>
											<label class="control-label"> </label>
											<button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-azul btn-xs"><i class="fa-solid fa-magnifying-glass"></i></button>
										</label>
									</div>
									<?php if ($level == 1 || $level == 4) { ?>
										<div class="col-6 form-group">
											<label>Tags</label>
											<label class="input-group">
												<input type="text" value="<?= $this->content->contenido_tags; ?>" class="form-control" data-role="tagsinput" name="contenido_tags" value="<?php echo $this->getObjectVariable($this->filters, 'contenido_tags') ?>"></input>
											</label>
										</div>
									<?php } else if ($level == 2 || $level == 3) { ?>
										<div class="col-8 form-group">
											<label>Tags</label>
											<label class="input-group">
												<input type="text" value="<?= $this->content->contenido_tags; ?>" class="form-control" data-role="tagsinput" name="contenido_tags" value="<?php echo $this->getObjectVariable($this->filters, 'contenido_tags') ?>"></input>
											</label>
										</div>
									<?php } ?>
									<div class="col-12 form-group">
										<label for="contenido_archivo">Subir Archivo</label>
										<input type="file" name="contenido_archivo[]" id="contenido_archivo" class="form-control  file-loading file-document" data-buttonName="btn-azul" onchange="validardocumento('contenido_archivo');" <?php if (!$this->content->contenido_id) {
																																																												echo 'required';
																																																											} ?> <?php if ($this->op) {
																																																															echo 'multiple';
																																																														} ?>>
										<div class="help-block with-errors"></div>
										<?php if ($this->content->contenido_archivo) { ?>
											<div id="contenido_archivo">
												<div><?php echo $this->content->contenido_archivo; ?></div>
												<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminararchivo('contenido_archivo','<?php echo $this->route . '/deletearchivo'; ?>')"><i class="glyphicon glyphicon-remove"></i> Eliminar Archivo</button></div>
											</div>
										<?php } ?>
									</div>
									<div class="col-12 form-group">
										<label for="contenido_descripcion" class="form-label">Descripcion</label>
										<textarea name="contenido_descripcion" id="contenido_descripcion" class="form-control tinyeditor" rows="10"><?= $this->content->contenido_descripcion; ?></textarea>
										<div class="help-block with-errors"></div>
									</div>
									<input type="hidden" name="contenido_archivo" value="">
								<?php } ?>

								<div id="permisos" class="col-12 mt-3 form-group <?php if ($this->tipo != 5) {
																						echo 'd-none';
																					}; ?>">

									<label class="control-label">Restringir contenido a usuarios (si selecciona usuarios especificos, solo estos usuarios podran ver el contenido)</label>
									<label class="input-group">

										<span class="input-group-text input-icono  "><i class="far fa-list-alt"></i></span>

										<select class="selec-multiple form-control w-50" name="permisos[]" id="permisos" multiple="multiple" required>
											<?php $contenido = explode(",", $this->getObjectVariable($this->content, "permisos")); ?>
											<?php foreach ($this->list_usuarios as $key => $value) { ?>
												<option <?php if (in_array($key, $contenido)) {
															echo "selected";
														} ?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
											<?php } ?>
										</select>
									</label>
									<div class="help-block with-errors"></div>
								</div>

								<input type="hidden" name="contenido_level" value="<?php echo $level ?>">
								<input type="hidden" name="contenido_padre" value="<?php echo $padre ?>">
								<input type="hidden" name="contenido_tipo" value="<?php echo $tipo  ?>">
								<input type="hidden" name="contenido_fecha_creacion" value="<?php echo $fecha_creacion  ?>">
								<input type="hidden" name="contenido_fecha_modificacion" value="<?php echo $fecha_modificacion  ?>">
								<input type="hidden" name="contenido_id_autor" value="<?php echo $this->autor  ?>">
							</div>
						</div>
						<div class="botones-acciones">
							<button class="btn btn-azul  px-4" type="submit">Guardar</button>
							<a href="<?php echo $this->route . "?padre=" . $padre ?>" class="btn btn-cancelar  px-4">Cancelar</a>
						</div>
					</form>
				</div>
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
			</section>
		</article>
	</div>
</div>
<script>
	setPreAuth();

	function set_contrato(id, titulo) {
		$('#contenido_cedula_asociado').val(id);
		$('#nombre').val(titulo);
	}

	function setPreAuth() {
		$('#contenido_estado').bootstrapSwitch('state', true);
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

	function eliminararchivo(campo, ruta) {
		var csrf = $("#csrf").val();
		var csrf_section = $("#csrf_section").val();
		var id = $("#id").val();
		if (confirm("多Esta seguro de borrar este Archivo?") == true) {
			$.post(ruta, {
				"id": id,
				"csrf": csrf,
				"csrf_section": csrf_section,
				"campo": campo
			}, function(data) {
				location.reload();
			});
		}
		return false;
	}

	$('#jstree').jstree();
	// 7 bind to events triggered on the tree
	$('#jstree').on("changed.jstree", function(e, data) {
		console.log(data.selected);
	});
	// 8 interact with the tree - either way is OK
	$('button').on('click', function() {
		$('#jstree').jstree(true).select_node('child_node_1');
		$('#jstree').jstree('select_node', 'child_node_1');
		$.jstree.reference('#jstree').select_node('child_node_1');
	});
</script>

<style>
	.select2-container--default .select2-selection--multiple {
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid #ced4da;
		padding: .075rem .75rem;
		font-size: 1rem;
		font-weight: 400;
		line-height: 1.5;
	}
</style>
