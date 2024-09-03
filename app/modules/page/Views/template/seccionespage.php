
<?php
    $posicionesfondo = [];
    $posicionesfondo['1'] = 'fondo-center-center';
    $posicionesfondo['2'] = 'fondo-center-top';
    $posicionesfondo['3'] = 'fondo-center-botton';
    $posicionesfondo['4'] = 'fondo-left-center';
    $posicionesfondo['5'] = 'fondo-left-top';
    $posicionesfondo['6'] = 'fondo-left-botton';
    $posicionesfondo['7'] = 'fondo-right-center';
    $posicionesfondo['8'] = 'fondo-right-top';
    $posicionesfondo['9'] = 'fondo-right-botton';

    $animacion = array();
    $animacion['1'] = 'fondo-sinrepetir fondo-fijo';
    $animacion['2'] = 'fondo-sinrepetir';
    $animacion['3'] = 'fondo-repetido fondo-fijo';
    $animacion['4'] = 'fondo-repetido';
    $animacion['5'] = 'fondo-expandido fondo-fijo';
    $animacion['6'] = 'fondo-expandido';
?>
<?php foreach ($this->secciones as $key => $secciondata) { ?>
    <?php $seccion = $secciondata['detalle']; ?>
    <?php if($seccion->seccionpage_tipo == 1){ ?>
        <div class="seccion-contenido <?php echo $seccion->seccionpage_class; ?>">
            <?php if($this->editoromega == 1){?>
                <div class="btn-float-right">
                    <a class="btn-seccion btn-amarillo ls-modal" href="/editor/seccion/manage?id=<?php echo $seccion->seccionpage_id; ?>&url=page"><i class="fas fa-pencil-alt"></i></a>
                    <a class="btn-seccion btn-rojo ls-modal" href="/editor/seccion/eliminar?id=<?php echo $seccion->seccionpage_id; ?>&url=page"><i class="fas fa-trash-alt"></i></a>
                </div>
            <?php } ?>
                <?php echo  $secciondata['banner'];  ?>
        </div>
    <?php } ?>
    <?php if($seccion->seccionpage_tipo == 2){ ?>
        <div class="seccion-contenido">
            <?php if($this->editoromega == 1){?>
                <div class="btn-float-right">
                    <a class="btn-seccion btn-amarillo ls-modal" href="/editor/seccion/manage?id=<?php echo $seccion->seccionpage_id; ?>&url=page"><i class="fas fa-pencil-alt"></i></a>
                    <a class="btn-seccion btn-rojo ls-modal" href="/editor/seccion/eliminar?id=<?php echo $seccion->seccionpage_id; ?>&url=page"><i class="fas fa-trash-alt"></i></a>
                </div>
            <?php } ?>
            
            <?php foreach ($secciondata['contenidos'] as $key => $contenido) { ?>
                <?php
                    $fondoimagen ='';
                    $fondocolor ='';
                    if($seccion->seccionpage_fondo_imagen!= ''){
                        $fondoimagen = " background-image: url(/images/".$seccion->seccionpage_fondo_imagen."); ";
                    }
                    if($seccion->seccionpage_fondo_color!= ''){
                        $fondocolor = " background-color: ".$seccion->seccionpage_fondo_color."; ";
                    }
                    if($contenido->contenido_fondo_color!= ''){
                        $fondocolor = " background-color: ".$contenido->contenido_fondo_color."; ";
                        $fondoimagen ="";
                    }
                    if($contenido->contenido_fondo_imagen!= ''){
                        $fondoimagen = " background-image: url(/images/".$contenido->contenido_fondo_imagen."); ";
                    }
                    
                ?>
                <div class="contenido-simple-seccion <?php echo $seccion->seccionpage_class.' '.$posicionesfondo[$seccion->seccionpage_fondo_estilo].' '.$animacion[$seccion->seccionpage_fondo_animacion]; ?>" style="<?php echo $fondoimagen.' '.$fondocolor;  ?>">
                    <div class="<?php if($seccion->seccionpage_ancho == 1){ ?>container <?php } ?>">
                        <?php $disenio = APP_PATH."modules/page/Views/template/disenio".$contenido->seccionpage_disenio.".php"; ?>
                        <?php include($disenio); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else if($seccion->seccionpage_tipo == 3){ ?>
        <?php
            $fondoimagen ='';
            $fondocolor ='';
            if($seccion->seccionpage_fondo_imagen!= ''){
                $fondoimagen = " background-image: url(/images/".$seccion->seccionpage_fondo_imagen."); ";
            }
            if($seccion->seccionpage_fondo_color!= ''){
                $fondocolor = " background-color: ".$seccion->seccionpage_fondo_color."; ";
            }
        ?>
        <div class="seccion-contenido <?php echo $seccion->seccionpage_class.' '.$posicionesfondo[$seccion->seccionpage_fondo_estilo].' '.$animacion[$seccion->seccionpage_fondo_animacion]; ?>" style="<?php echo $fondoimagen.' '.$fondocolor;  ?>">
            <div class="<?php if($seccion->seccionpage_ancho == 1){ ?>container <?php } ?>">
                <?php if($this->editoromega == 1){?>
                    <div class="btn-float-right">
                        <a class="btn-seccion btn-amarillo ls-modal" href="/editor/seccion/manage?id=<?php echo $seccion->seccionpage_id; ?>&url=page"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn-seccion btn-rojo ls-modal" href="/editor/seccion/eliminar?id=<?php echo $seccion->seccionpage_id; ?>&url=page"><i class="fas fa-trash-alt"></i></a>
                    </div>
                <?php } ?>
                <div class="row">
                    <?php foreach ($secciondata['cols'] as $key => $cols) { ?>
                        <?php $columna = $cols['detalle']; ?>
                        <div  class="<?php echo $columna->seccionpage_columna;?>">
                            <div class="col-sm-right">
                                <a class="btn-seccion btn-amarillo ls-modal" href="/editor/seccion/manage?id=<?php echo $columna->seccionpage_id; ?>&url=page"><i class="fas fa-pencil-alt"></i></a>
                                <a class="btn-seccion btn-rojo ls-modal" href="/editor/seccion/eliminar?id=<?php echo $columna->seccionpage_id; ?>&url=page"><i class="fas fa-trash-alt"></i></a>
                            </div>
                            
                        </div>
                    <?php } ?>
                    <div class="<?php if($seccion->seccionpage_ancho == 1){ ?>container <?php } ?>">
                        <?php if($this->editoromega == 1){?>
                            <div class="text-left">
                                <a class="btn-seccion btn-verde ls-modal" href="/editor/seccion/manage?seccion=<?php echo $this->seccion; ?>&tipo=4&url=page&padre=<?php echo $seccion->seccionpage_id; ?>"><i class="fas fa-plus"></i></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>   
        </div>
    <?php } ?>
<?php } ?>

