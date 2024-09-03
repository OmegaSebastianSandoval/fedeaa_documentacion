<div class="content-fluid">
	<div class="row sin-margin">
		<div class="col-12 bd-navbar">
			<nav class="navbar navbar-light justify-content-between">
				<a class="navbar-brand">
					<h1 class="titulo2"><i class="fas fa-user"></i> Mi perfil </h1>
				</a>
				<?php if ($this->level == 1 || $this->level == 4) { ?>
					<div class="btn-group dropstart">
						<button type="button" class="btn butt red3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i></button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="/page/asociados">Administrar Asociados</a>
							<a class="dropdown-item" href="/page/documentos">Administrar Documentos</a>
							<a class="dropdown-item" href="/page/usuario">Administrar Usuarios</a>
							<a class="dropdown-item" href="/page/archivos">Cargar Archivo Asociados</a>
						</div>
					</div>
				<?php } ?>
			</nav>
		</div>
		<article class="contenido_panel col-12">

			<section>
				<div class="container-fluid">



					<form class="text-left" enctype="multipart/form-data" method="post" action="/page/panel/guardarperfil/" data-toggle="validator">
						<div class="content-dashboard">
							<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
							<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
							<?php if ($this->content->user_id) { ?>
								<input type="hidden" name="id" id="id" value="<?= $this->content->user_id; ?>" />
							<?php } ?>
							<div class="row">
								<?php if ($_GET['a'] == "1") { ?>
									<div class="alert alert-success mt-3 text-center">Guardado</div>
								<?php } ?>
								<input type="hidden" name="user_date" value="<?php echo $this->content->user_date ?>">
								<div class="col-4 form-group">
									<label for="user_names" class="control-label">Nombres</label>
									<label class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text input-icono  fondo-morado "><i class="fas fa-pencil-alt"></i></span>
										</div>
										<input type="text" value="<?= $this->content->user_names; ?>" name="user_names" id="user_names" class="form-control" readonly>
									</label>
									<div class="help-block with-errors"></div>
								</div>
								<div class="col-4 form-group">
									<label for="user_email" class="control-label">correo</label>
									<label class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-envelope"></i></span>
										</div>
										<input type="email" value="<?= $this->content->user_email; ?>" name="user_email" id="user_email" class="form-control" required data-remote="/core/user/validationemail?csrf=1&email=<?= $this->content->user_email; ?>">
									</label>
									<div class="help-block with-errors"></div>
								</div>

								<div class="col-4 form-group">
									<label for="user_user" class="control-label">Usuario</label>
									<label class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text input-icono  fondo-rosado "><i class="fas fa-user-tie"></i></span>
										</div>
										<input type="text" value="<?= $this->content->user_user; ?>" name="user_user" id="user_user" class="form-control" required data-remote="/core/user/validation?csrf=1&user=<?= $this->content->user_user; ?>" readonly>
									</label>
									<div class="help-block with-errors"></div>
								</div>
								<div class="col-4 form-group">
									<label for="user_password" class="control-label">Contrase&ntilde;a</label>
									<label class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-key"></i></span>
										</div>
										<input type="password" value="" name="user_password" id="user_password" class="form-control" <?php if (!$this->content->user_id) { ?>required <?php } ?> data-remote="/core/user/validarclave">
									</label>
									<div class="help-block with-errors"></div>
								</div>
								<div class="col-4 form-group">
									<label for="user_password" class="control-label">Repita Contrase&ntilde;a</label>
									<label class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-key"></i></span>
										</div>
										<input type="password" value="" name="user_passwordr" id="user_passwordr" data-match="#user_password" min="8" data-match-error="Las dos contraseñas no son iguales" class="form-control">
									</label>
									<div class="help-block with-errors"></div>
								</div>
								<input type="hidden" name="user_delete" value="<?php echo $this->content->user_delete ?>">
								<input type="hidden" name="user_current_user" value="<?php echo $this->content->user_current_user ?>">
								<input type="hidden" name="user_code" value="<?php echo $this->content->user_code ?>">
							</div>
						</div>
						<div class="botones-acciones">
							<button class="btn btn-primary px-4" type="submit">Guardar</button>
							<a href="/page/documentos" class="btn btn-cancelar  px-4">Cancelar</a>
						</div>
					</form>

			</section>
		</article>
	</div>
</div>