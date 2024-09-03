
<?php 

/**
*
*/

class Page_panelController extends Page_mainController
{

	public function indexAction()
	{
		$level = Session::getInstance()->get("kt_login_level");
		if($level){
			$this->_view->seccion = 1;
			$this->_view->level = $level;
			// $this->_view->contenidos = $this->template->getContent(1);
			// $this->_view->list_seccion = $this->getSeccion();
			$header = $this->_view->getRoutPHP('modules/page/Views/partials/header.php');
			$this->getLayout()->setData("header",$header);
			$usuarioModel = new Administracion_Model_DbTable_Usuario();
			$this->_view->level = $level;
			$user = $usuarioModel->getById($_SESSION['kt_login_id']);
			$this->_view->content = $user;
		}else {
			header('Location: '.$this->login.'');
		}

    }

	public function guardarperfilAction()
	{

		$usuarioModel = new Administracion_Model_DbTable_Usuario();
		$id = $this->_getSanitizedParam("id");

		$email = $this->_getSanitizedParam("user_email");
		$usuarioModel->editField($id,"user_email",$email);
		$user_password = $this->_getSanitizedParam("user_password");
		if($user_password!=""){
			$user_password2 = password_hash($user_password, PASSWORD_DEFAULT);
			$usuarioModel->editField($id,"user_password",$user_password2);
		}
		header("Location:/page/panel/index/?a=1");
	}

	private function getSeccion()
	{
		$modelData = new Page_Model_DbTable_Dependseccion();
		$data = $modelData->getList();
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->seccion_id] = $value->seccion_nombre;
		}
		return $array;

	}

}



