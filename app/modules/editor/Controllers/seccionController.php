<?php
/**
* Controlador de Seccion que permite la  creacion, edicion  y eliminacion de los Secciones del Sistema
*/
class Editor_seccionController extends Editor_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos Secciones
	 * @var modeloContenidos
	 */
	public $mainModel;

	/**
	 * $route  url del controlador base
	 * @var string
	 */
	protected $route;

	/**
	 * $pages cantidad de registros a mostrar por pagina]
	 * @var integer
	 */
	protected $pages ;

	/**
	 * $namefilter nombre de la variable a la fual se le van a guardar los filtros
	 * @var string
	 */
	protected $namefilter;

	/**
	 * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
	 * @var string
	 */
	protected $_csrf_section = "editor_seccion";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador seccion .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Editor_Model_DbTable_Seccion();
		$this->namefilter = "parametersfilterseccion";
		$this->route = "/editor/seccion";
		$this->namepages ="pages_seccion";
		$this->namepageactual ="page_actual_seccion";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Secciones con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Administración de Secciones";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "orden ASC";
		$list = $this->mainModel->getList($filters,$order);
		$amount = $this->pages;
		$page = $this->_getSanitizedParam("page");
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
		   	$page = Session::getInstance()->get($this->namepageactual);
		   	$start = ($page - 1) * $amount;
		} else if(!$page){
			$start = 0;
		   	$page=1;
			Session::getInstance()->set($this->namepageactual,$page);
		} else {
			Session::getInstance()->set($this->namepageactual,$page);
		   	$start = ($page - 1) * $amount;
		}
		$this->_view->register_number = count($list);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($list)/$amount);
		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getListPages($filters,$order,$start,$amount);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->seccion = $this->_getSanitizedParam("seccion");
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Seccion  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_seccion_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->seccion = $this->_getSanitizedParam("seccion");
		$this->_view->padre = $this->_getSanitizedParam("padre");
		$this->_view->url = $this->_getSanitizedParam("url");
		$this->_view->list_seccionpage_tipo = $this->getSeccionpagetipo();
		$this->_view->list_seccionpage_contenido = $this->getSeccionpagecontenido();
		$this->_view->list_seccionpage_ancho = $this->getSeccionpageancho();
		$this->_view->list_seccionpage_espacio = $this->getSeccionpageespacio();
		$this->_view->list_seccionpage_fondo_estilo = $this->getSeccionpagefondoestilo();
		$this->_view->list_seccionpage_fondo_animacion = $this->getSeccionpagefondoanimacion();
		$this->_view->list_seccionpage_disenio = $this->getSeccionpagedisenio();
		$this->_view->list_seccionpage_tipo_contenido = $this->getSeccionpagetipocontenido();
		$this->_view->list_seccionpage_columnas_contenido = $this->getSeccionpagecolumnascontenido();
		$this->_view->tipo = $this->_getSanitizedParam("tipo");
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->seccionpage_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar Seccion";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear Seccion";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear Seccion";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un Seccion  y redirecciona al listado de Secciones.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		$data = $this->getData();
		$uploadImage =  new Core_Model_Upload_Image();
		if($_FILES['seccionpage_fondo_imagen']['name'] != ''){
			$data['seccionpage_fondo_imagen'] = $uploadImage->upload("seccionpage_fondo_imagen");
		}
		$id = $this->mainModel->insert($data);
		$this->mainModel->changeOrder($id,$id);
		$data['seccionpage_id']= $id;
		$data['log_log'] = print_r($data,true);
		$data['log_tipo'] = 'CREAR SECCION';
		$logModel = new Administracion_Model_DbTable_Log();
		$logModel->insert($data);
		$url = $this->_getSanitizedParam("url");
		$url = str_replace("_","/",$url);
		header('Location: /'.$url);
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Seccion  y redirecciona al listado de Secciones.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->seccionpage_id) {
				$data = $this->getData();
				$uploadImage =  new Core_Model_Upload_Image();
				if($_FILES['seccionpage_fondo_imagen']['name'] != ''){
					if($content->seccionpage_fondo_imagen){
						$uploadImage->delete($content->seccionpage_fondo_imagen);
					}
					$data['seccionpage_fondo_imagen'] = $uploadImage->upload("seccionpage_fondo_imagen");
				} else {
					$data['seccionpage_fondo_imagen'] = $content->seccionpage_fondo_imagen;
				}
				$this->mainModel->update($data,$id);
			}
			$data['seccionpage_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR SECCION';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$url = $this->_getSanitizedParam("url");
		$url = str_replace("_","/",$url);
		header('Location: /'.$url);
	}

	public function eliminarAction()
	{
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->url = $this->_getSanitizedParam("url");
		$this->_view->id = $this->_getSanitizedParam("id");
	}


	/**
     * Recibe un identificador  y elimina un Seccion  y redirecciona al listado de Secciones.
     *
     * @return void.
     */
	public function deleteAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf ) {
			$id =  $this->_getSanitizedParam("id");
			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);
				if (isset($content)) {
					$uploadImage =  new Core_Model_Upload_Image();
					if (isset($content->seccionpage_fondo_imagen) && $content->seccionpage_fondo_imagen != '') {
						$uploadImage->delete($content->seccionpage_fondo_imagen);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR SECCION';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		$url = $this->_getSanitizedParam("url");
		$url = str_replace("_","/",$url);
		header('Location: /'.$url);
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Seccion.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['seccionpage_seccion'] = $this->_getSanitizedParamHtml("seccionpage_seccion");
		if($this->_getSanitizedParam("seccionpage_tipo") == '' ) {
			$data['seccionpage_tipo'] = '0';
		} else {
			$data['seccionpage_tipo'] = $this->_getSanitizedParam("seccionpage_tipo");
		}
		if($this->_getSanitizedParam("seccionpage_contenido") == '' ) {
			$data['seccionpage_contenido'] = '0';
		} else {
			$data['seccionpage_contenido'] = $this->_getSanitizedParam("seccionpage_contenido");
		}
		if($this->_getSanitizedParam("seccionpage_ancho") == '' ) {
			$data['seccionpage_ancho'] = '0';
		} else {
			$data['seccionpage_ancho'] = $this->_getSanitizedParam("seccionpage_ancho");
		}
		if($this->_getSanitizedParam("seccionpage_espacio") == '' ) {
			$data['seccionpage_espacio'] = '0';
		} else {
			$data['seccionpage_espacio'] = $this->_getSanitizedParam("seccionpage_espacio");
		}
		$data['seccionpage_fondo_color'] = $this->_getSanitizedParam("seccionpage_fondo_color");
		$data['seccionpage_fondo_imagen'] = "";
		if($this->_getSanitizedParam("seccionpage_fondo_estilo") == '' ) {
			$data['seccionpage_fondo_estilo'] = '0';
		} else {
			$data['seccionpage_fondo_estilo'] = $this->_getSanitizedParam("seccionpage_fondo_estilo");
		}
		if($this->_getSanitizedParam("seccionpage_fondo_animacion") == '' ) {
			$data['seccionpage_fondo_animacion'] = '0';
		} else {
			$data['seccionpage_fondo_animacion'] = $this->_getSanitizedParam("seccionpage_fondo_animacion");
		}

		if($this->_getSanitizedParam("seccionpage_disenio") == '' ) {
			$data['seccionpage_disenio'] = '0';
		} else {
			$data['seccionpage_disenio'] = $this->_getSanitizedParam("seccionpage_disenio");
		}

		if($this->_getSanitizedParam("seccionpage_cantidad") == '' ) {
			$data['seccionpage_cantidad'] = '0';
		} else {
			$data['seccionpage_cantidad'] = $this->_getSanitizedParam("seccionpage_cantidad");
		}
		$data['seccionpage_class'] = $this->_getSanitizedParam("seccionpage_class");
		$data['seccionpage_ordenar'] = $this->_getSanitizedParam("seccionpage_ordenar");
		if($this->_getSanitizedParam("seccionpage_tipo_contenido") == '' ) {
			$data['seccionpage_tipo_contenido'] = '0';
		} else {
			$data['seccionpage_tipo_contenido'] = $this->_getSanitizedParam("seccionpage_tipo_contenido");
		}
		$data['seccionpage_columna'] = $this->_getSanitizedParam("seccionpage_columna");
		if($this->_getSanitizedParam("seccionpage_columnas_contenido") == '' ) {
			$data['seccionpage_columnas_contenido'] = '0';
		} else {
			$data['seccionpage_columnas_contenido'] = $this->_getSanitizedParam("seccionpage_columnas_contenido");
		}
		if($this->_getSanitizedParam("seccionpage_padre") == '' ) {
			$data['seccionpage_padre'] = '0';
		} else {
			$data['seccionpage_padre'] = $this->_getSanitizedParam("seccionpage_padre");
		}
		$data['seccionpage_rutaenlace']= $this->_getSanitizedParam("seccionpage_rutaenlace");
		$data['seccionpage_codigo']= $this->_getSanitizedParamHtml("seccionpage_codigo");
		return $data;
	}

	/**
     * Genera los valores del campo Tipo.
     *
     * @return array cadena con los valores del campo Tipo.
     */
	private function getSeccionpagetipo()
	{
		$array = array();
		$array['1'] = 'Banner';
		$array['2'] = 'Contenido';
		$array['3'] = 'Contenedor';
		return $array;
	}
	
	/**
     * Genera los valores del campo Tipo.
     *
     * @return array cadena con los valores del campo Tipo.
     */
	private function getSeccionpagetipocontenido()
	{
		$array = array();
		$array['1'] = 'Listado Contenidos';
		$array['2'] = 'Carroucel';
		$array['3'] = 'Acordion';
		$array['4'] = 'Codigo';
		return $array;
	}


	/**
     * Genera los valores del campo Contenido.
     *
     * @return array cadena con los valores del campo Contenido.
     */
	private function getSeccionpagecontenido()
	{
		$array = array();
		$array['Data'] = 'Data';
		return $array;
	}

	public function getbannerAction(){
		$this->setLayout("blanco");
		$this->_view->actual = $this->_getSanitizedParam("actual");
		$publicidad = new Administracion_publicidadController();
		$this->_view->seccion = $publicidad->getPublicidadseccion();
	}
	
	public function getcontenidoAction(){
		
		$this->setLayout("blanco");
		$this->_view->actual = $this->_getSanitizedParam("actual");
		$contenidos = new Administracion_contenidosController();
		$this->_view->seccion = $contenidos->getContenidoseccion();
	}


	/**
     * Genera los valores del campo Ancho.
     *
     * @return array cadena con los valores del campo Ancho.
     */
	private function getSeccionpageancho()
	{
		$array = array();
		$array['1'] = 'Ancho Preestablecido';
		$array['2'] = 'Ancho del 100%';
		return $array;
	}


	/**
     * Genera los valores del campo Espacio.
     *
     * @return array cadena con los valores del campo Espacio.
     */
	private function getSeccionpageespacio()
	{
		$array = array();
		$array['1'] = 'Con Espacios';
		$array['2'] = 'Sin Espacios';
		return $array;
	}


	/**
     * Genera los valores del campo Estilo de Fondo.
     *
     * @return array cadena con los valores del campo Estilo de Fondo.
     */
	private function getSeccionpagefondoestilo()
	{
		$array = array();
		$array['1'] = 'Centrado';
		$array['2'] = 'Centrado Superior';
		$array['3'] = 'Centrado Inferior';
		$array['4'] = 'Izquierda Centrado';
		$array['5'] = 'Izquierda Superior';
		$array['6'] = 'Izquierda Inferior';
		$array['7'] = 'Derecha Centrado';
		$array['8'] = 'Derecha Superior';
		$array['9'] = 'Derecha Inferior';

		return $array;
	}


	/**
     * Genera los valores del campo Animaci&oacute;n del Fondo.
     *
     * @return array cadena con los valores del campo Animaci&oacute;n del Fondo.
     */
	private function getSeccionpagefondoanimacion()
	{
		$array = array();
		$array['1'] = 'Sin Repetir fijo';
		$array['2'] = 'Sin Repetir estatico';
		$array['3'] = 'Repetido fijo';
		$array['4'] = 'Repetido estatico';
		$array['5'] = 'Expandido fijo';
		$array['6'] = 'Expandido estatico';
		return $array;
	}

	/**
     * Genera los valores del campo Animaci&oacute;n del Fondo.
     *
     * @return array cadena con los valores del campo Animaci&oacute;n del Fondo.
     */
	private function getSeccionpagedisenio()
	{
		$array = array();
		$array['1'] = 'Diseño 1';
		$array['2'] = 'Diseño 2';
		$array['3'] = 'Diseño 3';
		$array['4'] = 'Diseño 4';
		return $array;
	}
	
	/**
     * Genera los valores del campo Animaci&oacute;n del Fondo.
     *
     * @return array cadena con los valores del campo Animaci&oacute;n del Fondo.
     */
	private function getSeccionpagecolumnascontenido()
	{
		$array = array();
		$array['1'] = '1';
		$array['2'] = '2';
		$array['3'] = '3';
		$array['4'] = '4';
		$array['5'] = '5';
		$array['6'] = '6';
		return $array;
	}

	/**
     * Genera la consulta con los filtros de este controlador.
     *
     * @return array cadena con los filtros que se van a asignar a la base de datos
     */
    protected function getFilter()
    {
    	$filtros = " 1 = 1 ";
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
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
        if ($this->getRequest()->isPost()== true) {
        	Session::getInstance()->set($this->namepageactual,1);
            $parramsfilter = array();Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}