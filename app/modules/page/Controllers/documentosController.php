<?php

/**
 * Controlador de Documentos que permite la  creacion, edicion  y eliminacion de los documento del Sistema
 */
class Page_documentosController extends Page_mainController
{

	public $botonpanel = 2;

	/**
	 * $mainModel  instancia del modelo de  base de datos documento
	 * @var modeloContenidos
	 */
	public $mainModel;

	/**
	 * $route  url del controlador base
	 * @var string
	 */
	protected $route;
	protected $login;
	protected $documentos;



	/**
	 * $pages cantidad de registros a mostrar por pagina]
	 * @var integer
	 */
	protected $pages;

	/**
	 * $namefilter nombre de la variable a la fual se le van a guardar los filtros
	 * @var string
	 */
	protected $namefilter;

	/**
	 * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
	 * @var string
	 */
	protected $_csrf_section = "page_documentos";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
	 * Inicializa las variables principales del controlador documentos .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Page_Model_DbTable_Documentos();
		$this->userModel = new Administracion_Model_DbTable_Usuario();
		$this->tipoModel = new Page_Model_DbTable_Dependtipoarchivo();
		$this->namefilter = "parametersfilterdocumentos";
		$this->route = "/page/documentos";
		$this->login = "/page/index";
		$this->namepages = "pages_documentos";
		$this->namepageactual = "page_actual_documentos";
		$this->_view->route = $this->route;
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
	 * Recibe la informacion y  muestra un listado de  documento con sus respectivos filtros.
	 *
	 * @return void.
	 */

