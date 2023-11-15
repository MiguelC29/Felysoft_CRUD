<?php
    $pkIdGasto = $_GET['pkIdGasto'];
    require "Conexion.php";

    $delete = "DELETE FROM gastos WHERE pkIdGasto = '".$pkIdGasto."'";
    $result = mysqli_query($conectar, $delete);

    if ($result) {
        echo "<script language='JavaScript'>
                alert('Los datos se eliminaron correctamente de la BD');
                location.assign('../VISTA/principal/gastos.php');
              </script>";
    } else {
        echo "<script language='JavaScript'>
                alert('Los datos NO se eliminaron de la BD');
                location.assign('../VISTA/principal/gastos.php');
              </script>";
    }

?>