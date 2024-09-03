<div class="content-fluid">
	<div class="row sin-margin">
	<h1 class="titulo-principal py-2"><i class="fas fa-file-invoice"></i> <?php echo $this->titlesection; ?></h1>

		<article class="contenido_panel col-12">
			<section>
				<div class="container-fluid">
					<form action="<?php echo $this->route; ?>" method="post">
						<div class="content-dashboard">
							<div class="row">
								<div class="col-3">
									<label>Nombre</label>
									<label class="input-group">
										
											<span class="input-group-text input-icono  "><i class="fas fa-pencil-alt"></i></span>
										
										<input type="text" class="form-control" name="user_names" value="<?php echo $this->getObjectVariable($this->filters, 'user_names') ?>"></input>
									</label>
								</div>
								<div class="col-3">
									<label>Fecha Creacion</label>
									<label class="input-group">
										
											<span class="input-group-text input-icono   "><i class="fas fa-calendar-alt"></i></span>
										
										<input type="date" class="form-control" name="user_date" value="<?php echo $this->getObjectVariable($this->filters, 'user_date') ?>"></input>
									</label>
								</div>
								<div class="col-3">
									<label>Nombre Usuario</label>
									<label class="input-group">
										
											<span class="input-group-text input-icono "><i class="fas fa-pencil-alt"></i></span>
									
										<input type="text" class="form-control" name="user_user" value="<?php echo $this->getObjectVariable($this->filters, 'user_user') ?>"></input>
									</label>
								</div>
								<div class="col-3">
									<label>Nivel de Usuario</label>
									<label class="input-group">
										
											<span class="input-group-text input-icono "><i class="far fa-list-alt"></i></span>
										
										<select class="form-control" name="user_level">
											<option value="">Todas</option>
											<?php foreach ($this->list_user_level as $key => $value) : ?>
												<?php if ($key != 4 || $this->level == 4) { ?>
													<option <?php if ($this->getObjectVariable($this->content, "user_level") == $key) {
																echo "selected";
															} ?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
												<?php } ?>
											<?php endforeach ?>
										</select>
									</label>
								</div>
								<div class="col-3 form-group">
									<label class="control-label">Secci&oacute;n</label>
									<label class="input-group">
										
											<span class="input-group-text input-icono "><i class="far fa-list-alt"></i></span>
										
										<select class="selec-multiple form-control" name="user_contenido[]" id="user_contenido" multiple="multiple" require>
											<?php $contenido = explode(",", $this->getObjectVariable($this->filters, "user_contenido")); ?>

											<?php foreach ($this->list_user_contenido as $key => $value) { ?>
												<option <?php if (in_array($key, $contenido)) {
															echo "selected";
														} ?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
											<?php } ?>
										</select>
									</label>
								</div>
								<div class="col-3">
									<label>Email</label>
									<label class="input-group">
										
											<span class="input-group-text input-icono "><i class="fas fa-pencil-alt"></i></span>
										
										<input type="text" class="form-control" name="user_email" value="<?php echo $this->getObjectVariable($this->filters, 'user_email') ?>"></input>
									</label>
								</div>
								<div class="col-3">
									<label>&nbsp;</label>
									<a class="btn btn-block btn-azul-claro " href="<?php echo $this->route; ?>?cleanfilter=1"> <i class="fas fa-eraser"></i> Limpiar Filtro</a>
								</div>
								<div class="col-3 ">
									<label>&nbsp;</label>
									<button type="submit" class="btn d-block w-100 btn-azul"> <i class="fas fa-filter"></i> Filtrar</button>
								</div>
							</div>
						</div>
					</form>
					<div align="center">
						<ul class="pagination justify-content-center">
							<?php
							$url = $this->route;
							if ($this->totalpages > 1) {
								if ($this->page != 1)
									echo '<li class="page-item" ><a class="page-link"  href="' . $url . '?page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
								for ($i = 1; $i <= $this->totalpages; $i++) {
									if ($this->page == $i)
										echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
									else
										echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>  ';
								}
								if ($this->page != $this->totalpages)
									echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
							}
							?>
						</ul>
					</div>
					<div class="content-dashboard">
						<div class="franja-paginas">
							<div class="row">
								<div class="col-5">
									<div class="titulo-registro">Se encontraron <?php echo $this->register_number; ?> Registros</div>
								</div>
								<div class="col-3 text-right">
									<div class="texto-paginas">Registros por pagina:</div>
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
								<div class="col-3">
									<div class="text-right"><a class="btn btn-sm btn-success" href="<?php echo $this->route . "\manage"; ?>"> <i class="fas fa-plus-square"></i> Crear Nuevo</a></div>
								</div>
							</div>
						</div>
						<div class="content-table">
							<table class=" table table-striped  table-hover table-administrator text-left">
								<thead>
									<tr>
										<td>Nombre</td>
										<td>Email</td>
										<td>Nivel de Usuario</td>
										<td>Secci&oacute;n</td>
										<td>Fecha Creacion</td>
										<td>Nombre Usuario</td>
										<td width="100"></td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($this->lists as $content) { ?>
										<?php $id =  $content->user_id; ?>
										<tr>
											<td><?= $content->user_names; ?></td>
											<td><?= $content->user_email; ?></td>
											<td><?= $this->list_user_level[$content->user_level]; ?></td>
											<td>
												<?php if (strlen(strstr($content->user_contenido, ',')) > 0) { ?>
													<?php $tags = explode(",", $content->user_contenido); ?>
													<?php $keys = array_keys($tags); // Cambia $content->user_contenido a $tags 
													?>
													<?php $fil = ""; ?>
													<?php foreach ($tags as $key => $value) { ?>
														<?php if ($key == reset($keys)) { ?>
															<?php $fil .= $this->list_user_contenido[$value] . " "; ?>
														<?php } else if ($key != end($keys)) { ?>
															<?php $fil .= $this->list_user_contenido[$value] . " "; ?>
														<?php } else if ($key == end($keys)) { ?>
															<?php $fil .= $this->list_user_contenido[$value]; ?>
														<?php } ?>
													<?php } ?>
													<?php echo $fil; ?>
												<?php } else if (strlen(strstr($content->user_contenido, ',')) == 0) { ?>
													<?php if ($content->user_contenido == 0) { ?>
														<?= 'Administrador' ?>
													<?php } ?>
												<?php } ?>
											</td>
											<td><?= $content->user_date; ?></td>
											<td><?= $content->user_user; ?></td>
											<td class="text-right">
												<div>
													<a class="btn btn-azul-1 btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen-alt"></i></a>
													<span data-toggle="tooltip" data-placement="top" title="Eliminar"><a class="btn btn-rojo-claro btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>"><i class="fas fa-trash-alt"></i></a></span>
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
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<input type="hidden" id="csrf" value="<?php echo $this->csrf ?>"><input type="hidden" id="page-route" value="<?php echo $this->route; ?>/changepage">
					</div>
					<div align="center">
						<ul class="pagination justify-content-center">
							<?php
							$url = $this->route;
							if ($this->totalpages > 1) {
								if ($this->page != 1)
									echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
								for ($i = 1; $i <= $this->totalpages; $i++) {
									if ($this->page == $i)
										echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
									else
										echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>  ';
								}
								if ($this->page != $this->totalpages)
									echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
							}
							?>
						</ul>
					</div>
				</div>
			</section>
		</article>
	</div>
</div>

<style>
	.select2 {
		width: 88% !important;
	}
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