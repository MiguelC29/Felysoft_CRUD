<?php
  require "Conexion.php";
  $pkIdLibro = $_GET['pkIdLibro'];

  $sql = "DELETE FROM libros WHERE pkIdLibro= '".$pkIdLibro."'";
  $result = mysqli_query($conectar, $sql);

  if ($result) {
      echo "<script language='JavaScript'>
              alert('Los datos se eliminaron correctamente de la BD');
              location.assign('../VISTA/principal/libros.php');
            </script>";
  } else {
      echo "<script language='JavaScript'>
              alert('Los datos NO se eliminaron de la BD');
              location.assign('../VISTA/principal/libros.php');
            </script>";
  }
?>