	public function indexAction()
	{
		$_SESSION['padre_actual'] = $this->_getSanitizedParam("padre");


		//error_reporting(E_ALL);
		$level = Session::getInstance()->get("kt_login_level");
		if ($level) {
			$title = "Administración de documento";
			$this->getLayout()->setTitle($title);
			$this->filters();
			//print_r($this->filters());
			$this->_view->titlesection = $title;
			$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
			$this->_view->level = $level;
			$id_autor = Session::getInstance()->get("kt_login_id");
			$this->_view->autor = $id_autor;
			$filters = Session::getInstance()->get($this->namefilter);


			$this->_view->filters = $filters;
			$filters2 = $filters;
			$this->_view->filters2 = $filters2;
			if ($level == 1 && sizeof((array)$filters2) == 8 || $level == 4 && sizeof((array)$filters2) == 8) {
				$filters = $this->getFilter2();
				//print_r("aqui");
			} else if ($level == 1 && (sizeof((array)$filters2) == 1 || sizeof((array)$filters2) == 0)  || $level == 4 && (sizeof((array)$filters2) == 1 || sizeof((array)$filters2) == 0)) {
				$filters = $this->getFilter();
			} else if ($level == 2 && (sizeof((array)$filters2) == 1 || sizeof((array)$filters2) == 0) || $level == 3 && (sizeof((array)$filters2) == 1 || sizeof((array)$filters2) == 0)) {
				$filters = $this->getFilter3();
			} else if ($level == 2 && sizeof((array)$filters2) == 8 || $level == 3 && sizeof((array)$filters2) == 8) {
				$filters = $this->getFilter4();
			}

			//filtro permisos
			if ($level != 1) {
				$usuario_id = $_SESSION['kt_login_id'];
				$filters .= " AND (permisos='' OR permisos IS NULL OR FIND_IN_SET($usuario_id, permisos) > 0  ) ";
			}
			/* echo $filters;
			echo $level;
 */
			if ($_GET['filtro'] == "1") {
				echo $filters;
			}

			$order = "orden ASC";
			$list = $this->mainModel->getList($filters, $order);
			$amount = $this->pages;
			$page = $this->_getSanitizedParam("page");
			if (!$page && Session::getInstance()->get($this->namepageactual)) {
				$page = Session::getInstance()->get($this->namepageactual);
				$start = ($page - 1) * $amount;
			} else if (!$page) {
				$start = 0;
				$page = 1;
				Session::getInstance()->set($this->namepageactual, $page);
			} else {
				Session::getInstance()->set($this->namepageactual, $page);
				$start = ($page - 1) * $amount;
			}
			$this->_view->register_number = count($list);
			$this->_view->pages = $this->pages;
			$this->_view->totalpages = ceil(count($list) / $amount);
			$this->_view->page = $page;
			$this->_view->lists = $this->mainModel->getListPages($filters, $order, $start, $amount);
			$this->_view->csrf_section = $this->_csrf_section;
			$this->_view->list_contenido_level = $this->getContenidolevel();
			//$this->_view->list_contenido_seccion = $this->getContenidoseccion();
			$this->_view->list_contenido_cedula_asociado = $this->getContenidocedula();
			if ($this->_getSanitizedParam("padre") == '') {
				$id_padre = 0;
			} else {
				$id_padre = $this->_getSanitizedParam("padre");
			}
			$this->_view->padre = $id_padre;

			//genera las rutas dinamicas
			if ($_SESSION['secciones'] == "" or $_SESSION['menuV'] == "") {
				$secciones = $this->getArraypadre2(0);
				$menuV = $this->buildMenu($secciones, TRUE);
				$_SESSION['secciones'] = $secciones;
				$_SESSION['menuV'] = $menuV;
			} else {
				$secciones = $_SESSION['secciones'];
				$menuV = $_SESSION['menuV'];
			}

			$bread = $this->buildRuta($this->getArray($id_padre), TRUE);
			$bread2 = explode(",", $bread);
			sort($bread2);
			array_shift($bread2);


			$this->_view->bread = $bread2;
			$this->_view->secciones1 = $secciones;
			$this->_view->ant = $this->getAnt($id_padre);
			$this->_view->menuV = $menuV;

			//se comento porque no hace nada
			//$lista_documentos = $this->getContenidodocumentos();
			//$this->_view->list_contenido_documentos = $lista_documentos;

			//es el menu que despliega para mover archivos. se dejo con cache
			if ($_SESSION['select'] == "") {
				$options = $this->getContenidod(0);
				$select = $this->buildOption($options, TRUE);
				$_SESSION['select'] = $select;
			} else {
				$select = $_SESSION['select'];
			}


			$this->_view->selectV = $select;
			$com = false;
			$hijo = $this->getPA($id_padre);
			$cat = explode(",", $this->getContenido($id_autor));
			foreach ($cat as $key => $value) {
				if ($hijo == $value) {
					$com = true;
					break;
				}
			}
			$this->_view->com = $com;
			$this->_view->host  = $_SERVER['HTTP_HOST'];
		} else {
			header('Location: ' . $this->login . '');
		}

		//integracion
		$abuelo = $this->mainModel->getById($id_padre)->contenido_padre;
		if ($abuelo == "200") {
			$es_socio = 1;
		} else {
			$es_socio = 0;
		}
		$this->_view->es_socio = $es_socio;

		$asociado = $this->mainModel->getById($id_padre);
		$nombre_carpeta = $asociado->contenido_nombre;
		$aux = explode(" ", $nombre_carpeta);
		$this->_view->documento = $aux[0];

		$solicitudes = $this->_getSanitizedParam('solicitudes');
		$documento = $this->_getSanitizedParam('documento');
		if ($solicitudes == 1 and $documento != "") {
			$solicitudesModel = new Page_Model_DbTable_Solicitudes();
			$solicitudes = $solicitudesModel->getList(" cedula='$documento'AND paso='8' ", " id DESC ");
			foreach ($solicitudes as $key => $value) {
				$id = $value->id;
				$numero = str_pad($id, 6, "0", STR_PAD_LEFT);
				$value->contenido_nombre = "Solicitud WEB" . $numero;
				$value->contenido_tipo = 5;
				$value->contenido_fecha_creacion = $value->fecha_asignado;
				$value->contenido_fecha_modificacion = $value->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			$this->_view->lists = $lista;
		}
		//Consumir archivos afiliacion
		if ($solicitudes == 2 and $documento != "") {
			//echo $documento;
			$hash = md5(date("Y-m-d"));
			$url = "httpa://afiliaciones.fedeaa.com/page/afiliacion/getArchivos?hash=" . $hash . "&documento=" . $documento;
			//echo $url;
			$res = file_get_contents($url);
			$existe_archivo = json_decode($res);
			//print_r($existe_archivo);

			//echo $value->archivo_cedula;
			if ($existe_archivo->archivo_cedula != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CEDULA";
				$value->contenido_archivo = $existe_archivo->archivo_cedula;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $existe_archivo->fecha_solicitud;
				$value->contenido_fecha_modificacion = $existe_archivo->fecha_solicitud;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($existe_archivo->archivo_desprendible != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Desprendible de pago";
				$value->contenido_archivo = $existe_archivo->archivo_desprendible;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $existe_archivo->fecha_solicitud;
				$value->contenido_fecha_modificacion = $existe_archivo->fecha_solicitud;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($existe_archivo->archivo_contrato != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Archivo contrato";
				$value->contenido_archivo = $existe_archivo->archivo_contrato;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $existe_archivo->fecha_solicitud;
				$value->contenido_fecha_modificacion = $existe_archivo->fecha_solicitud;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($existe_archivo->archivo_desprendible2 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Desprendible de pago 2";
				$value->contenido_archivo = $existe_archivo->archivo_desprendible2;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $existe_archivo->fecha_solicitud;
				$value->contenido_fecha_modificacion = $existe_archivo->fecha_solicitud;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($existe_archivo->archivo_desprendible3 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Desprendible de pago 3";
				$value->contenido_archivo = $existe_archivo->archivo_desprendible3;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $existe_archivo->fecha_solicitud;
				$value->contenido_fecha_modificacion = $existe_archivo->fecha_solicitud;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($existe_archivo->archivo_desprendible4 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Desprendible de pago 4";
				$value->contenido_archivo = $existe_archivo->archivo_desprendible4;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $existe_archivo->fecha_solicitud;
				$value->contenido_fecha_modificacion = $existe_archivo->fecha_solicitud;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($existe_archivo->archivo_desprendible5 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Desprendible de pago 5";
				$value->contenido_archivo = $existe_archivo->archivo_desprendible5;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $existe_archivo->fecha_solicitud;
				$value->contenido_fecha_modificacion = $existe_archivo->fecha_solicitud;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}

			if ($existe_archivo->id != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Afiliacion pdf";
				$value->contenido_archivo = "https://afiliaciones.fedeaa.com/page/afiliacion/pdfAfiliacion?id=" . $existe_archivo->id . "";
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $existe_archivo->fecha_solicitud;
				$value->contenido_fecha_modificacion = $existe_archivo->fecha_solicitud;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			$this->_view->lists = $lista;
		}


		$documento_creditos = $this->_getSanitizedParam('documento_creditos');
		$credito = $this->_getSanitizedParam('credito');

		if ($documento_creditos == 1) {
			$id = $credito;
			$documentosModel = new Page_Model_DbTable_Documentoscreditos();
			$documentos = $documentosModel->getList(" solicitud = '$id' AND tipo='1' ", "")[0];
			$documentos2 = $documentosModel->getList(" solicitud = '$id' AND tipo='2' ", "")[0];
			$documentos3 = $documentosModel->getList(" solicitud = '$id' AND tipo='3' ", "")[0];
			$solicitudesModel = new Page_Model_DbTable_Solicitudes();
			$solicitud = $solicitudesModel->getById($id);

			if ($documentos->cedula != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CEDULA";
				$value->contenido_archivo = $documentos->cedula;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->desprendible_pago != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Desprendible de pago1";
				$value->contenido_archivo = $documentos->desprendible_pago;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->desprendible_pago2 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Desprendible de pago2";
				$value->contenido_archivo = $documentos->desprendible_pago2;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->desprendible_pago3 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Desprendible de pago3";
				$value->contenido_archivo = $documentos->desprendible_pago3;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->desprendible_pago4 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Desprendible de pago4";
				$value->contenido_archivo = $documentos->desprendible_pago4;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->certificado_laboral != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Certificado laboral y/o Declaración de Ingresos";
				$value->contenido_archivo = $documentos->certificado_laboral;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->otros_ingresos != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Otros documentos";
				$value->contenido_archivo = $documentos->otros_ingresos;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->contrato_vivienda != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Contrato de vivienda";
				$value->contenido_archivo = $documentos->contrato_vivienda;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->certificado_tradicion != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Estado de Cuenta de la Obligación";
				$value->contenido_archivo = $documentos->certificado_tradicion;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->estado_obligacion2 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Estado de Cuenta de la Obligación2";
				$value->contenido_archivo = $documentos->estado_obligacion2;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->estado_obligacion3 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Estado de Cuenta de la Obligación3";
				$value->contenido_archivo = $documentos->estado_obligacion3;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->factura_proforma != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Factura proforma";
				$value->contenido_archivo = $documentos->factura_proforma;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->recibo_matricula != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Recibo matricula";
				$value->contenido_archivo = $documentos->recibo_matricula;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->declaracion_renta != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Declaración de renta";
				$value->contenido_archivo = $documentos->declaracion_renta;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->otros_documentos1 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Otros documentos1";
				$value->contenido_archivo = $documentos->otros_documentos1;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->otros_documentos2 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Otros documentos2";
				$value->contenido_archivo = $documentos->otros_documentos2;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->otros_documentos3 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Otros documentos3";
				$value->contenido_archivo = $documentos->otros_documentos3;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos->otros_documentos4 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "Otros documentos4";
				$value->contenido_archivo = $documentos->otros_documentos4;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}

			$value = new stdClass();
			$value->contenido_nombre = "Reporte Aseguradora";
			$value->contenido_archivo = "https://creditos.fedeaa.com/page/sistema/reporteaseguradora/?id=" . $id . "&excel=1";
			$value->contenido_tipo = 2;
			$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
			$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
			$value->contenido_estado = 1;
			$lista[] = $value;

			//CODEUDOR
			if ($documentos2->cedula != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CEDULA CODEUDOR";
				$value->contenido_archivo = $documentos2->cedula;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos2->desprendible_pago != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR Desprendible de pago1";
				$value->contenido_archivo = $documentos2->desprendible_pago;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos2->desprendible_pago2 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR Desprendible de pago2";
				$value->contenido_archivo = $documentos2->desprendible_pago2;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos2->desprendible_pago3 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR Desprendible de pago3";
				$value->contenido_archivo = $documentos2->desprendible_pago3;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos2->desprendible_pago4 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR Desprendible de pago4";
				$value->contenido_archivo = $documentos2->desprendible_pago4;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos2->certificado_laboral != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR Certificado laboral y/o Declaración de Ingresos";
				$value->contenido_archivo = $documentos2->certificado_laboral;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos2->otros_ingresos != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR Certificado otros ingresos";
				$value->contenido_archivo = $documentos2->otros_ingresos;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos2->certificado_tradicion != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR Certificado de tradición y libertad";
				$value->contenido_archivo = $documentos2->certificado_tradicion;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			//CODEUDOR


			//CODEUDOR2
			if ($documentos3->cedula != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CEDULA CODEUDOR2";
				$value->contenido_archivo = $documentos3->cedula;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos3->desprendible_pago != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR2 Desprendible de pago1";
				$value->contenido_archivo = $documentos3->desprendible_pago;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos3->desprendible_pago2 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR2 Desprendible de pago2";
				$value->contenido_archivo = $documentos3->desprendible_pago2;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos3->desprendible_pago3 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR2 Desprendible de pago3";
				$value->contenido_archivo = $documentos3->desprendible_pago3;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos3->desprendible_pago4 != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR2 Desprendible de pago4";
				$value->contenido_archivo = $documentos3->desprendible_pago4;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos3->certificado_laboral != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR2 Certificado laboral y/o Declaración de Ingresos";
				$value->contenido_archivo = $documentos3->certificado_laboral;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos3->otros_ingresos != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR2 Certificado otros ingresos";
				$value->contenido_archivo = $documentos3->otros_ingresos;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			if ($documentos3->certificado_tradicion != "") {
				$value = new stdClass();
				$value->contenido_nombre = "CODEUDOR2 Certificado de tradición y libertad";
				$value->contenido_archivo = $documentos3->certificado_tradicion;
				$value->contenido_tipo = 2;
				$value->contenido_fecha_creacion = $solicitud->fecha_asignado;
				$value->contenido_fecha_modificacion = $solicitud->fecha_asignado;
				$value->contenido_estado = 1;
				$lista[] = $value;
			}
			//CODEUDOR2

			$this->_view->lists = $lista;
			//print_r($lista);

		}
	}

	/**
	 * Genera la Informacion necesaria para editar o crear un  documentos  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level) {
			// $this->getLayout()->setTitle($title);
			// $this->_view->titlesection = $title;
			$this->_view->route = $this->route;
			$this->_csrf_section = "manage_documentos_" . date("YmdHis");
			$this->_csrf->generateCode($this->_csrf_section);
			$this->_view->csrf_section = $this->_csrf_section;
			$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
			$this->_view->level = Session::getInstance()->get("kt_login_level");
			$this->_view->autor = Session::getInstance()->get("kt_login_id");
			$this->_view->list_contenido_tipo = $this->getContenidotipo();
			$this->_view->list_contenido_level = $this->getContenidolevel();
			$this->_view->list_contenido_cedula_asociado = $this->getContenidocedula();
			$this->_view->list_usuarios = $this->getUsuarios();
			$this->_view->padre = $this->_getSanitizedParam("padre");
			$this->_view->tipo = $this->_getSanitizedParam("tipo");
			$this->_view->op = $this->_getSanitizedParam("op");
			$secciones = $this->getArraypadre2(0);
			$this->_view->secciones1 = $secciones;
			$this->_view->menuV = $this->buildMenu($secciones, TRUE);
			$header = $this->_view->getRoutPHP('modules/page/Views/partials/header.php');
			$this->getLayout()->setData("header", $header);
			$id = $this->_getSanitizedParam("id");
			if ($id > 0) {
				$content = $this->mainModel->getById($id);
				if ($content->contenido_id) {
					$this->_view->content = $content;
					$this->_view->routeform = $this->route . "/update";
					$title = "Actualizar";
					$this->getLayout()->setTitle($title);
					$this->_view->titlesection = $title;
				} else {
					$this->_view->routeform = $this->route . "/insert";
					$title = "Crear";
					$this->getLayout()->setTitle($title);
					$this->_view->titlesection = $title;
				}
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			header('Location: ' . $this->login . '');
		}
	}


	/**
	 * Inserta la informacion de un documentos  y redirecciona al listado de documento.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		// error_reporting(E_ALL);
		$level = Session::getInstance()->get("kt_login_level");
		if ($level) {
			$this->setLayout('blanco');
			$csrf = $this->_getSanitizedParam("csrf");
			if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
				$data = $this->getData();
				$uploadDocument =  new Core_Model_Upload_Document();
				if ($_FILES['contenido_archivo']['name'] != '') {
					$Documentos = $uploadDocument->uploadmultiple("contenido_archivo");
					foreach ($Documentos as $key => $document) {
						$data['contenido_archivo'] = $document;
						if ($data['contenido_nombre'] == "") {
							$data['contenido_nombre'] = $this->obtenerNombre($data['contenido_archivo']);
						}
						print_r($_FILES["contenido_archivo"]['name']);
						$extension = pathinfo($_FILES["contenido_archivo"]['name'][$key], PATHINFO_EXTENSION);
						$id_extension = $this->getContenidotipos($extension);
						$data['contenido_tipo'] = $id_extension;
						$id = $this->mainModel->insert($data);
						$data1 = $this->stringRut($id);
						$this->mainModel->insertruta($data1, $id);
						$this->mainModel->changeOrder($id, $id);

						$this->mainModel->editField($id, "permisos", $data['permisos']);
					}
				} else {
					$id = $this->mainModel->insert($data);
					$data1 = $this->stringRut($id);
					$this->mainModel->insertruta($data1, $id);
					$this->mainModel->changeOrder($id, $id);
					$this->mainModel->editField($id, "permisos", $data['permisos']);
				}
				$data['contenido_id'] = $id;
				$data['log_log'] = print_r($data, true);
				$data['log_tipo'] = 'CREAR DOCUMENTOS';
				$logModel = new Administracion_Model_DbTable_Log();
				$logModel->insert($data);
			}
			$rutaadicional = "";
			$padre = $this->_getSanitizedParam("contenido_padre");
			if ($padre > 0) {
				$rutaadicional = "?padre=" . $padre;
			}
			header('Location: ' . $this->route . '' . $rutaadicional . '');
		} else {
			header('Location: ' . $this->login . '');
		}
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un documentos  y redirecciona al listado de documento.
	 *
	 * @return void.
	 */

	public function deletearchivoAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level) {
			$csrf = $this->_getSanitizedParam("csrf");
			if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
				$id =  $this->_getSanitizedParam("id");
				if (isset($id) && $id > 0) {
					$data = $this->getData1();
					$content = $this->mainModel->getById($id);
					if (isset($content)) {
						$uploadDocument =  new Core_Model_Upload_Document();
						if (isset($content->contenido_archivo) && $content->contenido_archivo != '') {
							$uploadDocument->delete($content->contenido_archivo);
						}
						$data['log_log'] = print_r($data, true);
						$data['log_tipo'] = 'BORRAR DOCUMENTOS';
						$logModel = new Administracion_Model_DbTable_Log();
						$logModel->insert($data);
					}
					$this->mainModel->update1($data, $id);
				}
			}
		} else {
			header('Location: ' . $this->login . '');
		}
	}

	public function updateAction()
	{
		// error_reporting(E_ALL);
		$level = Session::getInstance()->get("kt_login_level");
		if ($level) {
			$this->setLayout('blanco');
			$csrf = $this->_getSanitizedParam("csrf");
			if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
				$id = $this->_getSanitizedParam("id");
				$content = $this->mainModel->getById($id);
				if ($content->contenido_id) {
					$data = $this->getData();
					$uploadDocument =  new Core_Model_Upload_Document();
					if ($_FILES['contenido_archivo']['name'][0] != '') {
						if ($content->contenido_archivo) {
							$uploadDocument->delete($content->contenido_archivo);
						}
						$data['contenido_archivo'] = $uploadDocument->upload("contenido_archivo");
						if ($data['contenido_nombre'] == "") {
							$data['contenido_nombre'] = $this->obtenerNombre($data['contenido_archivo']);
						}
						$extension = pathinfo($_FILES["contenido_archivo"]['name'], PATHINFO_EXTENSION);
						$id_extension = $this->getContenidotipos($extension);
						$data['contenido_tipo'] = $id_extension;
					} else {
						$data['contenido_archivo'] = $content->contenido_archivo;
					}
					if ($content->contenido_estado != $data['contenido_estado']) {
						$this->cambioEstadointernas($id, $data['contenido_estado']);
					}
					$data1 = $this->stringRut($id);
					$this->mainModel->update($data, $id);
					$this->mainModel->insertruta($data1, $id);
					$this->mainModel->editField($id, "permisos", $data['permisos']);
				}
				$data['contenido_id'] = $id;
				$data['log_log'] = print_r($data, true);
				$data['log_tipo'] = 'EDITAR DOCUMENTOS';
				$logModel = new Administracion_Model_DbTable_Log();
				$logModel->insert($data);
			}
			$rutaadicional = "";
			$padre = $this->_getSanitizedParam("contenido_padre");
			if ($padre > 0) {
				$rutaadicional = "?padre=" . $padre;
			}
			header('Location: ' . $this->route . '' . $rutaadicional . '');
		} else {
			header('Location: ' . $this->login . '');
		}
	}

	/**
	 * Recibe un identificador  y elimina un documentos  y redirecciona al listado de documento.
	 *
	 * @return void.
	 */
	public function deleteAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level) {
			$this->setLayout('blanco');
			$csrf = $this->_getSanitizedParam("csrf");
			if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf) {
				$id =  $this->_getSanitizedParam("id");
				$tod = $this->mainModel->getList("contenido_padre=" . $id . "");
				if (isset($id) && $id > 0) {
					$content = $this->mainModel->getById($id);
					if (isset($content)) {
						$uploadDocument =  new Core_Model_Upload_Document();
						if (isset($content->contenido_archivo) && $content->contenido_archivo != '') {
							$uploadDocument->delete($content->contenido_archivo);
						}
						$padre = $this->getAnt($id);
						if (sizeof($tod) != 0) {
							$this->mainModel->deleteRegister($id);
							foreach ($tod as $key => $value) {
								$this->mainModel->deleteRegister($value->contenido_id);
							}
						} else {
							$this->mainModel->deleteRegister($id);
						}
						$data = (array)$content;
						$data['log_log'] = print_r($data, true);
						$data['log_tipo'] = 'BORRAR DOCUMENTOS';
						$logModel = new Administracion_Model_DbTable_Log();
						$logModel->insert($data);
					}
				}
			}
			$rutaadicional = "";
			if ($padre > 0) {
				$rutaadicional = "?padre=" . $padre;
			}
			header('Location: ' . $this->route . '' . $rutaadicional . '');
		} else {
			header('Location: ' . $this->login . '');
		}
	}

	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Documentos.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		$data['contenido_fecha_creacion'] = $this->_getSanitizedParam("contenido_fecha_creacion");
		$data['contenido_fecha_modificacion'] = $this->_getSanitizedParam("contenido_fecha_modificacion");
		$data['contenido_nombre'] = $this->_getSanitizedParam("contenido_nombre");
		$data['contenido_descripcion'] = $this->_getSanitizedParam("contenido_descripcion");
		if ($this->_getSanitizedParam("contenido_cedula_asociado") == '') {
			$data['contenido_cedula_asociado'] = '0';
		} else {
			$data['contenido_cedula_asociado'] = $this->_getSanitizedParam("contenido_cedula_asociado");
		}
		if ($this->_getSanitizedParam("contenido_tipo") == '') {
			$data['contenido_tipo'] = '0';
		} else {
			$data['contenido_tipo'] = $this->_getSanitizedParam("contenido_tipo");
		}
		if ($this->_getSanitizedParam("contenido_level") == '') {
			$data['contenido_level'] = '0';
		} else {
			$data['contenido_level'] = $this->_getSanitizedParam("contenido_level");
		}
		if ($this->_getSanitizedParam("contenido_padre") == '') {
			$data['contenido_padre'] = '0';
		} else {
			$data['contenido_padre'] = $this->_getSanitizedParam("contenido_padre");
		}
		if ($this->_getSanitizedParam("contenido_estado") == '') {
			$data['contenido_estado'] = '0';
		} else {
			$data['contenido_estado'] = $this->_getSanitizedParam("contenido_estado");
		}
		$data['contenido_tags'] = $this->_getSanitizedParam("contenido_tags");
		$data['contenido_id_autor'] = $this->_getSanitizedParam("contenido_id_autor");
		$data['contenido_ruta'] = $this->_getSanitizedParam("contenido_ruta");

		$permisos = $_POST['permisos'] ?? []; // Asegura que $permisos sea un array
		$fil = is_array($permisos) ? implode(",", $permisos) : '';
		$data['permisos'] = $fil;

		return $data;
	}

	private function getData1()
	{
		$data = array();
		$data['contenido_archivo'] = "";
		return $data;
	}

	private function obtenerNombre($nombre)
	{

		$nombreactualizado = "";
		if (strpos($nombre, '.pdf') !== false) {
			$nombreactualizado = str_replace(".pdf", "", $nombre);
		} else if (strpos($nombre, '.odt') !== false) {
			$nombreactualizado = str_replace(".odt", "", $nombre);
		} else if (strpos($nombre, '.doc') !== false) {
			$nombreactualizado = str_replace(".doc", "", $nombre);
		} else if (strpos($nombre, '.docx') !== false) {
			$nombreactualizado = str_replace(".docx", "", $nombre);
		} else if (strpos($nombre, '.odp') !== false) {
			$nombreactualizado = str_replace(".odp", "", $nombre);
		} else if (strpos($nombre, '.ppt') !== false) {
			$nombreactualizado = str_replace(".ppt", "", $nombre);
		} else if (strpos($nombre, '.ods') !== false) {
			$nombreactualizado = str_replace(".ods", "", $nombre);
		} else if (strpos($nombre, '.xls') !== false) {
			$nombreactualizado = str_replace(".xls", "", $nombre);
		} else if (strpos($nombre, '.jpg') !== false) {
			$nombreactualizado = str_replace(".jpg", "", $nombre);
		} else if (strpos($nombre, '.jpeg') !== false) {
			$nombreactualizado = str_replace(".jpeg", "", $nombre);
		} else if (strpos($nombre, '.png') !== false) {
			$nombreactualizado = str_replace(".png", "", $nombre);
		}
		return $nombreactualizado;
	}

	public function changepageAction()
	{
		Session::getInstance()->set($this->namepages, $this->_getSanitizedParam("pages"));
	}

	public function moverAction()
	{
		$this->setLayout('blanco');
		$id = $this->_getSanitizedParam("id");
		$mov = $this->_getSanitizedParam("mov");
		$this->mainModel->moverContenido($id, $mov);
		$data1 = $this->stringRut($id);
		$this->mainModel->insertruta($data1, $id);
		$rutaadicional = "?padre=" . $mov;
		header('Location: ' . $this->route . '' . $rutaadicional . '');
	}

	private function getContenidocedula()
	{
		$modelData = new Page_Model_DbTable_Asociados();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->cedula] = $value->nombre;
		}
		return $array;
	}

