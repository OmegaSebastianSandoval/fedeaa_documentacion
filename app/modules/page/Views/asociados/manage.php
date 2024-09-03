
<div class="content-fluid">
	<div class="row sin-margin">
	<h1 class="titulo-principal py-2"><i class="fas fa-file-invoice"></i> <?php echo $this->titlesection; ?></h1>

		<article class="contenido_panel col-12">
			<section>
				<div class="container-fluid">
					<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
						<div class="content-dashboard">
							<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
							<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
							<?php if ($this->content->id) { ?>
								<input type="hidden" name="id" id="id" value="<?= $this->content->id; ?>" />
							<?php }?>
							<div class="row">
								<div class="col-6 form-group">
									<label for="cedula"  class="control-label">Cedula del asociado</label>
									<label class="input-group">
										
											<span class="input-group-text input-icono  " ><i class="fas fa-pencil-alt"></i></span>
										
										<input type="number" value="<?= $this->content->cedula; ?>" name="cedula" id="cedula" class="form-control"  required >
									</label>
									<div class="help-block with-errors"></div>
								</div>
								<div class="col-6 form-group">
									<label for="nombre"  class="control-label">Nombre del asociado</label>
									<label class="input-group">
										
											<span class="input-group-text input-icono " ><i class="fas fa-pencil-alt"></i></span>
										
										<input type="text" value="<?= $this->content->nombre; ?>" name="nombre" id="nombre" class="form-control"  required >
									</label>
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
						<div class="botones-acciones">
							<button class="btn btn-azul px-4" type="submit">Guardar</button>
							<a href="<?php echo $this->route; ?>" class="btn btn-cancelar px-4">Cancelar</a>
						</div>
					</form>
				</div>
			</section>
		</article>
	</div>
</div>
