<?php 
/**
* clase que genera la insercion y edicion  de documento en la base de datos
*/
class Page_Model_DbTable_Documentos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'contenido';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'contenido_id';

	/**
	 * insert recibe la informacion de un documentos y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$contenido_fecha_creacion = $data['contenido_fecha_creacion'];
		$contenido_fecha_modificacion = $data['contenido_fecha_modificacion'];
		$contenido_nombre = $data['contenido_nombre'];
		$contenido_descripcion = $data['contenido_descripcion'];
		$contenido_cedula_asociado = $data['contenido_cedula_asociado'];
		$contenido_tipo = $data['contenido_tipo'];
		$contenido_padre = $data['contenido_padre'];
		$contenido_archivo = $data['contenido_archivo'];
		$contenido_tags = $data['contenido_tags'];
		$contenido_id_autor = $data['contenido_id_autor'];
		$contenido_estado = $data['contenido_estado'];
		$query = "INSERT INTO contenido( contenido_fecha_creacion, contenido_fecha_modificacion, contenido_nombre, contenido_descripcion, contenido_cedula_asociado, contenido_tipo, contenido_padre, contenido_archivo, contenido_tags, contenido_id_autor, contenido_estado) VALUES ('$contenido_fecha_creacion', '$contenido_fecha_modificacion', '$contenido_nombre', '$contenido_descripcion', '$contenido_cedula_asociado', '$contenido_tipo', '$contenido_padre', '$contenido_archivo', '$contenido_tags', '$contenido_id_autor', '$contenido_estado')";
		$this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}
	
	/**
	 * update Recibe la informacion de un documentos  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		$contenido_fecha_creacion = $data['contenido_fecha_creacion'];
		$contenido_fecha_modificacion = $data['contenido_fecha_modificacion'];
		$contenido_nombre = $data['contenido_nombre'];
		$contenido_descripcion = $data['contenido_descripcion'];
		$contenido_cedula_asociado = $data['contenido_cedula_asociado'];
		$contenido_tipo = $data['contenido_tipo'];
		$contenido_padre = $data['contenido_padre'];
		$contenido_archivo = $data['contenido_archivo'];
		$contenido_tags = $data['contenido_tags'];
		$contenido_id_autor = $data['contenido_id_autor'];
		$contenido_estado = $data['contenido_estado'];
		$query = "UPDATE contenido SET  contenido_fecha_creacion = '$contenido_fecha_creacion', contenido_fecha_modificacion = '$contenido_fecha_modificacion', contenido_nombre = '$contenido_nombre', contenido_descripcion = '$contenido_descripcion', contenido_cedula_asociado = '$contenido_cedula_asociado', contenido_tipo = '$contenido_tipo', contenido_padre = '$contenido_padre', contenido_archivo = '$contenido_archivo', contenido_tags = '$contenido_tags', contenido_id_autor = '$contenido_id_autor', contenido_estado = '$contenido_estado' WHERE contenido_id = '".$id."'";
		$res = $this->_conn->query($query);
	}

	public function update1($data,$id){
		$contenido_archivo = $data['contenido_archivo'];
		$query = "UPDATE contenido SET  contenido_archivo = '$contenido_archivo' WHERE contenido_id = '".$id."'";
		$res = $this->_conn->query($query);
	}

	public function insertruta($data1,$id){
		$contenido_ruta = $data1;
		$query = "UPDATE contenido SET  contenido_ruta = '$contenido_ruta' WHERE contenido_id = '".$id."'";
		$res = $this->_conn->query($query);
	}

	public function cambioEstado($id,$estado){
		$contenido_estado = $estado;
		$query = "UPDATE contenido SET  contenido_estado = '$contenido_estado' WHERE contenido_id = '".$id."'";
		$res = $this->_conn->query($query);
	}

	public function moverContenido($id,$mov){
		$contenido_padre = $mov;
		$query = "UPDATE contenido SET  contenido_padre = '$contenido_padre' WHERE contenido_id = '".$id."'";
		$res = $this->_conn->query($query);
	}

}