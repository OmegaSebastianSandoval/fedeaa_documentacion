<div class="login-header">
	<img src="/corte/fedeaaLogo_blanco.png">
</div>
<div class="login-caja">
	<div class="login-content">
		<form autocomplete="off" action="/page/login/login" method="post">
			<div class="row">
				<div class="col-12">
					<h2>
						<span>BIENVENIDOS</span>
					</h2>
				</div>
				<div class="col-12">
					<div class="mb-3 mt-4">
						<label class="control-label sr-only">Correo</label>
						<div class="input-group">
							<input type="text" class="form-control login-input" id="cedula" name="cedula" value="<?php echo $_GET['cedula']; ?>"  placeholder="Usuario" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="mb-3 my-4">
						<label class="control-label sr-only">Contraseña</label>
						<div class="input-group">
							<input type="password" class="form-control login-input" id="clave" name="clave" placeholder="Contraseña" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
				</div>
				<?php if ($_GET['error'] == "1"): ?>
					<div class="error_login py-2 mb-2">El documento no es válido</div>
				<?php endif ?>

				<input type="hidden" id="csrf" name="csrf" value="<?php echo $this->csrf; ?>" />
				<div class="text-center"><button class="btn-azul-login" type="submit">Entrar</button></div>
				<div class="text-center mt-2"><a href="/page/login/olvido" class="olvido">¿Olvidaste tu contraseña?</a></div>
			</div>
		</form>
	</div>
	<div class="login-image">
		<img src="/corte/ilustracion-login.png" alt="">
	</div>
</div>

<div class="login-derechos">
	&copy; <?php echo date('Y') ?> Todos los derechos reservados | Diseñado por <a href="https://omegasolucionesweb.com" target="_blank" class="text-decoration-none">OMEGA SOLUCIONES WEB</a>
	<br>
	info@omegawebsystems.com - 310 6671747 - 310 668 6780
</div>