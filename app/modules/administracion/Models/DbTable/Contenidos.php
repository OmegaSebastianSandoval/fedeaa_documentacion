<?php 
/**
* clase que genera la insercion y edicion  de Contenidos en la base de datos
*/
class Administracion_Model_DbTable_Contenidos extends Db_Table
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
	 * insert recibe la informacion de un Contenido y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$contenido_estado = $data['contenido_estado'];
		$contenido_seccion = $data['contenido_seccion'];
		$contenido_fecha = $data['contenido_fecha'];
		$contenido_titulo = $data['contenido_titulo'];
		$contenido_subtitulo = $data['contenido_subtitulo'];
		$contenido_introduccion = $data['contenido_introduccion'];
		$contenido_descripcion = $data['contenido_descripcion'];
		$contenido_imagen = $data['contenido_imagen'];
		$contenido_fondo_color = $data['contenido_fondo_color'];
		$contenido_fondo_imagen = $data['contenido_fondo_imagen'];
		$contenido_enlace = $data['contenido_enlace'];
		$contenido_enlace_abrir = $data['contenido_enlace_abrir'];
		$contenido_enlace_vermas = $data['contenido_enlace_vermas'];
		$query = "INSERT INTO contenido( contenido_estado, contenido_seccion, contenido_fecha, contenido_titulo, contenido_subtitulo, contenido_introduccion, contenido_descripcion, contenido_imagen, contenido_fondo_color, contenido_fondo_imagen, contenido_enlace, contenido_enlace_abrir, contenido_enlace_vermas) VALUES ( '$contenido_estado', '$contenido_seccion', '$contenido_fecha', '$contenido_titulo', '$contenido_subtitulo', '$contenido_introduccion', '$contenido_descripcion', '$contenido_imagen', '$contenido_fondo_color', '$contenido_fondo_imagen', '$contenido_enlace', '$contenido_enlace_abrir', '$contenido_enlace_vermas')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Contenido  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$contenido_estado = $data['contenido_estado'];
		$contenido_seccion = $data['contenido_seccion'];
		$contenido_fecha = $data['contenido_fecha'];
		$contenido_titulo = $data['contenido_titulo'];
		$contenido_subtitulo = $data['contenido_subtitulo'];
		$contenido_introduccion = $data['contenido_introduccion'];
		$contenido_descripcion = $data['contenido_descripcion'];
		$contenido_imagen = $data['contenido_imagen'];
		$contenido_fondo_color = $data['contenido_fondo_color'];
		$contenido_fondo_imagen = $data['contenido_fondo_imagen'];
		$contenido_enlace = $data['contenido_enlace'];
		$contenido_enlace_abrir = $data['contenido_enlace_abrir'];
		$contenido_enlace_vermas = $data['contenido_enlace_vermas'];
		$query = "UPDATE contenido SET  contenido_estado = '$contenido_estado', contenido_seccion = '$contenido_seccion', contenido_fecha = '$contenido_fecha', contenido_titulo = '$contenido_titulo', contenido_subtitulo = '$contenido_subtitulo', contenido_introduccion = '$contenido_introduccion', contenido_descripcion = '$contenido_descripcion', contenido_imagen = '$contenido_imagen', contenido_fondo_color = '$contenido_fondo_color', contenido_fondo_imagen = '$contenido_fondo_imagen', contenido_enlace = '$contenido_enlace', contenido_enlace_abrir = '$contenido_enlace_abrir', contenido_enlace_vermas = '$contenido_enlace_vermas' WHERE contenido_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}