<?php 
/**
* clase que genera la insercion y edicion  de archivos en la base de datos
*/
class Page_Model_DbTable_Archivos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'archivos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'archivos_id';

	/**
	 * insert recibe la informacion de un archivos y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$archivos_asociados = $data['archivos_asociados'];
		$query = "INSERT INTO archivos( archivos_asociados) VALUES ( '$archivos_asociados')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un archivos  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		 
		$archivos_asociados = $data['archivos_asociados'];
		$query = "UPDATE archivos SET  archivos_asociados = '$archivos_asociados' WHERE archivos_id = '".$id."'";
		$res = $this->_conn->query($query);
	}

}