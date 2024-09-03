<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->contenido_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->contenido_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-3 form-group">
					<label class="control-label">Estado</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="contenido_estado"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_contenido_estado AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"contenido_estado") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label class="control-label">Seccion</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="contenido_seccion"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_contenido_seccion AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"contenido_seccion") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-3 form-group">
					<label for="contenido_fecha"  class="control-label">Fecha</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="fas fa-calendar-alt"></i></span>
						</div>
					<input type="text" value="<?php if($this->content->contenido_fecha){ echo $this->content->contenido_fecha; } else { echo date('Y-m-d'); } ?>" name="contenido_fecha" id="contenido_fecha" class="form-control"   data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="es"  >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="contenido_titulo"  class="control-label">Titulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->contenido_titulo; ?>" name="contenido_titulo" id="contenido_titulo" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="contenido_subtitulo"  class="control-label">Subtitulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->contenido_subtitulo; ?>" name="contenido_subtitulo" id="contenido_subtitulo" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="contenido_introduccion" class="form-label" >Introduccion</label>
					<textarea name="contenido_introduccion" id="contenido_introduccion"   class="form-control tinyeditor" rows="10"   ><?= $this->content->contenido_introduccion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="contenido_descripcion" class="form-label" >Descripcion</label>
					<textarea name="contenido_descripcion" id="contenido_descripcion"   class="form-control tinyeditor" rows="10"   ><?= $this->content->contenido_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="contenido_imagen" >Imagen</label>
					<input type="file" name="contenido_imagen" id="contenido_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->contenido_imagen) { ?>
						<div id="imagen_contenido_imagen">
							<img src="/images/<?= $this->content->contenido_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('contenido_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-6 form-group">
					<label for="contenido_fondo_color"  class="control-label">Color de Fondo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->contenido_fondo_color; ?>" name="contenido_fondo_color" id="contenido_fondo_color" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="contenido_fondo_imagen" >Imagen de Fondo</label>
					<input type="file" name="contenido_fondo_imagen" id="contenido_fondo_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->contenido_fondo_imagen) { ?>
						<div id="imagen_contenido_fondo_imagen">
							<img src="/images/<?= $this->content->contenido_fondo_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('contenido_fondo_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-4 form-group">
					<label for="contenido_enlace"  class="control-label">Enlace</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->contenido_enlace; ?>" name="contenido_enlace" id="contenido_enlace" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-4 form-group">
					<label class="control-label">Abrir En</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="contenido_enlace_abrir"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_contenido_enlace_abrir AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"contenido_enlace_abrir") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-4 form-group">
					<label for="contenido_enlace_vermas"  class="control-label">Texto Ver M&aacute;s</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->contenido_enlace_vermas; ?>" name="contenido_enlace_vermas" id="contenido_enlace_vermas" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>