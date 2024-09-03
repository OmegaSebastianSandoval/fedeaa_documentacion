<div class="col-md-12 separador_gris"></div>
<div class="col-md-12 fondo_header">
    <div class="row align-items-center">
		<div class="col-2">
			<a href="/page/documentos"><img align="left" src="/corte/fedeaaLogo_blanco.png"></a>
		</div>
		<div class="col-6">
			<div align="right" class="titulo_blanco">SISTEMA DE DOCUMENTACIÓN</div>
		</div>
	</div>
</div>
<div class="titulo-internas" style="background-image:url(/skins/page/images/fondo-naranja.jpg)">
    <div align="center"><h2>Cambiar Contraseña</h2></div>
</div>
<div class="container">
    <div class="cambio-contrasena">
        <?php if ($this->error != '') {?>
            <div class="text-center alert alert-danger">
                <?= $this->error;?>
            </div>
            <br>
            <div class="text-center boton-cambio"><a href="/page/login" class="olvido">Volver al Login</a></div>
        <?php } else { ?>
            <?php if ($this->message != '') { ?>
                <div class="text-center alert alert-success">
                    <?php echo $this->message; ?>
                </div>
                <br>
                <div class="text-center boton-cambio"><a href="/page/login" class="olvido">Volver al Login</a></div>
            <?php } else { ?>
                <div class="box_password">
                    <form data-toggle="validator" role="form" method="post" action="/page/login/changepassword">
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
</div>