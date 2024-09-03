<?php

/**
 * Controlador de Asociados que permite la  creacion, edicion  y eliminacion de los asociados del Sistema
 */
class Page_asociadosController extends Page_mainController
{
	public $botonpanel = 1;

	/**
	 * $mainModel  instancia del modelo de  base de datos asociados
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
	protected $_csrf_section = "page_asociados";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
	 * Inicializa las variables principales del controlador asociados .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Page_Model_DbTable_Asociados();
		$this->namefilter = "parametersfilterasociados";
		$this->route = "/page/asociados";
		$this->login = "/page/index";
		$this->documentos = "/page/documentos";
		$this->namepages = "pages_asociados";
		$this->namepageactual = "page_actual_asociados";
		$this->_view->route = $this->route;
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
	 * Recibe la informacion y  muestra un listado de  asociados con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level == 1 || $level == 4) {
			$title = "Administración de asociados";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
			$this->filters();
			$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
			$filters = (object)Session::getInstance()->get($this->namefilter);
			$this->_view->filters = $filters;
			$this->_view->level = $level;
			$filters = $this->getFilter();
			$order = "";
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
			/* $secciones = $this->getArraypadre2(0);
			$this->_view->menuV = $this->buildMenu($secciones,TRUE); */
		} else if ($level == 2 || $level == 3) {
			header('Location: ' . $this->documentos . '');
		} else {
			header('Location: ' . $this->login . '');
		}
	}


	public function todosAction()
	{
		$this->setLayout('blanco');
		header("Content-Type:   application/vnd.ms-excel; charset=utf-8");

		$list = $this->mainModel->getList();

		$table = '<table>
					<thead>
						<tr>
							<th>Cedula</th>
							<th>Nombre</th>
						</tr>
					</thead>
				<tbody>';

		foreach ($list as $key => $value) {
			$table .= '<tr>
							<td>' . $value->cedula . '</td>
							<td>' . $value->nombre . '</td>
						</tr>';
		}

		$table .= '</tbody>
			</table>';




		$hoy = date('Y-m-d h:m:s');
		header('Content-Type: application/xls');
		header('Content-Disposition: attachment; filename=recibo_nomina' . $hoy . '.xls');
		echo $table;
		


	}
	/**
	 * Genera la Informacion necesaria para editar o crear un  asociado  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level == 1 || $level == 4) {
			$this->_view->route = $this->route;
			$this->_csrf_section = "manage_asociados_" . date("YmdHis");
			$this->_csrf->generateCode($this->_csrf_section);
			$this->_view->csrf_section = $this->_csrf_section;
			$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
			$this->_view->level = $level;
			/* $secciones = $this->getArraypadre2(0);
			$this->_view->menuV = $this->buildMenu($secciones,TRUE); */
			$header = $this->_view->getRoutPHP('modules/page/Views/partials/header.php');
			$id = $this->_getSanitizedParam("id");
			if ($id > 0) {
				$content = $this->mainModel->getById($id);
				if ($content->id) {
					$this->_view->content = $content;
					$this->_view->routeform = $this->route . "/update";
					$title = "Actualizar asociado";
					$this->getLayout()->setTitle($title);
					$this->_view->titlesection = $title;
				} else {
					$this->_view->routeform = $this->route . "/insert";
					$title = "Crear asociado";
					$this->getLayout()->setTitle($title);
					$this->_view->titlesection = $title;
				}
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear asociado";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else if ($level == 2 || $level == 3) {
			header('Location: ' . $this->documentos . '');
		} else {
			header('Location: ' . $this->login . '');
		}
	}

	/**
	 * Inserta la informacion de un asociado  y redirecciona al listado de asociados.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level == 1 || $level == 4) {
			$this->setLayout('blanco');
			$csrf = $this->_getSanitizedParam("csrf");
			if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
				$data = $this->getData();
				$id = $this->mainModel->insert($data);

				$data['id'] = $id;
				$data['log_log'] = print_r($data, true);
				$data['log_tipo'] = 'CREAR ASOCIADO';
				$logModel = new Administracion_Model_DbTable_Log();
				$logModel->insert($data);
			}
			header('Location: ' . $this->route . '' . '');
		} else if ($level == 2 || $level == 3) {
			header('Location: ' . $this->documentos . '');
		} else {
			header('Location: ' . $this->login . '');
		}
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un asociado  y redirecciona al listado de asociados.
	 *
	 * @return void.
	 */
	public function updateAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level == 1 || $level == 4) {
			$this->setLayout('blanco');
			$csrf = $this->_getSanitizedParam("csrf");
			if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
				$id = $this->_getSanitizedParam("id");
				$content = $this->mainModel->getById($id);
				if ($content->id) {
					$data = $this->getData();
					$this->mainModel->update($data, $id);
				}
				$data['id'] = $id;
				$data['log_log'] = print_r($data, true);
				$data['log_tipo'] = 'EDITAR ASOCIADO';
				$logModel = new Administracion_Model_DbTable_Log();
				$logModel->insert($data);
			}
			header('Location: ' . $this->route . '' . '');
		} else if ($level == 2 || $level == 3) {
			header('Location: ' . $this->documentos . '');
		} else {
			header('Location: ' . $this->login . '');
		}
	}

	/**
	 * Recibe un identificador  y elimina un asociado  y redirecciona al listado de asociados.
	 *
	 * @return void.
	 */
	public function deleteAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level == 1 || $level == 4) {
			$this->setLayout('blanco');
			$csrf = $this->_getSanitizedParam("csrf");
			if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf) {
				$id =  $this->_getSanitizedParam("id");
				if (isset($id) && $id > 0) {
					$content = $this->mainModel->getById($id);
					if (isset($content)) {
						$this->mainModel->deleteRegister($id);
						$data = (array)$content;
						$data['log_log'] = print_r($data, true);
						$data['log_tipo'] = 'BORRAR ASOCIADO';
						$logModel = new Administracion_Model_DbTable_Log();
						$logModel->insert($data);
					}
				}
			}
			header('Location: ' . $this->route . '' . '');
		} else if ($level == 2 || $level == 3) {
			header('Location: ' . $this->documentos . '');
		} else {
			header('Location: ' . $this->login . '');
		}
	}

	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Asociados.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		if ($this->_getSanitizedParam("cedula") == '') {
			$data['cedula'] = '0';
		} else {
			$data['cedula'] = $this->_getSanitizedParam("cedula");
		}
		$data['nombre'] = $this->_getSanitizedParam("nombre");
		return $data;
	}

	public function getArraypadre2($id)
	{
		$dat = [];
		$data = $this->mainModel->getList("contenido_padre = " . $id, "orden ASC");
		$contador = 0;
		foreach ($data as $key => $value) {
			$dat[$key] = [];
			$dat[$key]["id"] = $value->contenido_id;
			$dat[$key]["nombre"] = $value->contenido_nombre;
			$dat[$key]['subcategorias'] =  $this->getArraypadre2($value->contenido_id);
		}
		return $dat;
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
			}
			$menu .= "<li><a>$display</a>$sub</li>";
			unset($url, $display, $sub);
		}
		return $menu . "</ul>";
	}
	/**
	 * Genera la consulta con los filtros de este controlador.
	 *
	 * @return array cadena con los filtros que se van a asignar a la base de datos
	 */
	protected function getFilter()
	{
		$filtros = " 1 = 1 ";
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object)Session::getInstance()->get($this->namefilter);
			if ($filters->cedula != '') {
				$filtros = $filtros . " AND cedula LIKE '%" . $filters->cedula . "%'";
			}
			if ($filters->nombre != '') {
				$filtros = $filtros . " AND nombre LIKE '%" . $filters->nombre . "%'";
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
			$parramsfilter['cedula'] =  $this->_getSanitizedParam("cedula");
			$parramsfilter['nombre'] =  $this->_getSanitizedParam("nombre");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}
}
