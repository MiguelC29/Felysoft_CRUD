<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FELYSOFT-PRODUCTOS</title>
    <link rel="shortcut icon" href="imagenes/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="scriptP.js"></script>
    <script type="text/javascript">
        function confirmarDelete() {
            return confirm('¿Estas Seguro?, se eliminarán los datos');
        }

        function confirmarInsert() {
            return confirm('¿Estas Seguro?, se guardarán los datos ingresados');
        }
    </script>
</head>

<body>

    <section class="container-fluid">
        <div class="row">
          <div class="col-md-9">
            <div class="sidebar">
                <a class="rounded" href="/prototipoFelysoft/principal/index.html">Venta</a>
                <div class="dropdown">
                    <a class="rounded dropdown-toggle" href="#" role="button" id="dashboardDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Dashboard
                    </a>
                    <ul id="dropdownSide" class="dropdown-menu" aria-labelledby="dashboardDropdown">
                        <li><a id="sideList" class="dropdown-item" href="productos.html">Productos</a></li>
                        <li><a id="sideList" class="dropdown-item" href="libros.html">Libros</a></li>
                        <li><a id="sideList" class="dropdown-item" href="servicios.html">Servicios</a></li>
                    </ul>
                </div>
                <a class="rounded" href="/principal/404.html">Estadísticas</a>
                <a class="rounded" href="#configuración">Configuración</a>
                <img id="iconBar" class="icon" src="imagenes/icon.png" alt="">
            </div>

                <div class="content" style="width: 1200px;">
                    <header class="py-3 mb-3 border-bottom">
                        <div class="container-fluid d-grid gap-3 align-items-center"
                            style="grid-template-columns: 1fr 2fr;">
                

                            <div class="d-flex align-items-center">
                                <form action="<?=$_SERVER['PHP_SELF']?>" class="w-100 me-3" role="search" method="post">
                                    <input id="buscar" name="buscar" type="search" class="form-control" placeholder="Buscar productos..." aria-label="Search">
                                    <!-- <label for="txtBuscar">Nombre Producto</label>
                                    <input type="text" name="txtBuscar" id="txtBuscar">
                                    <input type="submit" name="btnBuscar" value="Buscar"> -->
                                </form>

                                <div class="flex-shrink-0 dropdown">
                                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="imagenes/user.png" alt="mdo" width="55" height="55"
                                            class="rounded-circle">
                                    </a>
                                    <ul class="dropdown-menu text-small shadow">
                                        <li><a class="dropdown-item" href="#">Ajustes</a></li>
                                        <li><a class="dropdown-item" href="/principal/500.html">Perfil</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="/login/index.html">Salir</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </header>

                    <table style="width: 1650px;" class="table text-center">
                        <button id="agregarProductosBtn" class="btn btn-success py-2 px-3 mb-4 mx-2">Agregar Productos</button>
                        <a href="productos.php" type="button" class="btn btn-primary py-2 px-3 mb-4 mx-2">Mostrar todos los productos</a>
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Precio Venta</th>
                                <th scope="col">Fecha Vencimiento</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Accediendo al archivo conexion.php
                                include "../../CONTROLADOR/Conexion.php";

                                $registrosXPagina = 10;
                                $pagActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
                                $offset = ($pagActual - 1) * $registrosXPagina;

                                if (isset($_POST['buscar'])) {
                                    //MOSTRAR BÚSQUEDA
                                    $inputBuscar = $_POST['buscar'];

                                    if (empty($inputBuscar)) {
                                        echo "<script language='JavaScript'>
                                                alert('Ingrese el nombre del producto a buscar');
                                                location.assign('productos.php');
                                              </script>";
                                    } else {
                                        $sql = "SELECT pkIdProducto, imagen, tipoImg, productos.nombre as producto, marca, precioVenta, fechaVencimiento, categoria.nombre as categoria, proveedores.nombre as proveedor FROM productos INNER JOIN categoria ON fkIdCategoria = pkIdCategoria INNER JOIN proveedores ON fkIdProveedor = pkIdProveedores WHERE productos.nombre like '%".$inputBuscar."%'";
                                    }
                                    
                                    $result = mysqli_query($conectar, $sql);

                                    while($filas = mysqli_fetch_assoc($result)) { 
                            ?>
                            <tr>
                                <th scope="row"><?php echo $filas['pkIdProducto'];?></th>
                                <td><img width = "100px" height = "100px" src="data:<?php echo $filas['tipoImg']?>;base64,<?php echo base64_encode($filas['imagen'])?>"></td>
                                <td><?php echo $filas['producto']?></td>
                                <td><?php echo $filas['marca']?></td>
                                <td><?php echo $filas['precioVenta']?></td>
                                <td><?php echo $filas['fechaVencimiento']?></td>
                                <td><?php echo $filas['categoria']?></td>
                                <td><?php echo $filas['proveedor']?></td>
                                <td>
                                    <?php echo "<a type='button' href='' class='btn btn-primary me-3'>+</a>"?>
                                    <?php echo "<a type='button' id='updateProductbtn' href='../../CONTROLADOR/UpdateProducto.php?pkIdProducto=".$filas['pkIdProducto']."' class='btn btn-success me-3'>Editar</a>"?>
                                    <?php echo "<a type='button' href='../../CONTROLADOR/DeleteProducto.php?pkIdProducto=".$filas['pkIdProducto']."' class='btn btn-danger' onclick='return confirmarDelete()'>Eliminar</a>"?>
                                </td>
                            </tr>
                            <?php
                                    }
                                } else {
                                    //MOSTRAR TODOS LOS PRODUCTOS
                                    // Conexion y consulta con la BD y la tabla productos
                                    //Variable contenedora de la consulta a realizar
                                    $select = "SELECT pkIdProducto, imagen, tipoImg, productos.nombre as producto, marca, precioVenta, fechaVencimiento, categoria.nombre as categoria, proveedores.nombre as proveedor FROM productos INNER JOIN categoria ON fkIdCategoria = pkIdCategoria INNER JOIN proveedores ON fkIdProveedor = pkIdProveedores ORDER BY pkIdProducto LIMIT $offset, $registrosXPagina";

                                    $result = mysqli_query($conectar, $select);

                                    if(!$result) {
                                        die("Error en la obtención de datos: " . mysqli_error($conectar));
                                    }

                                    while($filas = mysqli_fetch_assoc($result)) { 
                            ?>
                            <tr>
                                <th scope="row"><?php echo $filas['pkIdProducto'];?></th>
                                <td><img width = "80px" height = "80px" src="data:<?php echo $filas['tipoImg']?>;base64,<?php echo base64_encode($filas['imagen'])?>"></td>
                                <td><?php echo $filas['producto']?></td>
                                <td><?php echo $filas['marca']?></td>
                                <td><?php echo $filas['precioVenta']?></td>
                                <td><?php echo $filas['fechaVencimiento']?></td>
                                <td><?php echo $filas['categoria']?></td>
                                <td><?php echo $filas['proveedor']?></td>
                                <td>
                                    <?php echo "<a type='button' href='' class='btn btn-primary me-3'>+</a>"?>
                                    <?php echo "<a type='button' href='../../CONTROLADOR/UpdateProducto.php?pkIdProducto=".$filas['pkIdProducto']."' class='btn btn-success me-3'>Editar</a>"?>
                                    <?php echo "<a type='button' href='../../CONTROLADOR/DeleteProducto.php?pkIdProducto=".$filas['pkIdProducto']."' class='btn btn-danger' onclick='return confirmarDelete()'>Eliminar</a>"?>
                                </td>
                            </tr>

                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>

                    <nav aria-label="...">
                      <ul class="pagination pagination-lg">
                        <?php
                            $totalRegistros = mysqli_num_rows(mysqli_query($conectar, "SELECT * FROM productos"));
                            $totalPaginas = ceil($totalRegistros / $registrosXPagina);

                            for($i = 1; $i <= $totalPaginas; $i++) {
                                echo "<li class='page-item " . ($pagActual == $i ? 'active' : '') . "' aria-current='page'>";
                                echo "<a class='page-link' href='productos.php?pagina=$i'>$i</a>";
                                echo "</li>";
                            }
                        ?>
                      </ul>
                    </nav>

                    <div id="formAddProduct" class="formulario-agregar-productos">
                        <h2 class="text-center py-3">Agregar Nuevo Producto</h2>

                        <!-- ectype: tipo de encriptacion por lo que manejamos img -->
                        <form action="../../CONTROLADOR/InsertProducto.php" method="post" enctype="multipart/form-data">
                            <table style="width: 830px;">
                                <tbody>
                                    <tr>
                                        <th><label for="nomP">Nombre del Producto</label></th>
                                        <td><input type="text" id="nomP" name="nomP" class="form-control" required></td>
                                        <th class="ps-4"><label for="marca">Marca</label></th>
                                        <td><input type="text" id="marca" name="marca" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <th><label for="precioV">Precio Venta</label></th>
                                        <td><input type="text" id="precioV" name="precioV" class="form-control" required></td>
                                        <th class="ps-4"><label for="fVencimiento">Fecha de Vencimiento</label></th>
                                        <td><input type="date" id="fVencimiento" name="fVencimiento" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <?php
                                            //Variable contenedora de la consulta a realizar
                                            $sqlC = "SELECT pkIdCategoria, nombre FROM categoria ORDER BY nombre";

                                            $result = mysqli_query($conectar, $sqlC);
                                        ?>

                                        <th><label for="categoria">Categoría</label></th>
                                        <td><select class="form-select" id="categoria" name="categoria" required>
                                            <option selected>Seleccione la categoría</option>
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
                                            <option selected>Seleccione el proveedor</option>
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
                                <button name="saveProduct" id="saveProduct" type="submit" class="btn btn-success me-3" onclick='return confirmarInsert()'>Agregar</button>
                                <button id="closeForm" class="btn btn-danger">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</body>
</html>