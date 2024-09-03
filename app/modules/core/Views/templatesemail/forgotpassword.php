<div style="padding: 40px; text-align: center; background: #333333;">
	<div style="display: inline-block; width:700px;">
		<table border="0" cellpadding="10" cellspacing="0" width="100%">
			<thead>
				<tr bgcolor="#013980">
					<td><img src="https://documentacion.fedeaa.com/corte/fedeaaLogo_blanco.png" height="100"></td>
					<td><h2 style="color:#FFFFFF;">Recuperacion de Contraseña</h2></td>
				</tr>
			</thead>
			<tr bgcolor="#013980">
				<td colspan="2" style="color: #FFFFFF; text-align: left;">
					<div><h2>Hola, <?php echo $this->nombre; ?></h2></div>
					<div>Usted recibi&oacute; este correo debido a que olvido su usuario o su contrase&ntilde;a .</div><br /><br />
					<div>Su usuario es: <?php echo $this->usuario; ?> </div><br />
					<div>Haz clic en este link para cambiar su contrase&ntilde;a :</div><br />
					<div align="center"><a href="<?php echo $this->url; ?>" target="_blank" style="padding:10px; display:block; color:#FFFFFF; background:#29abe2; text-transform:uppercase; text-decoration:none;" >Restablecer Contrase&ntilde;a</a></div>
				</td>
			</tr>
		</table>
	</div>
</div>


