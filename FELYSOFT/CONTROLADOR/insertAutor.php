<?php
  require 'Conexion.php';

  $nombreAutor = $_POST['nombre'];
  $nacionalidad = $_POST['nacionalidad'];
  $fechaNacim = $_POST['fechaNacim'];
  $biografia = $_POST['biografia'];

  $insert = "INSERT INTO autores (nombre,nacionalidad,fechaNacim,biografia) VALUES('$nombreAutor','$nacionalidad','$fechaNacim','$biografia')";

  $query= mysqli_query($conectar,$insert);

  if($query){
    echo "<script> alert('El autor $nombreAutor se agregó correctamente.'); location.href='../VISTA/principal/libros.php'; </script>'";
  }
?>