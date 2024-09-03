<div class="login-header">
	<img src="/corte/fedeaaLogo_blanco.png">
</div>
<div class="login-caja">
	<div class="login-content">
    <?php if ($this->error != '') {?>
            <div class="text-center alert alert-danger">
                <?= $this->error;?>
            </div>
            <br>
            <div class="text-center boton-cambio"><a href="/page/login" class="btn btn-azul">Volver al Login</a></div>
        <?php } else { ?>
            <?php if ($this->message != '') { ?>
                <div class="text-center alert alert-success">
                    <?php echo $this->message; ?>
                </div>
                <br>
                <div class="text-center boton-cambio"><a href="/page/login" class="btn btn-azul">Volver al Login</a></div>
            <?php } else { ?>
                <div class="box_password">
                    <form data-toggle="validator" role="form" method="post" action="/page/login/changepassword" class="d-grid gap-2">
                        <input type="hidden" name="code" value="<?php echo $this->code; ?>" />
                        <div class="form-group">
                            <div class="info-olvido"> <strong>USUARIO:</strong> <?php echo $this->usuario; ?></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label sr-only">Contraseña:</label>
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" required value="" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label sr-only">Repita Contraseña:</label>
                            <input type="password" name="re_password" class="form-control" data-match="#inputPassword" data-match-error="Las dos Contraseñas no son iguales"  value="" placeholder="Repita Contraseña" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="text-center">
                            <button class="btn-azul-login" type="submit">Cambiar Contraseña</button>
                        </div>
                    </form>
                </div>
            <?php } ?>
        <?php } ?>
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