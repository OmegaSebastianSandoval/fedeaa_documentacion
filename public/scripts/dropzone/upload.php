
<?php
    $ds = DIRECTORY_SEPARATOR;
    $storeFolder = 'uploads/';
     
    if (!empty($_FILES)) {
         
        $tempFile = $_FILES['file']['tmp_name'];
          
        $targetPath = dirname( __FILE__ ) . $ds . $storeFolder . $ds;
        
		if( $_POST['path'] == 'undefined' ){
			$_POST['path'] = $_FILES['file']['name'];
		}
		
        $fullPath = $storeFolder.rtrim($_POST['path'], "/.");
        $folder = substr($fullPath, 0, strrpos($fullPath, "/"));

        if (!is_dir($folder)) {
            $old = umask(0);
            mkdir($folder, 0777, true);
            umask($old);
        }    
		

		//verificar si archivo existe
		
		$filename = ''.pathinfo($_POST['path'], PATHINFO_FILENAME);
		$extension = pathinfo($_POST['path'], PATHINFO_EXTENSION);
		$name = $filename.'.'.$extension;
		$original = $name;
		// $ruta = "E:/apache24/htdocs/fedeaa_documentacion/public/documentos/".$name;
		$ruta = "C:/Omega/fedeaa_documentacion-main/public/".$name;
		
		//echo "ruta:".$ruta."<br>";
		if(file_exists($ruta)) {
			//echo "ya existe<br>";
		}else{
			//echo "no existe<br>";
		}
		
		if(file_exists($ruta)) {
			$increment = 0;
			while (file_exists($ruta)) {
				$increment++;
				$name =$filename.$increment.'.'.$extension;
				// $ruta = "E:/apache24/htdocs/fedeaa_documentacion/public/documentos/".$name;
				$ruta = "C:/Omega/fedeaa_documentacion-main/public/".$name;

			}
		}		
		
		if($name!=$original){
			$fullPath = str_replace($original,$name,$fullPath);
		}
		
		//verificar si archivo existe
		
        
        if (move_uploaded_file($tempFile, $fullPath)) {

			//copiar archivo a documentos			
			// copy("E:/apache24/htdocs/fedeaa_documentacion/public/scripts/dropzone/".$fullPath, "E:/apache24/htdocs/fedeaa_documentacion/public/documentos/".$name);	
			copy("C:/Omega/fedeaa_documentacion-main/public/scripts/dropzone/".$fullPath, "C:/Omega/fedeaa_documentacion-main/public/documentos/".$name);	
			
			//echo "ruta1:"."E:/apache24/htdocs/fedeaa_documentacion/public/scripts/dropzone/".$fullPath;
			//echo "<br>";
			//echo "ruta2:"."E:/apache24/htdocs/fedeaa_documentacion/public/documentos/".$_POST['path'];
			//echo "<br>";
			
            die($fullPath);
        } else {
            die('e');
        }
    }
?>
