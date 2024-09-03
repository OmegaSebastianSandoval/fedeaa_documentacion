<?php

/**
*
*/

class Page_indexController extends Page_mainController
{

	public function indexAction()
	{
		
		$id = Session::getInstance()->get("kt_login_id");
        if(isset($id) && $id > 0 ){
            header('Location: /page/documentos');
        }else{
			header('Location: /page/login');
		}
        $this->_view->error_login = Session::getInstance()->get("error_login");
		Session::getInstance()->set("error_login","");
	}
}