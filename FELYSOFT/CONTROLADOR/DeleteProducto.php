<?php
    $pkIdProducto = $_GET['pkIdProducto'];
    require "Conexion.php";

    $sql = "DELETE FROM productos WHERE pkIdProducto = '".$pkIdProducto."'";
    $result = mysqli_query($conectar, $sql);

    if ($result) {
        echo "<script languaje='JavaScript'>
                alert('Los datos se eliminaron correctamente de la BD');
                location.assign('../VISTA/principal/productos.php');
              </script>";
    } else {
        echo "<script languaje='JavaScript'>
                alert('Los datos NO se eliminaron de la BD');
                location.assign('../VISTA/principal/productos.php');
              </script>";
    }
    
?>