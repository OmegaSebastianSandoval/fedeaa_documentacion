<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<input type="hidden" name="url" id="url" value="<?php echo $this->url ?>">
			<?php if ($this->content->seccionpage_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->seccionpage_id; ?>" />
			<?php }?>
			<div class="row">
				<input type="hidden" name="seccionpage_seccion"  value="<?php if($this->content->seccionpage_seccion){ echo $this->content->seccionpage_seccion; } else { echo $this->seccion; } ?>">
				<input type="hidden" name="seccionpage_padre"  value="<?php if($this->content->seccionpage_padre){ echo $this->content->seccionpage_padre; } else { echo $this->padre; } ?>">
				<?php if(!$this->tipo){ ?>
				<div class="col-12 form-group">
					<label class="control-label">Tipo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="seccionpage_tipo" id="seccionpage_tipo"  >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_seccionpage_tipo AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"seccionpage_tipo") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>"> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<?php } else { ?>
					<input type="hidden" name="seccionpage_tipo" id="seccionpage_tipo" value="<?php echo $this->tipo; ?>">
				<?php }  ?>

				<div class="col-12 form-group tipo-4">
					<label class="control-label">Tipo Contenido</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="seccionpage_tipo_contenido" id="seccionpage_tipo_contenido"  >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_seccionpage_tipo_contenido AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"seccionpage_tipo_contenido") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>"> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group tipo-1 tipo-2 tipocontenido-1 tipocontenido-2 tipocontenido-3">
					<label class="control-label">Contenido</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="seccionpage_contenido" id="seccionpage_contenido" data-actual="<?= $this->content->seccionpage_contenido; ?>" data-tipo="<?= $this->content->seccionpage_tipo; ?>"   >
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group  tipo-2 tipo-3">
					<label class="control-label">Ancho</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="seccionpage_ancho"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_seccionpage_ancho AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"seccionpage_ancho") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>"> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group  tipo-2 tipo-3">
					<label class="control-label">Espacio</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="seccionpage_espacio"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_seccionpage_espacio AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"seccionpage_espacio") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>"> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group tipo-2 tipo-3">
					<label for="seccionpage_fondo_color"  class="control-label">Color de Fondo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->seccionpage_fondo_color; ?>" name="seccionpage_fondo_color" id="seccionpage_fondo_color" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group  tipo-2 tipo-3">
					<label for="seccionpage_fondo_imagen" >Imagen de Fondo</label>
					<input type="file" name="seccionpage_fondo_imagen" id="seccionpage_fondo_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->seccionpage_fondo_imagen) { ?>
						<div id="imagen_seccionpage_fondo_imagen">
							<img src="/images/<?= $this->content->seccionpage_fondo_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('seccionpage_fondo_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 form-group  tipo-2 tipo-3">
					<label class="control-label">Estilo de Fondo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="seccionpage_fondo_estilo"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_seccionpage_fondo_estilo AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"seccionpage_fondo_estilo") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>"> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group  tipo-2 tipo-3">
					<label class="control-label">Animaci&oacute;n del Fondo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="seccionpage_fondo_animacion"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_seccionpage_fondo_animacion AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"seccionpage_fondo_animacion") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>"> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group  tipo-2">
					<label class="control-label">Diseño Contenido</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="seccionpage_disenio"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_seccionpage_disenio AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"seccionpage_disenio") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>"> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 form-group tipo-2 tipocontenido-1 tipocontenido-2">
					<label for="seccionpage_cantidad"  class="control-label">Cantidad</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->seccionpage_cantidad; ?>" name="seccionpage_cantidad" id="seccionpage_cantidad" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 form-group tipo-2 tipo-4 tipocontenido-1 tipocontenido-2  tipocontenido-3">
					<label for="seccionpage_ordenar"  class="control-label">Ordenar</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->seccionpage_ordenar; ?>" name="seccionpage_ordenar" id="seccionpage_ordenar" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 form-group  tipocontenido-1 tipocontenido-2  tipocontenido-3 tipocontenido-4">
					<label for="seccionpage_columna"  class="control-label">Classe Columna</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->seccionpage_columna; ?>" name="seccionpage_columna" id="seccionpage_columna" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 form-group tipocontenido-1 tipocontenido-2">
					<label class="control-label">Cantidad de elementos Fila</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="seccionpage_columnas_contenido"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_seccionpage_columnas_contenido AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"seccionpage_columnas_contenido") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>"> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 form-group tipo-2 tipocontenido-1 tipocontenido-2  tipocontenido-3">
					<label for="seccionpage_rutaenlace"  class="control-label">Ruta Enlace</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->seccionpage_rutaenlace; ?>" name="seccionpage_rutaenlace" id="seccionpage_rutaenlace" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="seccionpage_class"  class="control-label">Class</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->seccionpage_class; ?>" name="seccionpage_class" id="seccionpage_class" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 form-group tipocontenido-4">
					<label for="seccionpage_codigo"  class="control-label">Codigo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->seccionpage_codigo; ?>" name="seccionpage_codigo" id="seccionpage_codigo" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?seccion=<?php if($this->content->seccionpage_seccion){ echo $this->content->seccionpage_seccion; } else { echo $this->seccion; } ?>" class="btn btn-cancelar">Cancelar</a>
		</div>

	</form>
