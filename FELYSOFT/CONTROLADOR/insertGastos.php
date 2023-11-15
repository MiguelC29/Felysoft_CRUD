<?php
    require 'Conexion.php';

    //Recuperar las variables
    $fecha = $_POST["fecha"];
    $monto = $_POST["monto"];
    $descripcion = $_POST["descripcion"];
    $pago = $_POST["pago"];

    
    $insert = "INSERT INTO gastos(fecha, monto, descripcion, fkIdPago) VALUES ('$fecha', '$monto', '$descripcion', '$pago')";

    //ejercutacion la sentencia de la linea 10
    $query = mysqli_query($conectar, $insert);

    //Verificar la conexión
    if($query) {
        echo "<script> alert('El gasto se agregó correctamente.'); location.href='../VISTA/principal/gastos.php'; </script>'";
    }
?>