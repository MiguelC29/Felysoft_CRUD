<?php
require 'Conexion.php';
if (isset($_REQUEST["btnAgregar"])) {

  $titulo = $_POST['titulo'];
  $editorial = $_POST['editorial'];
  $descripcion = $_POST['Descripcion'];
  $anioPublicacion = $_POST['anioPublicacion'];
  $precioHora = $_POST['precio'];
  $autor = $_POST['autor'];
  $genero = $_POST['genero'];

  $insert = "INSERT INTO libros (titulo,editorial,descripcion,anioPublicacion,precioHora,fkIdAutor,fkIdGenero) VALUES('$titulo','$editorial','$descripcion','$anioPublicacion','$precioHora','$autor','$genero')";

  $query= mysqli_query($conectar,$insert);

  if($query){
    echo "<script> alert('El libro $titulo se agregó correctamente.'); location.href='../VISTA/principal/libros.php'; </script>'";
  }else{
    echo "<script> alert('ERROR: Los Datos NO fueron almacenados correctamente en la BD'); location.href='../VISTA/principal/libros.php'; </script>'";
    }
    mysqli_close($conectar);
}
?>