</div>

<script>
	 $(".file-image").fileinput({
        maxFileSize: 2048,
        previewFileType: "image",
        allowedFileExtensions: ["jpg", "jpeg", "gif", "png"],
        browseClass: "btn  btn-verde",
        showUpload: false,
        showRemove: false,
        browseIcon: "<i class=\"fas fa-image\"></i> ",
        browseLabel: "Imagen",
        language:"es",
        dropZoneEnabled: false
	});
	
	function changetipo(){
		var value = $("#seccionpage_tipo").val();
		$(".tipo-1").hide();
		$(".tipo-2").hide();
		$(".tipo-3").hide();
		$(".tipo-4").hide();
		var actual = 0;
		if (value == 1){
			if($("#seccionpage_contenido").attr('data-tipo') == 1){
				actual = $("#seccionpage_contenido").attr('data-actual');
			}	
			$("#seccionpage_contenido").load("/editor/seccion/getbanner?actual="+actual);
			$(".tipo-1").show();
		}else if (value == 2){
			if($("#seccionpage_contenido").attr('data-tipo') == 2){
				actual = $("#seccionpage_contenido").attr('data-actual');
			}	
			$("#seccionpage_contenido").load("/editor/seccion/getcontenido?actual="+actual);
			$(".tipo-2").show();
		}else if (value == 3){
			$(".tipo-3").show();
		} else if(value == 4){
			$(".tipo-4").show();
		}
		changetipocontenido();
	}

	function changetipocontenido(){
		var value = $("#seccionpage_tipo_contenido").val();
		$(".tipocontenido-1").hide();
		$(".tipocontenido-2").hide();
		$(".tipocontenido-3").hide();
		$(".tipocontenido-4").hide();
		var actual = 0;
		if (value == 1){
			if($("#seccionpage_contenido").attr('data-tipo') == 2){
				actual = $("#seccionpage_contenido").attr('data-actual');
			}	
			$("#seccionpage_contenido").load("/editor/seccion/getcontenido?actual="+actual);
			$(".tipocontenido-1").show();
		}else if (value == 2){
			if($("#seccionpage_contenido").attr('data-tipo') == 2){
				actual = $("#seccionpage_contenido").attr('data-actual');
			}	
			$("#seccionpage_contenido").load("/editor/seccion/getcontenido?actual="+actual);
			$(".tipocontenido-2").show();
		}else if (value == 3){
			if($("#seccionpage_contenido").attr('data-tipo') == 2){
				actual = $("#seccionpage_contenido").attr('data-actual');
			}	
			$("#seccionpage_contenido").load("/editor/seccion/getcontenido?actual="+actual);
			$(".tipocontenido-3").show();
		} else if (value == 4){
			$(".tipocontenido-4").show();
		} 
	}
	$("#seccionpage_tipo").change(function(){
		changetipo();
	});

	$("#seccionpage_tipo_contenido").change(function(){
		changetipocontenido();
	});
	changetipo();
	
</script>