<?php
require 'conexion.php';

$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];

$insert="INSERT INTO tiposervicio(nombre, descripcion, precio) VALUES('$nombre', '$descripcion', '$precio')";

$query=mysqli_query($conectar, $insert);

    if($query==1){
        echo "<script> alert('El servicio $nombre se agrego correctamente.'); location.href='../VISTA/principal/servicios.php'; </script>";
    }else{
        echo "<script> alert('El servicio $nombre NO se agrego correctamente. :('); location.href='../VISTA/principal/servicios.php'; </script>";
    }

?>