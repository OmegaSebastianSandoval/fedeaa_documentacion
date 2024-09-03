<div class="login-header">
    <img src="/corte/fedeaaLogo_blanco.png">
</div>
<div class="login-caja">
    <div class="login-content">
        <form autocomplete="off" action="/page/login/forgotpassword2" method="post">
            <div class="row">
                <div class="col-12">
                    <h2>
                        <span>Cambio de Contraseña</span>
                    </h2>
                    <br>
                    Por favor ingrese su dirección de correo electrónico y
                    recibirás un enlace para crear una nueva contraseña.
                </div>
                <div class="col-12">
                    <div class="mb-3 mt-4">
                        <label class="control-label sr-only">Correo</label>
                        <div class="input-group">
                            <input type="email" class="form-control login-input" id="email" name="email" value="<?php echo $_GET['cedula']; ?>" placeholder="Usuario" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                </div>
                <?php if ($this->error_olvido) { ?>
                    <div class="alert alert-danger" align="center"><?php echo $this->error_olvido; ?></div>
                <?php } ?>
                <?php if ($this->mensaje_olvido) { ?>
                    <div class="alert alert-success" align="center"><?php echo $this->mensaje_olvido; ?></div>
                <?php } ?>
                <input type="hidden" id="csrf" name="csrf" value="<?php echo $this->csrf; ?>" />

                <div class="text-center"><button class="btn-azul-login" type="submit">Enviar</button></div>
                <div class="text-center mt-2"><a href="/page/index/" class="olvido">Volver al Login</a></div>
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
</div>e