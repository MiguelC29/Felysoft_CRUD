<?php
$id=$_GET['id'];
include("Conexion.php");

//delete
$sql="DELETE FROM tiposervicio WHERE `tiposervicio`.`idTipoServicio` = '" . $id . "'";
$resultado=mysqli_query($conectar,$sql);

if($resultado){
    echo "<script> alert('Los datos se eliminaron correctamente de la base de datos.'); location.href='../VISTA/principal/servicios.php'; </script>";
}else{
    echo "<script> alert('Los datos NO se eliminaron correctamente de la base de datos.'); location.href='../VISTA/principal/servicios.php'; </script>";
}
?>