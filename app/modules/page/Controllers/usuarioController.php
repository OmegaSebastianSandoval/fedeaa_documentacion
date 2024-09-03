<?php

/**
 * Controlador de Usuario que permite la  creacion, edicion  y eliminacion de los Usuarios del Sistema
 */
class Page_usuarioController extends Page_mainController
{

	public $botonpanel = 3;

	/**
	 * $mainModel  instancia del modelo de  base de datos Usuarios
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
	protected $_csrf_section = "page_usuario";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
	 * Inicializa las variables principales del controlador usuario .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Page_Model_DbTable_Usuario();
		$this->namefilter = "parametersfilterusuario";
		$this->route = "/page/usuario";
		$this->login = "/page/login";
		$this->documentos = "/page/documentos";
		$this->namepages = "pages_usuario";
		$this->namepageactual = "page_actual_usuario";
		$this->_view->route = $this->route;
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
	 * Recibe la informacion y  muestra un listado de  Usuarios con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level == 1 || $level == 4) {
			$title = "Administración de Usuarios";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
			$this->filters();
			$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
			$filters = (object)Session::getInstance()->get($this->namefilter);
			$this->_view->filters = $filters;
			if ($level == 4) {
				$filters = $this->getFilter();
			} else {
				$filters = $this->getFilter2();
			}
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
			$this->_view->list_user_level = $this->getUserlevel();
			$this->_view->list_user_contenido = $this->getUsercontenido();
			$this->_view->listacontenido = $this->getcontenido();
		} else if ($level == 2 || $level == 3) {
			header('Location: ' . $this->documentos . '');
		} else {
			header('Location: ' . $this->login . '');
		}
	}

	/**
	 * Genera la Informacion necesaria para editar o crear un  Usuario  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level == 1 || $level == 4) {
			$this->_view->route = $this->route;
			$this->_csrf_section = "manage_usuario_" . date("YmdHis");
			$this->_csrf->generateCode($this->_csrf_section);
			$this->_view->csrf_section = $this->_csrf_section;
			$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
			$this->_view->list_user_level = $this->getUserlevel();
			$this->_view->list_user_contenido = $this->getUsercontenido();
			$this->_view->listacontenido = $this->getcontenido();
			$this->_view->level = $level;
			$id = $this->_getSanitizedParam("id");
			if ($id > 0) {
				$content = $this->mainModel->getById($id);
				if ($content->user_id) {
					$this->_view->content = $content;
					$this->_view->routeform = $this->route . "/update";
					$title = "Actualizar Usuario";
					$this->getLayout()->setTitle($title);
					$this->_view->titlesection = $title;
				} else {
					$this->_view->routeform = $this->route . "/insert";
					$title = "Crear Usuario";
					$this->getLayout()->setTitle($title);
					$this->_view->titlesection = $title;
				}
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear Usuario";
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
	 * Inserta la informacion de un Usuario  y redirecciona al listado de Usuarios.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level) {
			$this->setLayout('blanco');
			$csrf = $this->_getSanitizedParam("csrf");
			if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
				$data = $this->getData();
				$id = $this->mainModel->insert($data);

				$data['user_id'] = $id;
				$data['log_log'] = print_r($data, true);
				$data['log_tipo'] = 'CREAR USUARIO';
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
	 * Recibe un identificador  y Actualiza la informacion de un Usuario  y redirecciona al listado de Usuarios.
	 *
	 * @return void.
	 */
	public function updateAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if ($level) {
			$this->setLayout('blanco');
			$csrf = $this->_getSanitizedParam("csrf");
			if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
				$id = $this->_getSanitizedParam("id");
				$content = $this->mainModel->getById($id);
				if ($content->user_id) {
					$data = $this->getData();
					print_r($data);
					$this->mainModel->update($data, $id);
				}
				$data['user_id'] = $id;
				$data['log_log'] = print_r($data, true);
				$data['log_tipo'] = 'EDITAR USUARIO';
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
	 * Recibe un identificador  y elimina un Usuario  y redirecciona al listado de Usuarios.
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
				if (isset($id) && $id > 0) {
					$content = $this->mainModel->getById($id);
					if (isset($content)) {
						$this->mainModel->deleteRegister($id);
						$data = (array)$content;
						$data['log_log'] = print_r($data, true);
						$data['log_tipo'] = 'BORRAR USUARIO';
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
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Usuario.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		$data['user_names'] = $this->_getSanitizedParam("user_names");
		$data['user_email'] = $this->_getSanitizedParam("user_email");
		if ($this->_getSanitizedParam("user_level") == '') {
			$data['user_level'] = '0';
		} else {
			$data['user_level'] = $this->_getSanitizedParam("user_level");
		}
		if ($this->getRequest()->_getParam('user_contenido') == '') {
			$data['user_contenido'] = '0';
		} else {
			$user_contenido = $this->getRequest()->_getParam('user_contenido');
			$keys = array_keys($user_contenido);
			foreach ($user_contenido as $key => $value) {
				if ($key === reset($keys)) {
					$fil .= $value . ",";
				} else if ($key != end($keys)) {
					$fil .= $value . ",";
				} else if ($key === end($keys)) {
					$fil .= $value;
				}
			}
			$data['user_contenido'] = $fil;
		}
		$data['user_date'] = $this->_getSanitizedParam("user_date");
		$data['user_state'] = '1';
		$data['user_user'] = $this->_getSanitizedParam("user_user");
		if ($this->_getSanitizedParam("user_password") != '') {
			print_r($this->_getSanitizedParam("user_password"));
			$data['user_password'] = password_hash($this->_getSanitizedParam("user_password"), PASSWORD_DEFAULT);
		}
		$data['user_delete'] = '1';
		$data['user_current_user'] = '1';
		$data['user_code'] = '1';
		return $data;
	}

	/**
	 * Genera los valores del campo Nivel de Usuario.
	 *
	 * @return array cadena con los valores del campo Nivel de Usuario.
	 */
	private function getUserlevel()
	{
		$modelData = new Page_Model_DbTable_Dependlevel();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->id] = $value->nombre;
		}
		return $array;
	}


