<?php
    require "Conexion.php";

    if(isset($_REQUEST['saveProduct'])) {
        // $_FILES LA VARIABLE SUPERGLOBAL, DONDE SE ALMACENAN LAS IMAGENES
        //validar si se envio una foto, si tiene un name es porque si se mando
        if (isset($_FILES['imagenProduct']['name'])) {
            //retener la info de la img
            $tipoArchivo = $_FILES['imagenProduct']['type']; //obtener tipo del archivo
            $nombreArchivo = $_FILES['imagenProduct']['name']; //obtener nombre del archivo
            $tamanoArchivo = $_FILES['imagenProduct']['size']; //obtener tamaño del archivo
            $permitido = array("image/png","image/jpg","image/jpeg"); //tipos de datos permitidos
            if (in_array($tipoArchivo, $permitido) == false) {
                die("<script>alert('Archivo no permitido.'); location.href='../VISTA/principal/productos.php';</script>");
            }

            //fopen abrimos un archivo o leemos un archivo
            //tmp_name es el nombre temporal de donde se almacenan temporalmente las img que subimos
            // 'r' -> modo de fopen, modo de abrir el archivo modo r(read) de lectura
            $imagenSubida = fopen($_FILES['imagenProduct']['tmp_name'], 'r');
            //Extraer los binarios de la img
            $binariosImagen = fread($imagenSubida, $tamanoArchivo);
            $binariosImagen = mysqli_escape_string($conectar, $binariosImagen);
            
            //Recuperar las variables
            $nomProduc = $_POST["nomP"];
            $marca = $_POST["marca"];
            $precioV = $_POST["precioV"];
            $fVencimiento = $_POST["fVencimiento"];
            $categoria = $_POST["categoria"];
            $proveedor = $_POST["proveedor"];

            //Creamos la sentencia de sql para insertar datos en la tabla productos
            $insert = "INSERT INTO productos(nombre, marca, precioVenta, fechaVencimiento, fkIdCategoria, fkIdProveedor, imagen, tipoImg) VALUES ('$nomProduc', '$marca', '$precioV', '$fVencimiento', '$categoria', '$proveedor', '$binariosImagen', '$tipoArchivo')";

            //ejercutacion la sentencia de la linea 10
            $query = mysqli_query($conectar, $insert);

            //Verificar la conexión
            if($query) {
                echo "<script> alert('El producto $nomProduc se agregó correctamente.'); location.href='../VISTA/principal/productos.php';</script>'";
            } else {
                echo "<script> alert('ERROR: Los datos NO fueron almacenados correctamente en la BD.'); location.href='../VISTA/principal/productos.php';</script>'";
            }
            mysqli_close($conectar);
        }
    }
?>