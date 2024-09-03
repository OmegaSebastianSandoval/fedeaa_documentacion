<?php 
/**
* clase que genera la insercion y edicion  de Secciones en la base de datos
*/
class Editor_Model_DbTable_Seccion extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'seccionpage';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'seccionpage_id';

	/**
	 * insert recibe la informacion de un Seccion y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$seccionpage_seccion = $data['seccionpage_seccion'];
		$seccionpage_tipo = $data['seccionpage_tipo'];
		$seccionpage_contenido = $data['seccionpage_contenido'];
		$seccionpage_ancho = $data['seccionpage_ancho'];
		$seccionpage_espacio = $data['seccionpage_espacio'];
		$seccionpage_fondo_color = $data['seccionpage_fondo_color'];
		$seccionpage_fondo_imagen = $data['seccionpage_fondo_imagen'];
		$seccionpage_fondo_estilo = $data['seccionpage_fondo_estilo'];
		$seccionpage_fondo_animacion = $data['seccionpage_fondo_animacion'];
		$seccionpage_class = $data['seccionpage_class'];
		$seccionpage_disenio = $data['seccionpage_disenio'];
		$seccionpage_cantidad = $data['seccionpage_cantidad'];
		$seccionpage_ordenar = $data['seccionpage_ordenar'];
		$seccionpage_tipo_contenido = $data['seccionpage_tipo_contenido'];
		$seccionpage_columna = $data['seccionpage_columna'];
		$seccionpage_columnas_contenido = $data['seccionpage_columnas_contenido'];
		$seccionpage_rutaenlace = $data['seccionpage_rutaenlace'];
		$seccionpage_codigo = $data['seccionpage_codigo'];
		$seccionpage_padre = $data['seccionpage_padre'];
		$query = "INSERT INTO seccionpage( seccionpage_seccion, seccionpage_tipo, seccionpage_contenido, seccionpage_ancho, seccionpage_espacio, seccionpage_fondo_color, seccionpage_fondo_imagen, seccionpage_fondo_estilo, seccionpage_fondo_animacion, seccionpage_class,seccionpage_disenio,seccionpage_cantidad,seccionpage_ordenar,seccionpage_tipo_contenido, seccionpage_columna, seccionpage_columnas_contenido, seccionpage_rutaenlace, seccionpage_codigo,seccionpage_padre) VALUES ( '$seccionpage_seccion', '$seccionpage_tipo', '$seccionpage_contenido', '$seccionpage_ancho', '$seccionpage_espacio', '$seccionpage_fondo_color', '$seccionpage_fondo_imagen', '$seccionpage_fondo_estilo', '$seccionpage_fondo_animacion','$seccionpage_class','$seccionpage_disenio','$seccionpage_cantidad','$seccionpage_ordenar','$seccionpage_tipo_contenido', '$seccionpage_columna', '$seccionpage_columnas_contenido', '$seccionpage_rutaenlace', '$seccionpage_codigo','$seccionpage_padre')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Seccion  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$seccionpage_seccion = $data['seccionpage_seccion'];
		$seccionpage_tipo = $data['seccionpage_tipo'];
		$seccionpage_contenido = $data['seccionpage_contenido'];
		$seccionpage_ancho = $data['seccionpage_ancho'];
		$seccionpage_espacio = $data['seccionpage_espacio'];
		$seccionpage_fondo_color = $data['seccionpage_fondo_color'];
		$seccionpage_fondo_imagen = $data['seccionpage_fondo_imagen'];
		$seccionpage_fondo_estilo = $data['seccionpage_fondo_estilo'];
		$seccionpage_fondo_animacion = $data['seccionpage_fondo_animacion'];
		$seccionpage_disenio = $data['seccionpage_disenio'];
		$seccionpage_class = $data['seccionpage_class'];
		$seccionpage_cantidad = $data['seccionpage_cantidad'];
		$seccionpage_ordenar = $data['seccionpage_ordenar'];
		$seccionpage_tipo_contenido = $data['seccionpage_tipo_contenido'];
		$seccionpage_columna = $data['seccionpage_columna'];
		$seccionpage_columnas_contenido = $data['seccionpage_columnas_contenido'];
		$seccionpage_rutaenlace = $data['seccionpage_rutaenlace'];
		$seccionpage_codigo = $data['seccionpage_codigo'];
		$seccionpage_padre = $data['seccionpage_padre'];
		$query = "UPDATE seccionpage SET  seccionpage_seccion = '$seccionpage_seccion', seccionpage_tipo = '$seccionpage_tipo', seccionpage_contenido = '$seccionpage_contenido', seccionpage_ancho = '$seccionpage_ancho', seccionpage_espacio = '$seccionpage_espacio', seccionpage_fondo_color = '$seccionpage_fondo_color', seccionpage_fondo_imagen = '$seccionpage_fondo_imagen', seccionpage_fondo_estilo = '$seccionpage_fondo_estilo', seccionpage_fondo_animacion = '$seccionpage_fondo_animacion', seccionpage_class ='$seccionpage_class', seccionpage_disenio='$seccionpage_disenio', seccionpage_cantidad='$seccionpage_cantidad', seccionpage_ordenar='$seccionpage_ordenar', seccionpage_tipo_contenido = '$seccionpage_tipo_contenido', seccionpage_columna = '$seccionpage_columna', seccionpage_columnas_contenido = '$seccionpage_columnas_contenido', seccionpage_rutaenlace = '$seccionpage_rutaenlace', seccionpage_codigo = '$seccionpage_codigo', seccionpage_padre='$seccionpage_padre' WHERE seccionpage_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}