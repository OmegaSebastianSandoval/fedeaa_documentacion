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
<div class="container-fluid no-padding">
	<div class="container text-center">
		<div class="row">
			<div class="col-md-3 col-md-35"></div>
			<div class="col-md-12 col-lg-5">
            <form autocomplete="off" action="/page/login/forgotpassword2" method="post" class="col-md-12 no_pad_cel borde_login">
                <div align="center" class="caja_login col-md-12 no_pad_cel">
                    <div class="titulo_login_azul col-md-12">RECORDAR CONTRASEÑA</div>
                    <div align="center">
                        <div class="separador_login"></div>
                    </div>
                    <br>
                    Por favor ingrese su dirección de correo electrónico y
                    recibirás un enlace para crear una nueva contraseña.

                    <div class="form-group ">
                        <label class="control-label"></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-icono  fondo-azul "><i class="fas fa-envelope"></i></span>
                            </div>

                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <?php if ($this->error_olvido) { ?>
                        <div class="alert alert-danger" align="center"><?php echo $this->error_olvido; ?></div>
                    <?php } ?>
                    <?php if ($this->mensaje_olvido) { ?>
                        <div class="alert alert-success" align="center"><?php echo $this->mensaje_olvido; ?></div>
                    <?php } ?>
                    <input type="hidden" id="csrf" name="csrf" value="<?php echo $this->csrf; ?>" />
                    <div class="text-center mt-2"><a class="enlace" href="/page/index/" style="cursor:pointer;">Volver al Login</a></div>
                    <div class="text-center"><button class="btn btn-azul mt-2" type="submit">Enviar</button></div>
                </div>
            </form>
        </div>
    </div>
</div>