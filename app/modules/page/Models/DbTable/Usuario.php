<?php 
/**
* clase que genera la insercion y edicion  de Usuarios en la base de datos
*/
class Page_Model_DbTable_Usuario extends Db_Table
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

	/**
	 * insert recibe la informacion de un Usuario y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$user_names = $data['user_names'];
		$user_email = $data['user_email'];
		$user_level = $data['user_level'];
		$user_contenido = $data['user_contenido'];
		$user_date = $data['user_date'];
		$user_state = $data['user_state'];
		$user_user = $data['user_user'];
		$user_password = $data['user_password'];
		$user_delete = $data['user_delete'];
		$user_current_user = $data['user_current_user'];
		$user_code = $data['user_code'];
		$query = "INSERT INTO user( user_names, user_email, user_level, user_contenido, user_date, user_state, user_user, user_password, user_delete, user_current_user, user_code) VALUES ( '$user_names', '$user_email', '$user_level', '$user_contenido', '$user_date', '$user_state', '$user_user', '$user_password', '$user_delete', '$user_current_user', '$user_code')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Usuario  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$user_names = $data['user_names'];
		$user_email = $data['user_email'];
		$user_level = $data['user_level'];
		$user_contenido = $data['user_contenido'];
		$user_date = $data['user_date'];
		$user_state = $data['user_state'];
		$user_user = $data['user_user'];
		if($data['user_password']!=""){
			$user_password = $data['user_password'];
		}
		$user_delete = $data['user_delete'];
		$user_current_user = $data['user_current_user'];
		$user_code = $data['user_code'];
		if($data['user_password']!=""){
			echo $query = "UPDATE user SET  user_names = '$user_names', user_email = '$user_email', user_level = '$user_level', user_contenido = '$user_contenido', user_date = '$user_date', user_state = '$user_state', user_user = '$user_user', user_password = '$user_password', user_delete = '$user_delete', user_current_user = '$user_current_user', user_code = '$user_code' WHERE user_id = '".$id."'";
		}else{
			echo $query = "UPDATE user SET  user_names = '$user_names', user_email = '$user_email', user_level = '$user_level', user_contenido = '$user_contenido', user_date = '$user_date', user_state = '$user_state', user_user = '$user_user', user_delete = '$user_delete', user_current_user = '$user_current_user', user_code = '$user_code' WHERE user_id = '".$id."'";
		}
		$res = $this->_conn->query($query);
	}
}