<?php

/**
 *
 */

class Page_mainController extends Controllers_Abstract
{

	public $template;

	public function init()
	{
		$this->setLayout('page_page');
		$this->template = new Page_Model_Template_Template($this->_view);
		$this->_view->botonpanel = $this->botonpanel;

		$level = Session::getInstance()->get("kt_login_level");
		$this->_view->level = $level;
		/* $infopageModel = new Page_Model_DbTable_Informacion();
		$this->_view->infopage = $infopageModel->getById(1); */
		$botoneralateral = $this->_view->getRoutPHP('modules/page/Views/partials/botoneralateral.php');
		$this->getLayout()->setData("panel_botones", $botoneralateral);

		$botonerasuperior = $this->_view->getRoutPHP('modules/page/Views/partials/botonerasuperior.php');
		$this->getLayout()->setData("panel_header",$botonerasuperior);

		$footer = $this->_view->getRoutPHP('modules/page/Views/partials/footer.php');
		$this->getLayout()->setData("footer", $footer);
		$this->usuario();
		$this->_view->editoromega = 1;


	}


	public function usuario()
	{
		$userModel = new Core_Model_DbTable_User();
		$user = $userModel->getById(Session::getInstance()->get("kt_login_id"));
		if ($user->user_id == 1) {
			$this->editarpage = 1;
		}
	}
}
