<div class="modal-body">
    <div class="">¿Esta seguro de eliminar este registro?</div>
</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-danger" href="<?php echo $this->route;?>/delete?id=<?= $this->id ?>&csrf=<?= $this->csrf;?><?php echo ''.'&seccion='.$this->seccion."&url=".$this->url; ?>" >Eliminar</a>
        </div>