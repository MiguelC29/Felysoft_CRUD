<?php
    require "Conexion.php";

    //Recuperar las variables
    $nomProduc = $_POST["nomP"];
    $marca = $_POST["marca"];
    $precioV = $_POST["precioV"];
    $fVencimiento = $_POST["fVencimiento"];
    $categoria = $_POST["categoria"];
    $proveedor = $_POST["proveedor"];
    $imagen = $_POST["formFile"];

    //Creamos la sentencia de sql para insertar datos en la tabla productos
    $insert = "INSERT INTO productos(nombre, marca, precioVenta, fechaVencimiento, fkIdCategoria, fkIdProveedor, imagen) VALUES ('$nomProduc', '$marca', '$precioV', '$fVencimiento', '$categoria', '$proveedor', '$imagen')";

    //ejercutacion la sentencia de la linea 10
    $query = mysqli_query($conectar, $insert);

    //Verificar la conexión
    if($query) {
        echo "<script> alert('El producto $nombre se agregó correctamente.'); location.href='../VISTA/principal/productos.php'; </script>'";
    }
?>