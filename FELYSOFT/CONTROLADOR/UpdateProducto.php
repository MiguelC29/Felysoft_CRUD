<?php
    require "Conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FELYSOFT-ACTUALIZAR PRODUCTOS</title>
    <link rel="shortcut icon" href="imagenes/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="scriptP.js"></script>
    <script type="text/javascript">
        function confirmarUpdate() {
            return confirm('¿Estas Seguro?, se modificarán los datos');
        }
    </script>
</head>
<body>
    <?php
        if(isset($_POST['updateProduct'])) {
            if (isset($_FILES['imagenProduct']['name'])) {
                //retener la info de la img
                $tipoArchivo = $_FILES['imagenProduct']['type']; //obtener tipo del archivo
                $nombreArchivo = $_FILES['imagenProduct']['name']; //obtener nombre del archivo
                $tamanoArchivo = $_FILES['imagenProduct']['size']; //obtener tamaño del archivo
                $permitido = array("image/png","image/jpg","image/jpeg"); //tipos de datos permitidos
                if (in_array($tipoArchivo, $permitido) == false) {
                    die("<script>alert('Archivo no permitido.'); location.href='../VISTA/principal/productos.php';</script>");
                }
    
                //fopen abrimos un archivo o leemos un archivo
                //tmp_name es el nombre temporal de donde se almacenan temporalmente las img que subimos
                // 'r' -> modo de fopen, modo de abrir el archivo modo r(read) de lectura
                $imagenSubida = fopen($_FILES['imagenProduct']['tmp_name'], 'r');
                //Extraer los binarios de la img
                $binariosImagen = fread($imagenSubida, $tamanoArchivo);
                $binariosImagen = mysqli_escape_string($conectar, $binariosImagen);
                //Aqui se entra cuando se presiona el btn de actualizar
                $pkIdProducto = $_POST['pkIdProducto'];
                $nombProducto = $_POST['nomP'];
                $marca = $_POST['marca'];
                $precioV = $_POST['precioV'];
                $fVencimiento = $_POST['fVencimiento'];
                $categoria = $_POST['categoria'];
                $proveedor = $_POST['proveedor'];

                $sql = "UPDATE productos SET nombre='".$nombProducto."',marca='".$marca."',precioVenta='".$precioV."',fechaVencimiento='".$fVencimiento."',fkIdCategoria='".$categoria."',fkIdProveedor='".$proveedor."',imagen='".$binariosImagen."',tipoImg='".$tipoArchivo."' WHERE pkIdProducto='".$pkIdProducto."'";

                $result = mysqli_query($conectar, $sql);

                if ($result) {
                    echo "<script language='JavaScript'>
                            alert('Los datos se actualizaron correctamente');
                            location.assign('../VISTA/principal/productos.php');
                        </script>";
                } else {
                    echo "<script language='JavaScript'>
                            alert('Los datos NO se actualizaron');
                            location.assign('../VISTA/principal/productos.php');
                        </script>";
                }      
            }  
        } else {
            //Aqui se entra si no se ha presionado el btn de actualizar
            $pkIdProducto = $_GET['pkIdProducto'];
            $sql = "SELECT pkIdProducto, imagen, tipoImg, productos.nombre as producto, marca, precioVenta, fechaVencimiento, categoria.nombre as categoria, proveedores.nombre as proveedor FROM productos INNER JOIN categoria ON fkIdCategoria = pkIdCategoria INNER JOIN proveedores ON fkIdProveedor = pkIdProveedores WHERE pkIdProducto = '".$pkIdProducto."'";
            $result = mysqli_query($conectar, $sql);

            $fila = mysqli_fetch_assoc($result);
            $imagen = $fila['imagen'];
            $nombProducto = $fila['producto'];
            $marca = $fila['marca'];
            $precioV = $fila['precioVenta'];
            $fVencimiento = $fila['fechaVencimiento'];
            $categoria = $fila['categoria'];
            $proveedor = $fila['proveedor'];

            // mysqli_close($conectar);
    ?>

    <div id="formUpdateProduct" class="formulario-agregar-productos">
        <h2 class="text-center py-3">Editar Producto</h2>

        <!-- ectype: tipo de encriptacion por lo que manejamos img -->
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <table style="width: 830px;">
                <tbody>
                    <tr>
                        <input type="hidden" id="pkIdProducto" name="pkIdProducto" value="<?php echo $pkIdProducto ?>">
                        <th><label for="nomP">Nombre del Producto</label></th>
                        <td><input type="text" id="nomP" name="nomP" class="form-control" value="<?php echo $nombProducto?>" required></td>
                        <th class="ps-4"><label for="marca">Marca</label></th>
                        <td><input type="text" id="marca" name="marca" class="form-control" value="<?php echo $marca?>" required></td>
                    </tr>
                    <tr>
                        <th><label for="precioV">Precio Venta</label></th>
                        <td><input type="text" id="precioV" name="precioV" class="form-control" value="<?php echo $precioV?>" required></td>
                        <th class="ps-4"><label for="fVencimiento">Fecha de Vencimiento</label></th>
                        <td><input type="date" id="fVencimiento" name="fVencimiento" class="form-control" value="<?php echo $fVencimiento?>"></td>
                    </tr>

                    <tr>
                        <?php
                            //Variable contenedora de la consulta a realizar
                            $sqlC = "SELECT pkIdCategoria, nombre FROM categoria ORDER BY nombre";

                            $result = mysqli_query($conectar, $sqlC);
                        ?>

                        <th><label for="categoria">Categoría</label></th>
                        <td><select class="form-select" id="categoria" name="categoria" required>
                            <option selected><?php echo $categoria?></option>
                            <?php while($filas = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $filas['pkIdCategoria']?>"><?php echo $filas['nombre']?></option>
                            <?php
                                }
                            ?>
                        </select></td> 
                        <?php
                            //Variable contenedora de la consulta a realizar
                            $sqlProv = "SELECT pkIdProveedores, nombre FROM proveedores ORDER BY nombre";

                            $result = mysqli_query($conectar, $sqlProv);
                        ?>                               
                        <th class="ps-4"><label for="proveedor">Proveedor</label></th>
                        <td><select class="form-select" id="proveedor" name="proveedor" required>
                            <option selected><?php echo $proveedor?></option>
                            <?php while($filas = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $filas['pkIdProveedores']?>"><?php echo $filas['nombre']?></option>
                            <?php
                                }
                            ?>
                        </select></td>
                    </tr>
                    <tr>
                        <div class="mb-3">
                            <th><label for="imagenProduct" class="form-label">Imagen</label></th>
                            <td colspan="4"><input class="form-control" type="file" id="imagenProduct" name="imagenProduct"></td>
                        </div>
                    </tr>
                </tbody>
            </table>

            <?php
                // Cerrando la conexion con la base de datos
                mysqli_close($conectar);
            ?>
                    
            <div class="text-center py-3">
                <button name="updateProduct" id="updateProduct" type="submit" class="btn btn-success me-3" onclick='return confirmarUpdate()'>Actualizar</button>
                <!-- <button id="closeForm" class="btn btn-danger">Cerrar</button> -->
                <a href="../VISTA/principal/productos.php" class="btn btn-danger">Cerrar</a>
            </div>
        </form>
    </div>
    <?php
        }
    ?>
</body>
</html>