	/**
	 * Genera los valores del campo Categor&iacute;a.
	 *
	 * @return array cadena con los valores del campo Categor&iacute;a.
	 */
	private function getUsercontenido()
	{
		$modelData = new Page_Model_DbTable_Documentos();
		$data = $modelData->getList("contenido_padre = 0");
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->contenido_id] = $value->contenido_nombre;
		}
		return $array;
	}

	private function getcontenido()
	{
		$modelData = new Page_Model_DbTable_Documentos();
		$data = $modelData->getList("contenido_padre = 0");
		$array = array();
		foreach ($data as $key => $value) {
			$array[$key] = $value->contenido_id;
		}
		return $array;
	}

	public function validarAction()
	{

		header('Content-Type:application/json');
		$this->setLayout('blanco');
		$usuario = $this->_getSanitizedParam("usuario");
		$email = $this->_getSanitizedParam("email");

		$existe = $this->mainModel->getList(" user_user ='$usuario' ", "");
		$res = 0;
		if (count($existe) > 0) {
			$res = 1;
		}
		$respuesta['existe'] = $res;

		$existe2 = $this->mainModel->getList(" user_email ='$email' ", "");
		$res2 = 0;
		if (count($existe2) > 0) {
			$res2 = 1;
		}
		$respuesta['existe2'] = $res2;

		echo json_encode($respuesta);
	}

	public function validarAdministradorAction()
	{

		header('Content-Type:application/json');
		$this->setLayout('blanco');
		$level = $this->_getSanitizedParam("level");

		if ($level == 1) {
			$res = 1;
		} else {
			$res = 0;
		}
		$respuesta['existe'] = $res;
		echo json_encode($respuesta);
	}

	/**
	 * Genera la consulta con los filtros de este controlador.
	 *
	 * @return array cadena con los filtros que se van a asignar a la base de datos
	 */
	protected function getFilter()
	{
		$filtros = " 1=1 ";
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object)Session::getInstance()->get($this->namefilter);
			if ($filters->user_names != '') {
				$filtros = $filtros . " AND user_names LIKE '%" . $filters->user_names . "%'";
			}
			if ($filters->user_email != '') {
				$filtros = $filtros . " AND user_email LIKE '%" . $filters->user_email . "%'";
			}
			if ($filters->user_level != '') {
				$filtros = $filtros . " AND user_level LIKE '%" . $filters->user_level . "%'";
			}
			if ($filters->user_contenido != '') {
				$user_contenido = explode(",", $filters->user_contenido);
				$keys = array_keys($user_contenido);
				foreach ($user_contenido as $key => $value) {
					if (count($keys) != 1) {
						if ($key == reset($keys)) {
							$fil .= " ( user_contenido LIKE '%" . $value . "%' AND";
						} else if ($key != end($keys)) {
							$fil .= "  user_contenido LIKE '%" . $value . "%' AND";
						} else if ($key == end($keys)) {
							$fil .= " user_contenido LIKE '%" . $value . "%' )";
						}
					} else {
						$fil .= " user_contenido LIKE '%" . $value . "%' ";
					}
				}
				$filtros = $filtros . " AND " . $fil;
			}

			if ($filters->user_date != '') {
				$filtros = $filtros . " AND user_date LIKE '%" . $filters->user_date . "%'";
			}
			if ($filters->user_user != '') {
				$filtros = $filtros . " AND user_user LIKE '%" . $filters->user_user . "%'";
			}
		}
		return $filtros;
	}

	protected function getFilter2()
	{
		$filtros = " user_level != 4 ";
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object)Session::getInstance()->get($this->namefilter);
			if ($filters->user_names != '') {
				$filtros = $filtros . " AND user_names LIKE '%" . $filters->user_names . "%'";
			}
			if ($filters->user_email != '') {
				$filtros = $filtros . " AND user_email LIKE '%" . $filters->user_email . "%'";
			}
			if ($filters->user_level != '') {
				$filtros = $filtros . " AND user_level LIKE '%" . $filters->user_level . "%'";
			}
			if ($filters->user_contenido != '') {
				$user_contenido = explode(",", $filters->user_contenido);
				$keys = array_keys($user_contenido);
				foreach ($user_contenido as $key => $value) {
					if (count($keys) != 1) {
						if ($key == reset($keys)) {
							$fil .= " ( user_contenido LIKE '%" . $value . "%' AND";
						} else if ($key != end($keys)) {
							$fil .= "  user_contenido LIKE '%" . $value . "%' AND";
						} else if ($key == end($keys)) {
							$fil .= " user_contenido LIKE '%" . $value . "%' )";
						}
					} else {
						$fil .= " user_contenido LIKE '%" . $value . "%' ";
					}
				}
				$filtros = $filtros . " AND " . $fil;
			}
			if ($filters->user_date != '') {
				$filtros = $filtros . " AND user_date LIKE '%" . $filters->user_date . "%'";
			}
			if ($filters->user_user != '') {
				$filtros = $filtros . " AND user_user LIKE '%" . $filters->user_user . "%'";
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
		// error_reporting(E_ALL);
		if ($this->getRequest()->isPost() == true) {
			// print_r($this->getRequest()->_getParam('user_contenido'));
			Session::getInstance()->set($this->namepageactual, 1);
			$parramsfilter = array();
			$parramsfilter['user_names'] =  $this->_getSanitizedParam("user_names");
			$parramsfilter['user_email'] =  $this->_getSanitizedParam("user_email");
			$parramsfilter['user_level'] =  $this->_getSanitizedParam("user_level");
			if ($this->getRequest()->_getParam('user_contenido')) {
				$parramsfilter['user_contenido'] =  implode(",", $this->getRequest()->_getParam('user_contenido'));
			}
			$parramsfilter['user_date'] =  $this->_getSanitizedParam("user_date");
			$parramsfilter['user_user'] =  $this->_getSanitizedParam("user_user");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}
}
