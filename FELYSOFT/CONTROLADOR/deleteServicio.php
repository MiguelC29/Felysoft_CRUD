<?php
require 'conexion.php';

$idServicio=$_POST["idTipoServicio"];

$delete="DELETE FROM tiposervicio WHERE idTipoServicio = $idServicio";

$query=mysqli_query($conectar, $delete);

if ($query){
    echo "<script>alert('Registro eliminado correctamente.'); location.href='../VISTA/principal/servicios.html';</script>";
}else{
    echo "<script>alert('Error al eliminar el registro.'); location.href='../VISTA/principal/servicios.html';</script>";
}

mysqli_close($conectar);
?>
