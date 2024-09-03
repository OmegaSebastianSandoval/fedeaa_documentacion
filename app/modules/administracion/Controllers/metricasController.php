<?php

/**
*
*/
class Administracion_metricasController extends Administracion_mainController
{
	public function indexAction()
	{
		$this->getLayout()->setTitle("Metricas");
		$infoModel = new Administracion_Model_DbTable_Informacion();
		$this->_view->info = $infoModel->getList("","")[0];
	}

}