<div class="content-fluid">
	<div class="row sin-margin">
		<h1 class="titulo-principal py-2"><i class="fas fa-file-invoice"></i> <?php echo $this->titlesection; ?></h1>
		<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>" data-toggle="validator">
			<div class="content-dashboard">
				<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
				<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
				<?php if ($this->content->archivos_id) { ?>
					<input type="hidden" name="id" id="id" value="<?= $this->content->archivos_id; ?>" />
				<?php } ?>
				<div class="row">
					<div class="col-6 form-group">
						<a href="/corte/pruebaasociados.xlsx" class="btn btn-success" download>Archivo de Ejemplo</a>
					</div>
					<div class="row">
						<div class="col-12 form-group">
							<label for="archivos_asociados">Archivos Asociados</label>
							<input type="file" name="archivos_asociados" id="archivos_asociados" class="form-control file-document" data-buttonName="btn-primary" onchange="validardocumento('archivos_asociados');" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet " <?php if (!$this->content->archivos_id) {
																																																																																echo 'required';
																																																																															} ?> class="file-loading">
							<div class="help-block with-errors"></div>
						</div>
						<?php if ($this->content->archivos_asociados) { ?>
							<div id="archivos_asociados">
								<div><?php echo $this->content->archivos_asociados; ?></div>
								<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminararchivo('archivos_asociados','<?php echo $this->route . '/deletearchivo'; ?>')"><i class="glyphicon glyphicon-remove"></i> Eliminar Archivo</button></div>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="botones-acciones">
					<button class="btn btn-guardar" type="submit">Guardar</button>
					<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
				</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	function eliminararchivo(campo, ruta) {
		var csrf = $("#csrf").val();
		var csrf_section = $("#csrf_section").val();
		var id = $("#id").val();
		if (confirm("多Esta seguro de borrar este Archivo?") == true) {
			$.post(ruta, {
				"id": id,
				"csrf": csrf,
				"csrf_section": csrf_section,
				"campo": campo
			}, function(data) {
				location.reload();
			});
		}
		return false;
	}

	$("#archivos_asociados").fileinput({
		uploadUrl: "/file-upload-batch/2",
		uploadAsync: false,
		showUpload: false,
		showRemove: false,
		previewFileIcon: '<i class="fas fa-file"></i>',
		browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
		browseLabel: 'Seleccionar',
		preferIconicZoomPreview: true,
		maxFilePreviewSize: 10240,
		previewFileIconSettings: {
			'doc': '<i class="fas fa-file-word text-primary"></i>',
			'xls': '<i class="fas fa-file-excel text-success"></i>',
			'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
			'jpg': '<i class="fas fa-file-image text-danger"></i>',
			'gif': '<i class="fas fa-file-image text-warning"></i>',
			'png': '<i class="fas fa-file-image text-primary"></i>'
		},
		previewFileExtSettings: { // configure the logic for determining icon file extensions
			'doc': function(ext) {
				return ext.match(/(doc|docx)$/i);
			},
			'xls': function(ext) {
				return ext.match(/(xls|xlsx)$/i);
			},
		},
	});
</script>