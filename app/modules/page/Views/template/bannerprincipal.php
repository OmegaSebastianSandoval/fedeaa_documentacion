<div class="slider-principal">
    <div id="carouselprincipal<?php echo $this->seccionbanner;  ?>" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php foreach ($this->banners as $key => $banner){ ?>
            <li data-target="#carouselprincipal<?php echo $this->seccionbanner;  ?>" data-slide-to="0" <?php if($key==0
                ){ ?>class="active"
                <?php }  ?>></li>
            <?php } ?>
        </ol>
        <div class="carousel-inner">
            <?php foreach ($this->banners as $key => $banner){ ?>
            <div class="carousel-item <?php if($key == 0){ ?>active <?php } ?>">
                <?php if($this->id_youtube($banner->publicidad_video) != false){ ?>
                <div class="fondo-video-youtube">
                    <div class="banner-video-youtube" id="videobanner<?php echo $banner->publicidad_id;?> " data-video="<?php echo $this->id_youtube($banner->publicidad_video); ?>"></div>
                </div>
                <?php } else { ?>
                <div class="fondo-imagen" style="background-image: url(/images/<?php echo $banner->publicidad_imagen; ?>);"></div>
                <?php } ?>
                <div class="carousel-caption d-flex h-100 <?php echo $banner->publicidad_posicion; ?>" style="background-color:<?php echo $banner->publicidad_color_fondo; ?>;">
                    <div class="container">
                        <div>
                            <?php echo $banner->publicidad_descripcion; ?>
                        </div>
                        <?php if($banner->publicidad_enlace){ ?>
                        <a class="btn btn-lg btn-success" href="<?php echo $banner->publicidad_enlace; ?>" <?php
                            if($banner->publicidad_tipo_enlace == 1){ ?> target="_blank"
                            <?php } ?>>
                            <?php if($banner->publicidad_enlace_vermas){ ?>
                            <?php echo $banner->publicidad_enlace_vermas; ?>
                            <?php } else { ?>
                            Ver Más
                            <?php } ?>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <a class="carousel-control-prev" href="#carouselprincipal<?php echo $this->seccionbanner;  ?>" role="button"
            data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselprincipal<?php echo $this->seccionbanner;  ?>" role="button"
            data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>