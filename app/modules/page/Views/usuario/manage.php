<div class="content-fluid">
	<div class="row sin-margin">
	<h1 class="titulo-principal py-2"><i class="fas fa-file-invoice"></i> <?php echo $this->titlesection; ?></h1>

		<article class="contenido_panel col-12">
			<section>
				<div class="container-fluid">
					<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>" data-toggle="validator">
						<?php
						if ($this->content->user_date) {
							$user_date = $this->content->user_date;
						} else {
							$user_date = date("Y-m-d");
						}
						?>
						<div class="content-dashboard">
							<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
							<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
							<?php if ($this->content->user_id) { ?>
								<input type="hidden" name="id" id="id" value="<?= $this->content->user_id; ?>" />
							<?php } ?>
							<div class="row">
								<div class="col-3 form-group">
									<label for="user_names" class="control-label">Nombre</label>
									<label class="input-group">

										<span class="input-group-text input-icono   "><i class="fas fa-pencil-alt"></i></span>

										<input type="text" value="<?= $this->content->user_names; ?>" name="user_names" id="user_names" class="form-control" required>
									</label>
									<div class="help-block with-errors"></div>
								</div>
								<div class="col-3 form-group">
									<label for="user_email" class="control-label">Email</label>
									<label class="input-group">

										<span class="input-group-text input-icono   "><i class="fas fa-pencil-alt"></i></span>

										<input type="email" value="<?= $this->content->user_email; ?>" name="user_email" id="user_email" class="form-control" placeholder="Correo" onchange="validar();" onkeyup="validar();" required>
									</label>
									<div class="help-block with-errors"></div>
								</div>
								<div class="col-3 form-group">
									<label class="control-label">Nivel de Usuario</label>
									<label class="input-group">

										<span class="input-group-text input-icono   "><i class="far fa-list-alt"></i></span>

										<select class="form-control" name="user_level" id="user_level" onchange="validarAdministrador();" onkeyup="validarAdministrador();" required>
											<option value="">Seleccione...</option>
											<?php foreach ($this->list_user_level as $key => $value) { ?>
												<?php if ($key != 4 || $this->level == 4) { ?>
													<option <?php if ($this->getObjectVariable($this->content, "user_level") == $key) {
																echo "selected";
															} ?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
												<?php } ?>
											<?php } ?>
										</select>
									</label>
									<div class="help-block with-errors"></div>
								</div>
								<input type="hidden" name="user_date" value="<?php echo $user_date ?>">
								<input type="hidden" name="user_state" value="<?php echo $this->content->user_state ?>">
								<div class="col-3 form-group">
									<label for="user_user" class="control-label">Nombre Usuario</label>
									<label class="input-group">

										<span class="input-group-text input-icono   "><i class="fas fa-pencil-alt"></i></span>

										<input type="text" value="<?= $this->content->user_user; ?>" name="user_user" id="user_user" placeholder="Usuario" onchange="validar();" onkeyup="validar();" class="form-control" required>
									</label>
									<div class="help-block with-errors"></div>
								</div>

								<div id="seccion" class="col-6 form-group">
									<label class="control-label">Secci&oacute;n</label>
									<label class="input-group">

										<span class="input-group-text input-icono   "><i class="far fa-list-alt"></i></span>

										<select class="selec-multiple form-control" name="user_contenido[]" id="user_contenido" multiple="multiple" required>
											<?php $contenido = explode(",", $this->getObjectVariable($this->content, "user_contenido")); ?>
											<?php foreach ($this->list_user_contenido as $key => $value) { ?>
												<option <?php if (in_array($key, $contenido)) {
															echo "selected";
														} ?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
											<?php } ?>
										</select>
									</label>
									<div class="help-block with-errors"></div>
								</div>
								<div class="col-3 form-group">
									<label for="user_password" class="control-label">Contrase&ntilde;a</label>
									<label class="input-group">

										<span class="input-group-text input-icono   "><i class="fas fa-key"></i></span>

										<input type="password" value="" name="user_password" id="user_password" class="form-control" placeholder="Contraseña" <?php if (!$this->content->user_id) { ?>required <?php } ?> data-remote="/core/user/validarclave">
									</label>
									<div class="help-block with-errors"></div>
								</div>
								<div class="col-3 form-group">
									<label for="user_password" class="control-label">Repita Contrase&ntilde;a</label>
									<label class="input-group">

										<span class="input-group-text input-icono   "><i class="fas fa-key"></i></span>

										<input type="password" value="" name="user_passwordr" id="user_passwordr" data-match="#user_password" min="8" data-match-error="Las dos contraseñas no son iguales" class="form-control">
									</label>
									<div class="help-block with-errors"></div>
								</div>
								<input type="hidden" name="user_delete" value="<?php echo $this->content->user_delete ?>">
								<input type="hidden" name="user_current_user" value="<?php echo $this->content->user_current_user ?>">
								<input type="hidden" name="user_code" value="<?php echo $this->content->user_code ?>">
								<div class="row" id="error1"></div>
								<div class="row" id="error2"></div>

							</div>
						</div>

						<div class="botones-acciones">
							<button class="btn btn-azul px-4" type="submit" id="guardar1">Guardar</button>
							<a href="<?php echo $this->route; ?>" class="btn btn-cancelar px-4">Cancelar</a>
						</div>
					</form>
				</div>
			</section>
		</article>
	</div>
</div>
<script>
	function validar() {
		var usuario = $("#user_user").val();
		var actual = '<?php echo $this->content->user_user; ?>';
		var email = $("#user_email").val();
		var actual2 = '<?php echo $this->content->user_email; ?>';
		if (usuario != actual || email != actual2) {
			$.post("/page/usuario/validar/", {
				"usuario": usuario,
				"email": email
			}, function(res) {
				var existe = res.existe;
				var existe2 = res.existe2;
				if (existe == "1") {
					$("#error1").html("<div style='  ' class='alert alert-danger mt-3 text-center'>El usuario ya existe</div>");
				} else {
					$("#error1").html("");
				}

				if (existe2 == "1") {
					$("#error2").html("<div  style='  '  class='alert alert-danger mt-3 text-center'>El correo ya existe</div>");
				} else {
					$("#error2").html("");
				}

				if (existe == "0" && existe2 == "0") {
					$("#guardar1").show();
				} else {
					$("#guardar1").hide();
				}

			});
		}
	}

	function validarAdministrador() {
		var level = $("#user_level").val();
		$.post("/page/usuario/validarAdministrador/", {
			"level": level
		}, function(res) {
			var existe = res.existe;
			if (existe == "0") {
				$("#seccion").show();
			} else {
				$("#seccion").hide();
			}
		});
	}
</script>
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