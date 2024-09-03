<?php 

/**
* 
*/
class Page_Model_Template_Template
{

    protected $_view;

    function __construct($view)
    {
        $this->_view = $view;
    }

	public function  getContent($section){

		$modelSeccion = new Page_Model_DbTable_Seccion();
		$modelContenidos = new Page_Model_DbTable_Contenidos();
		$seccionesdata = $modelSeccion->getList("seccionpage_seccion='$section' AND (seccionpage_padre = 0 OR seccionpage_padre IS NULL)","orden ASC");
		$secciones = [];
		foreach ($seccionesdata as $key => $seccion) {
			$secciones[$key] = [];
			$secciones[$key]['detalle'] = $seccion;
			if($seccion->seccionpage_tipo == 1){
				$secciones[$key]['banner'] = $this->bannerprincipal($seccion->seccionpage_contenido);
			} else if( $seccion->seccionpage_tipo == 2){
				$filtro = "contenido_seccion =  '".$seccion->seccionpage_contenido."'";
				$orden = $seccion->seccionpage_ordenar; 
				if($seccion->seccionpage_cantidad == 0 || $seccion->seccionpage_cantidad == '' ){
					$secciones[$key]['contenidos'] = $modelContenidos->getList($filtro,$orden);
				} else {
					$secciones[$key]['contenidos'] = $modelContenidos->getListPages($filtro,$orden,0,$seccion->seccionpage_cantidad);
				}
			} else if($seccion->seccionpage_tipo == 3){
				$padre = $seccion->seccionpage_id;
				$secciones[$key]['cols'] = [];
				$datacols = $modelSeccion->getList("seccionpage_padre = '$padre'"," orden ASC");
				foreach ($datacols as $key2 => $col) {
					$secciones[$key]['cols'][$key2] = [];
					$secciones[$key]['cols'][$key2]['detalle'] = $col;
					if($col->seccionpage_tipo_contenido != 4 ){
						$filtro = "contenido_seccion =  '".$col->seccionpage_contenido."'";
						$orden = $col->seccionpage_ordenar; 
						if($col->seccionpage_cantidad == 0 || $col->seccionpage_cantidad == '' ){
							$secciones[$key]['cols'][$key2]['contenidos'] = $modelContenidos->getList($filtro,$orden);
						} else {
							$secciones[$key]['cols'][$key2]['contenidos'] = $modelContenidos->getListPages($filtro,$orden,0,$col->seccionpage_cantidad);
						}
					}
				}
			}
		}
		$this->_view->secciones = $secciones;
		return $this->_view->getRoutPHP("modules/page/Views/template/seccionespage.php");
	}

	public function getContentseccion($seccion){
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$contenidos = [];
		$rescontenidos = $contenidoModel->getList("contenido_seccion = '$seccion' AND contenido_padre = '0' ","orden ASC");
		foreach ($rescontenidos as $key => $contenido) {
			$contenidos[$key] = [];
			$contenidos[$key]['detalle'] = $contenido;
			$padre = $contenido->contenido_id;
			$hijos = $contenidoModel->getList("contenido_padre = '$padre' ","orden ASC");
			foreach ($hijos as $key2 => $hijo) {
				$padre = $hijo->contenido_id;
				$contenidos[$key]['hijos'][$key2] = [];
				$contenidos[$key]['hijos'][$key2]['detalle'] = $hijo;
				$nietos = $contenidoModel->getList("contenido_padre = '$padre' ","orden ASC");
				if($nietos){
					$contenidos[$key]['hijos'][$key2]['hijos'] = $nietos;
				}
			}
		}
		$this->_view->contenidos = $contenidos;
		/*echo "<pre>";
		print_r($contenidos);
		echo "</pre>";*/
		return $this->_view->getRoutPHP("modules/page/Views/template/contenedor.php");
	}

	public function bannerprincipal($seccion){
		$this->_view->seccionbanner = $seccion;
		$publicidadModel = new Page_Model_DbTable_Publicidad();
		$this->_view->banners = $publicidadModel->getList("publicidad_seccion = '$seccion' ","orden ASC");

		return $this->_view->getRoutPHP("modules/page/Views/template/bannerprincipal.php");
	}
}