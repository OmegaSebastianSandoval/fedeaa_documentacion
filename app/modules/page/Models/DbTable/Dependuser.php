<?php 
/**
* clase que genera la clase dependiente  de archivos en la base de datos
*/
class Page_Model_DbTable_Dependuser extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'user';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'user_id';

}