<?php
    require "Conexion.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FELYSOFT-ACTUALIZAR GASTOS</title>
    <link rel="shortcut icon" href="imagenes/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="scriptG.js"></script>
    <script type="text/javascript">
        function confirmarUpdate() {
            return confirm('¿Estas Seguro?, se modificarán los datos');
        }
    </script>
</head>

<body>
    <?php
        if (isset($_POST["updateGasto"])) {   //AQUI SE ENTRA CUANDO SE PRECIONA EL BOTÓN ACTUALIZAR
    
            $pkIdGasto = $_POST["pkIdGasto"];
            $fecha = $_POST["fecha"];
            $monto = $_POST["monto"];
            $descripcion = $_POST["descripcion"];
            $pago = $_POST["pago"];

            $update = "UPDATE gastos SET fecha = '$fecha', monto = '$monto', descripcion = '$descripcion', fkIdPago = '$pago' 
            WHERE pkIdGasto ='$pkIdGasto' ";

            $result = mysqli_query($conectar, $update);

            if ($result) {
                echo "<script language='JavaScript'>
                        alert('Los datos se actualizaron correctamente');
                        location.assign('../VISTA/principal/Gastos.php');
                    </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('Los datos NO se actualizaron');
                        location.assign('../VISTA/principal/Gastos.php');
                    </script>";
            }
        } else { //AQUI SE ENTRA CUANDO NO SE HA PRECIONADO EL BOTON ACTUIALIZAR
            $pkIdGasto = $_GET["pkIdGasto"];

            $consultar = "SELECT pkIdGasto, fecha, monto, descripcion,
            COALESCE(metodoPago, 'Ninguno') AS metodoPago
            FROM gastos 
            LEFT JOIN pago  ON gastos.fkIdPago = pago.pkIdPago WHERE pkIdGasto = $pkIdGasto ";

            $query = mysqli_query($conectar, $consultar);

            $fila = mysqli_fetch_assoc($query);

            $fecha = $fila["fecha"];
            $monto = $fila["monto"];
            $descripcion = $fila["descripcion"];
            $pago = $fila["metodoPago"];
            
        }
    ?>
    <div id="formUpdateGasto" class="formulario-agregar-productos">
        <h2 class="text-center py-3">Editar Gasto</h2>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <table style="width: 830px;">
                <tbody>
                    <tr>
                        <input type="hidden" id="pkIdGasto" name="pkIdGasto" value="<?php echo $pkIdGasto ?>">
                        <th><label for="fecha">Fecha</label></th>
                        <td><input type="text" id="fecha" name="fecha" class="form-control" value="<?php echo $fecha?>" required></td>       
                    </tr>
                    
                    <tr>
                        <th class=""><label for="monto">Monto</label></th>
                        <td><input type="text" id="monto" name="monto" class="form-control" value="<?php echo $monto?>" required></td></tr>
                    <tr>

                    <tr>
                        <th><label for="descripcion">Descripción</label></th>
                        <td><input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo $descripcion?>" required></td>
                    </tr>
                        
                    <tr>
                    <?php
                        $sqlConsulta ="SELECT pkIdPago, metodoPago FROM PAGO ORDER BY pkIdPago desc";
                        $query = mysqli_query($conectar, $sqlConsulta);
                    ?>

                        <th><label for="pago">Pago</label></th>
                        <td>
                            <select class="form-select" id="pago" name="pago" required>
                            <option selected><?php echo $pago?></option>
                            <?php while($filas = mysqli_fetch_assoc($query)) { ?>
                            <option value="<?php echo $filas['pkIdPago']?>"><?php echo $filas['metodoPago']?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </td>
                    </tr>
                    
                </tbody>
            </table>

            <?php
                // Cerrando la conexion con la base de datos
                mysqli_close($conectar);
            ?>
                    
            <div class="text-center py-3">
                <button name="updateGasto" id="updateGasto" type="submit" class="btn btn-success me-3" onclick='return confirmarUpdate()'>Actualizar</button>
                <a href="../VISTA/principal/Gastos.php" class="btn btn-danger">Cerrar</a>
            </div>
        </form>
    </div>

</body>
<html>