	private function getContenido($id_autor)
	{
		$modelData = new Page_Model_DbTable_Dependuser();
		$data = $modelData->getList("user_id = " . $id_autor);
		$contenido = "";
		foreach ($data as $key => $value) {
			$contenido = $value->user_contenido;
		}
		return $contenido;
	}

	/**
	 * Genera los valores del campo Tipo.
	 *
	 * @return array cadena con los valores del campo Tipo.
	 */



	private function getContenidodocumentos()
	{
		$data = $this->mainModel->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->contenido_id] = $value->contenido_nombre;
		}
		return $array;
	}

	function buildOption($menu_array, $is_sub = FALSE)
	{
		$menu = "";
		foreach ($menu_array as $id => $properties) {
			foreach ($properties as $key => $val) {
				if (is_array($val)) {
					$sub = $this->buildOption($val, TRUE);
				} else {
					$sub = NULL;
					$key = $val;
				}
			}
			if (!isset($url)) {
				$url = $id;
				$display = $properties["nombre"];
				$rut = $properties["id"];
				$internas = $properties["interna"];
				$padre = $properties["padre"];
			}
			if ($internas != 0) {
				$menu .= "<option value='$rut'>$display</option>$sub";
			} else {
				$menu .= "<option value='$rut'>$display</option>$sub";
			}

			unset($url, $display, $sub);
		}
		return $menu . "";
	}

	public function getContenidod($id)
	{
		$modelData = new Page_Model_DbTable_Documentos();
		$data1 = $modelData->getList("contenido_padre = " . $id);
		foreach ($data1 as $key => $value) {
			if ($value->contenido_tipo == 5) {
				$internas = $this->internas($value->contenido_id);
				$dat[$key] = [];
				if ($internas != FALSE) {
					$dat[$key]["id"] = $value->contenido_id;
					$dat[$key]["nombre"] = $value->contenido_nombre;
					$dat[$key]["interna"] = 1;
					$dat[$key]['subcategorias'] =  $this->getContenidod($value->contenido_id);
				} else {
					$dat[$key]["id"] = $value->contenido_id;
					$dat[$key]["nombre"] = $value->contenido_nombre;
					$dat[$key]["interna"] = 0;
				}
			}
		}
		return $dat;
	}

	private function getContenidotipo()
	{
		$modelData = new Page_Model_DbTable_Dependtipoarchivo();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->contenido_id] = $value->contenido_nombre;
		}
		return $array;
	}

	/**
	 * Genera los valores del campo contenido_seccion.
	 *
	 * @return array cadena con los valores del campo contenido_seccion.
	 */
	private function getContenidoseccion()
	{
		$modelData = new Page_Model_DbTable_Dependseccion();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->seccion_id] = $value->seccion_nombre;
		}
		return $array;
	}

	private function getExtension()
	{
		$data = array();
		$data['1'] = "xls,xlsx";
		$data['2'] = "pdf";
		$data['3'] = "doc,docx,odt";
		$data['4'] = "jpg,jpeg,gif,png,bmp";
		return $data;
	}

	private function getContenidotipos($extension)
	{
		$data = $this->getExtension();
		$id = 0;
		foreach ($data as $key => $value) {
			if (preg_match("/" . $extension . "/i", $value)) {
				$id = $key;
			}
		}
		return $id;
	}


	/**
	 * Genera los valores del campo Nivel de acceso.
	 *
	 * @return array cadena con los valores del campo Nivel de acceso.
	 */
	private function getContenidolevel()
	{
		$modelData = new Page_Model_DbTable_Dependlevel();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->id] = $value->nombre;
		}
		return $array;
	}

	private function getUsuarios()
	{
		$modelData = new Page_Model_DbTable_Usuario();
		$data = $modelData->getList(" user_state='1' ", "user_names ASC");
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->user_id] = $value->user_names;
		}
		return $array;
	}

	private function getAnt($id_padre)
	{
		$modelData = new Page_Model_DbTable_Documentos();
		$data = $modelData->getList("contenido_id = " . $id_padre);
		$ant = "";
		foreach ($data as $key => $value) {
			$ant = $value->contenido_padre;
		}
		return $ant;
	}

	private function getPa($id_padre)
	{
		$modelData = new Page_Model_DbTable_Documentos();
		$data = $modelData->getList("contenido_id = " . $id_padre);
		$hijo = "";
		foreach ($data as $key => $value) {
			if ($value->contenido_padre == 0) {
				$hijo = $value->contenido_id;
			} else {
				$hijo = $value->contenido_padre;
			}
		}
		return $hijo;
	}

	public function getArraypadre2($id)
	{

		//filtro permisos
		$filters = "";
		if ($level != 1) {
			$usuario_id = $_SESSION['kt_login_id'];
			$filters .= " AND (permisos='' OR permisos IS NULL OR FIND_IN_SET($usuario_id, permisos) > 0  ) ";
		}

		$dat = [];
		$data = $this->mainModel->getList("contenido_padre = '$id' $filters  ", "orden ASC");

		foreach ($data as $key => $value) {
			if ($value->contenido_tipo == 5) {
				$dat[$key] = [];
				$dat[$key]["id"] = $value->contenido_id;
				$dat[$key]["nombre"] = $value->contenido_nombre;
				$dat[$key]['subcategorias'] =  $this->getArraypadre2($value->contenido_id);
			}
		}
		return $dat;
	}

	public function getArray($id)
	{
		$dat = [];
		/*
		$data = $this->mainModel->getList("contenido_id = ".$id,"orden ASC");
		foreach ($data as $key => $value) {
			$dat[$key]["id"] = $value->contenido_id ;
			$dat[$key]["nombre"] = $value->contenido_nombre  ;
			if($value->contenido_padre != 0) {
				$dat[$key]["ruta2"] = $this->getArray($this->getAnt($value->contenido_id));
			}
		}
		*/
		$value = $this->mainModel->getById($id);
		$dat[$key]["id"] = $value->contenido_id;
		$dat[$key]["nombre"] = $value->contenido_nombre;
		if ($value->contenido_padre != 0) {
			$dat[$key]["ruta2"] = $this->getArray($this->getAnt($id));
		}

		return $dat;
	}

	function buildRuta($menu_array, $is_sub = FALSE)
	{
		$menu = '';
		foreach ($menu_array as $id => $properties) {
			foreach ($properties as $key => $val) {
				if (is_array($val)) {
					$sub = $this->buildRuta($val, TRUE);
				} else {
					$sub = NULL;
					$key = $val;
				}
			}
			if (!isset($url)) {
				$url = $id;
				$display = $properties["nombre"];
				$rut = $properties["id"];
			}
			$menu .= "<a style='text-transform: lowercase;' href=/page/documentos?padre=" . $rut . ">$display</a> , " . $sub;
			unset($url, $display, $sub);
		}

		return $menu;
	}

	function buildMenu($menu_array, $is_sub = FALSE)
	{
		$menu = "<ul>";
		foreach ($menu_array as $id => $properties) {
			foreach ($properties as $key => $val) {
				if (is_array($val)) {
					$sub = $this->buildMenu($val, TRUE);
				} else {
					$sub = NULL;
					$key = $val;
				}
			}
			if (!isset($url)) {
				$url = $id;
				$display = $properties["nombre"];
				$rut = $properties["id"];
			}
			$menu .= "<li><a onclick=" . "window.location='/page/documentos?padre=$rut'" . ">$display</a>$sub</li>";
			unset($url, $display, $sub);
		}
		return $menu . "</ul>";
	}

	public function getRut($id)
	{
		$modelData = new Page_Model_DbTable_Documentos();
		$data1 = $modelData->getList("contenido_id = " . $id);
		foreach ($data1 as $key => $value) {
			$data[$key] = [];
			if ($value->contenido_padre != 0) {
				$data[$key]["id"] = $value->contenido_id;
				$data[$key]["nombre"] = $value->contenido_nombre;
				$data[$key]["anterior"] = $this->getRut($value->contenido_padre);
			} else {
				$data[$key]["id"] = $value->contenido_id;
				$data[$key]["nombre"] = $value->contenido_nombre;
			}
		}
		return $data;
	}

	function buildRut($menu_array, $is_sub = FALSE)
	{
		foreach ($menu_array as $id => $properties) {
			foreach ($properties as $key => $val) {
				if (is_array($val)) {
					$sub = $this->buildRut($val, TRUE);
				} else {
					$sub = NULL;
					$key = $val;
				}
			}
			if (!isset($url)) {
				$url = $id;
				$display = $properties["nombre"];
			}
			$menu .= "$display , " . $sub;
			unset($url, $display, $sub);
		}
		return $menu;
	}

	public function stringRut($id)
	{
		$ruta1 = $this->buildRut($this->getRut($id));
		$ruta2 = explode(",", $ruta1);
		sort($ruta2);
		array_shift($ruta2);
		$ruta = "";
		foreach ($ruta2 as $key => $value) {
			$ruta .= " / $value";
		}
		return $ruta;
	}

	public function internas($id)
	{
		$modelData = new Page_Model_DbTable_Documentos();
		$data1 = $modelData->getList("contenido_padre = " . $id);
		if (empty($data1)) {
			$internas = FALSE;
		} else {
			$internas = TRUE;
		}
		return $internas;
	}

	public function cambioEstadointernas($id, $estado)
	{
		$modelData = new Page_Model_DbTable_Documentos();
		$data1 = $modelData->getList("contenido_padre = " . $id);
		foreach ($data1 as $key => $value) {
			$internas = $this->internas($value->contenido_id);
			if ($internas != FALSE) {
				$this->mainModel->cambioEstado($value->contenido_id, $estado);
				$this->cambioEstadointernas($value->contenido_id, $estado);
			} else {
				$this->mainModel->cambioEstado($value->contenido_id, $estado);
			}
		}
	}

	/**
	 * Genera la consulta con los filtros de este controlador.
	 *
	 * @return array cadena con los filtros que se van a asignar a la base de datos
	 */
	protected function getFilter()
	{
		$filtros = " 1 = 1 ";
		$padre = $this->_getSanitizedParam('padre');

		$solicitudes = $this->_getSanitizedParam('solicitudes');
		$documento_creditos = $this->_getSanitizedParam('documento_creditos');
		if ($solicitudes == "1" or $documento_creditos == "1") {
			$filtros = " 1=0 ";
		}

		$filtros = $filtros . " AND contenido_padre = '$padre' ";
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object)Session::getInstance()->get($this->namefilter);

			if ($filters->contenido_fecha_creacion != '') {
				$filtros = $filtros . " AND contenido_fecha_creacion LIKE '%" . $filters->contenido_fecha_creacion . "%'";
			}
			if ($filters->contenido_fecha_modificacion != '') {
				$filtros = $filtros . " AND contenido_fecha_modificacion LIKE '%" . $filters->contenido_fecha_modificacion . "%'";
			}
			if ($filters->contenido_nombre != '') {
				$filtros = $filtros . " AND contenido_nombre LIKE '%" . $filters->contenido_nombre . "%'";
			}
			if ($filters->contenido_level != '') {
				$filtros = $filtros . " AND contenido_level LIKE '%" . $filters->contenido_level . "%'";
			}
			if ($filters->contenido_estado != '') {
				$filtros = $filtros . " AND contenido_estado LIKE '%" . $filters->contenido_estado . "%'";
			}
		}
		return $filtros;
	}

	protected function getFilter2()
	{
		$filtros = " 1 = 1 ";
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object)Session::getInstance()->get($this->namefilter);
			if ($filters->contenido_buscar != '') {
				$filtros = $filtros . " AND ( contenido_nombre LIKE '%" . $filters->contenido_buscar . "%' OR contenido_cedula_asociado LIKE '%" . $filters->contenido_buscar . "%' OR contenido_archivo LIKE '%" . $filters->contenido_buscar . "%' OR contenido_descripcion LIKE '%" . $filters->contenido_buscar . "%' OR contenido_tags LIKE '%" . $filters->contenido_buscar . "%')";
			}
			if ($filters->contenido_nombre != '') {
				$filtros = $filtros . " AND contenido_nombre LIKE '%" . $filters->contenido_nombre . "%'";
			}
			if ($filters->contenido_cedula_asociado != '') {
				$filtros = $filtros . " AND contenido_cedula_asociado LIKE '%" . $filters->contenido_cedula_asociado . "%'";
			}
			if ($filters->contenido_descripcion != '') {
				$filtros = $filtros . " AND contenido_descripcion LIKE '%" . $filters->contenido_descripcion . "%'";
			}
			if ($filters->contenido_fecha_inicio != '') {
				$filtros .= " AND (contenido_fecha_creacion >= '" . $filters->contenido_fecha_inicio . "' 
								  OR contenido_fecha_modificacion >= '" . $filters->contenido_fecha_inicio . "')";
			}

			if ($filters->contenido_fecha_fin != '') {
				$filtros .= " AND (contenido_fecha_creacion <= '" . $filters->contenido_fecha_fin . "' 
								  OR contenido_fecha_modificacion <= '" . $filters->contenido_fecha_fin . "')";
			}
			if ($filters->contenido_archivo != '') {
				$filtros = $filtros . " AND contenido_archivo LIKE '%" . $filters->contenido_archivo . "%'";
			}
			if ($filters->contenido_estado != '') {
				$filtros = $filtros . " AND contenido_estado LIKE '%" . $filters->contenido_estado . "%'";
			}
			if ($filters->contenido_tags != '') {
				if (strlen(strstr($filters->contenido_tags, ',')) > 0) {
					$tags = explode(",", $filters->contenido_tags);
					$keys = array_keys($tags);
					$fil = "";
					foreach ($tags as $key => $value) {
						if ($key == reset($keys)) {
							$fil .= " ( contenido_tags LIKE '%" . $value . "%' OR";
						} else if ($key != end($keys)) {
							$fil .= "  contenido_tags LIKE '%" . $value . "%' OR";
						} else if ($key == end($keys)) {
							$fil .= " contenido_tags LIKE '%" . $value . "%' )";
						}
					}
					$filtros = $filtros . " AND " . $fil;
				} else {
					$fil = " contenido_tags LIKE '%" . $filters->contenido_tags . "%'";
					$filtros = $filtros . " AND " . $fil;
				}
			}
		}
		return $filtros;
	}

	protected function getFilter3()
	{
		$filtros = " contenido_estado = 1 ";
		$padre = $this->_getSanitizedParam('padre');
		$filtros = $filtros . " AND contenido_padre = '$padre' ";
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object)Session::getInstance()->get($this->namefilter);
			if ($filters->contenido_fecha_creacion != '') {
				$filtros = $filtros . " AND contenido_fecha_creacion LIKE '%" . $filters->contenido_fecha_creacion . "%'";
			}
			if ($filters->contenido_fecha_modificacion != '') {
				$filtros = $filtros . " AND contenido_fecha_modificacion LIKE '%" . $filters->contenido_fecha_modificacion . "%'";
			}
			if ($filters->contenido_nombre != '') {
				$filtros = $filtros . " AND contenido_nombre LIKE '%" . $filters->contenido_nombre . "%'";
			}
			if ($filters->contenido_level != '') {
				$filtros = $filtros . " AND contenido_level LIKE '%" . $filters->contenido_level . "%'";
			}
			if ($filters->contenido_estado != '') {
				$filtros = $filtros . " AND contenido_estado LIKE '%" . $filters->contenido_estado . "%'";
			}
		}
		return $filtros;
	}

	protected function getFilter4()
	{
		$filtros = " contenido_estado = 1 ";
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object)Session::getInstance()->get($this->namefilter);
			if ($filters->contenido_buscar != '') {
				$filtros = $filtros . " AND ( contenido_nombre LIKE '%" . $filters->contenido_buscar . "%' OR contenido_cedula_asociado LIKE '%" . $filters->contenido_buscar . "%' OR contenido_archivo LIKE '%" . $filters->contenido_buscar . "%' OR contenido_descripcion LIKE '%" . $filters->contenido_buscar . "%' OR contenido_tags LIKE '%" . $filters->contenido_buscar . "%')";
			}
			if ($filters->contenido_nombre != '') {
				$filtros = $filtros . " AND contenido_nombre LIKE '%" . $filters->contenido_nombre . "%'";
			}
			if ($filters->contenido_cedula_asociado != '') {
				$filtros = $filtros . " AND contenido_cedula_asociado LIKE '%" . $filters->contenido_cedula_asociado . "%'";
			}
			if ($filters->contenido_descripcion != '') {
				$filtros = $filtros . " AND contenido_descripcion LIKE '%" . $filters->contenido_descripcion . "%'";
			}
			if ($filters->contenido_inicio != '') {
				$filtros = $filtros . " AND  " . $filters->contenido_inicio . "'<= contenido_fecha_modificacion'";
			}
			if ($filters->contenido_final != '') {
				$filtros = $filtros . " AND  " . $filters->contenido_final . "'>= contenido_fecha_modificacion'";
			}
			if ($filters->contenido_archivo != '') {
				$filtros = $filtros . " AND contenido_archivo LIKE '%" . $filters->contenido_archivo . "%'";
			}
			if ($filters->contenido_estado != '') {
				$filtros = $filtros . " AND contenido_estado LIKE '%" . $filters->contenido_estado . "%'";
			}
			if ($filters->contenido_tags != '') {
				if (strlen(strstr($filters->contenido_tags, ',')) > 0) {
					$tags = explode(",", $filters->contenido_tags);
					$keys = array_keys($tags);
					$fil = "";
					foreach ($tags as $key => $value) {
						if ($key == reset($keys)) {
							$fil .= " ( contenido_tags LIKE '%" . $value . "%' OR";
						} else if ($key != end($keys)) {
							$fil .= "  contenido_tags LIKE '%" . $value . "%' OR";
						} else if ($key == end($keys)) {
							$fil .= " contenido_tags LIKE '%" . $value . "%' )";
						}
					}
					$filtros = $filtros . " AND " . $fil;
				} else {
					$fil = " contenido_tags LIKE '%" . $filters->contenido_tags . "%'";
					$filtros = $filtros . " AND " . $fil;
				}
			}
		}
		return $filtros;
	}

	/**
	 * Recibe y asigna los filtros de este controlador
	 *
	 * @return void
	 */
	protected function filters()
	{
		if ($this->getRequest()->isPost() == true) {
			Session::getInstance()->set($this->namepageactual, 1);
			$parramsfilter = array();
			$parramsfilter['contenido_buscar'] =  $this->_getSanitizedParam("contenido_buscar");
			$parramsfilter['contenido_nombre'] =  $this->_getSanitizedParam("contenido_nombre");
			$parramsfilter['contenido_cedula_asociado'] =  $this->_getSanitizedParam("contenido_cedula_asociado");
			$parramsfilter['contenido_descripcion'] =  $this->_getSanitizedParam("contenido_descripcion");
			$parramsfilter['contenido_fecha_inicio'] =  $this->_getSanitizedParam("contenido_fecha_inicio");
			$parramsfilter['contenido_fecha_fin'] =  $this->_getSanitizedParam("contenido_fecha_fin");
			$parramsfilter['contenido_tags'] =  $this->_getSanitizedParam("contenido_tags");
			$parramsfilter['contenido_estado'] =  $this->_getSanitizedParam("contenido_estado");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}
	public function guardarafiliacionAction()
	{
		header('Access-Control-Allow-Origin: *');
		$hash = $this->_getSanitizedParam("hash");
		$cedula = $this->_getSanitizedParam("cedula");
		$hash2 = md5("AfIl" . $cedula);
		echo $hash . "<br>";
		echo $hash2 . "<br>";
		if ($hash && $hash2 && $hash == $hash2) {

			$nombre_asociado = $this->_getSanitizedParam("nombre");

			$nombre = $cedula . " " . $nombre_asociado;
			$fecha = $this->_getSanitizedParam("fecha");
			$data["contenido_fecha_creacion"] = $fecha;
			$data['contenido_fecha_modificacion'] = $fecha;
			$data['contenido_nombre'] = $nombre;
			$data['contenido_descripcion'] = "";
			$data['contenido_cedula_asociado'] = $cedula;
			$data['contenido_tipo'] = 5;
			$data['contenido_padre'] = 200;
			$data['contenido_archivo'] = "";
			$data['contenido_tags'] = "";
			$data['contenido_id_autor'] = 0;
			$data['contenido_estado'] = 1;
			$documentModel = new Page_Model_DbTable_Documentos();
			$existe = $documentModel->getList("contenido_nombre LIKE '%" . $nombre . "%'", "");
			if (count($existe) == 0) {
				$documentModel->insert($data);
			}
		}
	}

	public function procesarAction()
	{

		error_reporting(E_ALL);

		$this->setLayout('blanco');
		// $ruta="E:/apache24/htdocs/fedeaa_documentacion/public/scripts/dropzone/uploads";
		$ruta = "C:/Omega/fedeaa_documentacion-main/public/scripts/dropzone/uploads";

		$this->find_all_files($ruta, "");

		$this->delTree($ruta);
		mkdir($ruta, 0777, true);
	}

	public function find_all_files($dir, $padre = "")
	{
		error_reporting(E_ALL);

		$root = scandir($dir);

		//echo "dir:".$dir." padre:".$padre."<br>";
		//print_r($root);


		$documentosModel = new Page_Model_DbTable_Documentos();
		if ($padre == "") {
			$padre = $_SESSION['padre_actual'];
		}

		foreach ($root as $value) {
			if ($value === '.' || $value === '..') {
				continue;
			}
			if (is_file("$dir/$value")) {
				$result[] = "$dir/$value";

				$nombre = $value;
				$es_carpeta = 0;
				$aux = explode(".", $nombre);
				$extension = $aux[1];

				$data = $this->getData();
				$data['contenido_fecha_creacion'] = date("Y-m-d");
				$data['contenido_fecha_modificacion'] = date("Y-m-d");
				$data['contenido_nombre'] = $nombre;
				$data['contenido_archivo'] = $nombre;

				if ($es_carpeta == 1) {
					$data['contenido_tipo'] = 5;
				} else {


					$id_extension = $this->getContenidotipos($extension);
					$data['contenido_tipo'] = $id_extension;
				}

				$data['contenido_padre'] = $padre;
				$data['contenido_estado'] = 1;
				$id_autor = Session::getInstance()->get("kt_login_id");
				$data['contenido_id_autor'] = $id_autor;

				$existe = $this->mainModel->getList(" contenido_archivo='" . $data['contenido_archivo'] . "' AND contenido_padre='" . $data['contenido_padre'] . "' AND contenido_tipo='$id_extension' ", "");
				if (count($existe) == 0) {
					$id = $this->mainModel->insert($data);
				} else {
					$id = $existe[0]->contenido_id;
				}

				$data1 = $this->stringRut($id);
				$this->mainModel->insertruta($data1, $id);
				$this->mainModel->changeOrder($id, $id);

				continue;
			} else {

				$nombre = $value;
				$es_carpeta = 1;

				$data = $this->getData();
				$data['contenido_fecha_creacion'] = date("Y-m-d");
				$data['contenido_fecha_modificacion'] = date("Y-m-d");
				$data['contenido_nombre'] = $nombre;
				$data['contenido_archivo'] = $nombre;



				if ($es_carpeta == 1) {
					$data['contenido_tipo'] = 5;
				} else {

					$id_extension = $this->getContenidotipos($extension);
					$data['contenido_tipo'] = $id_extension;
				}

				$data['contenido_padre'] = $padre;
				$data['contenido_estado'] = 1;
				$id_autor = Session::getInstance()->get("kt_login_id");
				$data['contenido_id_autor'] = $id_autor;

				$existe = $this->mainModel->getList(" contenido_archivo='" . $data['contenido_archivo'] . "' AND contenido_padre='" . $data['contenido_padre'] . "' AND contenido_tipo='5' ", "");
				if (count($existe) == 0) {
					$id = $this->mainModel->insert($data);
				} else {
					$id = $existe[0]->contenido_id;
				}


				$data1 = $this->stringRut($id);
				$this->mainModel->insertruta($data1, $id);
				$this->mainModel->changeOrder($id, $id);
				$padre_id = $id;
			}

			foreach ($this->find_all_files("$dir/$value", $padre_id) as $value) {
				$result[] = $value;
			}
		}

		return $result;
	}

	public function delTree($dir)
	{

		$files = array_diff(scandir($dir), array('.', '..'));
		foreach ($files as $file) {
			(is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
		}
		return rmdir($dir);
	}
}
