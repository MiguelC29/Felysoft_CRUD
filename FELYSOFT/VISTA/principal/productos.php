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
                                <form class="w-100 me-3" role="search">
                                    <input id="buscar" type="search" class="form-control"
                                        placeholder="Buscar productos..." aria-label="Search">
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

                    <!-- Conexion y consulta con la BD y la tabla productos -->
                    <?php
                        // Accediendo al archivo conexion.php
                        include "../../CONTROLADOR/Conexion.php";

                        //Variable contenedora de la consulta a realizar
                        $sql = "SELECT * FROM productos";
                        $result = mysqli_query($conectar, $sql);
                    ?>

                    <table style="width: 1650px;" class="table  text-center">
                        <button id="agregarProductosBtn" class="btn btn-success py-2 px-3 mb-4 mx-2">Agregar Productos</button>
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
                                while($filas = mysqli_fetch_assoc($result)) {     
                            ?>
                            <tr>
                                <th scope="row"><?php echo $filas['pkIdProducto'];?></th>
                                <td><?php echo $filas['imagen']?></td>
                                <td><?php echo $filas['nombre']?></td>
                                <td><?php echo $filas['marca']?></td>
                                <td><?php echo $filas['precioVenta']?></td>
                                <td><?php echo $filas['fechaVencimiento']?></td>
                                <td><?php echo $filas['fkIdCategoria']?></td>
                                <td><?php echo $filas['fkIdProveedor']?></td>
                                <td>
                                    <?php echo "<button type='button' class='btn btn-primary me-3'>+</button>"?>
                                    <?php echo "<button type='button' class='btn btn-success me-3'>Editar</button>"?>
                                    <?php echo "<button type='button' class='btn btn-danger'>Eliminar</button>"?>
                                </td>
                            </tr>

                            <?php
                                }
                            ?>
                        </tbody>
                    </table>

                    <?php
                        // Cerrando la conexion con la base de datos
                        mysqli_close($conectar);
                    ?>

                    <div id="formularioAgregarProductos" class="formulario-agregar-productos">
                        <h2>Agregar Producto</h2>
                        <form>

                            <label for="nombre">Nombre del Producto</label>
                            <input type="text" id="nombre" class="form-control" required>

                            <label for="precio">Precio Compra</label>
                            <input type="text" id="precio" class="form-control" required>

                            <label for="precio">Precio Venta</label>
                            <input type="text" id="precio" class="form-control" required>

                            <label for="stock">Stock</label>
                            <input type="text" id="stock" class="form-control" required>

                            <button id="abrirFormulario" type="submit" class="btn btn-success">Agregar</button>
                            <!-- <button id="addNewProduct" class="btn btn-primary">+</button> -->
                            <button id="cerrarFormulario" class="btn btn-danger">Cerrar</button>
                        </form>
                    </div>

                    <div id="formAddProduct" class="formulario-agregar-productos">
                        <h2 class="text-center py-3">Agregar Nuevo Producto</h2>
                        <form action="../../CONTROLADOR/InsertProducto.php" method="post">

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
                                        <th><label for="categoria">Categoría</label></th>
                                        <td><select class="form-select" id="categoria" name="categoria" required>
                                            <option selected>Seleccione la categoría</option>
                                            <option value="1">Gaseosas</option>
                                            <option value="2">Galletas</option>
                                            <option value="3">Lacteos</option>
                                            <option value="4">Dulces</option>
                                            <option value="5">Paquetes</option>
                                        </select></td>                                        
                                        <th class="ps-4"><label for="proveedor">Proveedor</label></th>
                                        <td><select class="form-select" id="proveedor" name="proveedor" required>
                                            <option selected>Seleccione el proveedor</option>
                                            <option value="101">Papas Ricas</option>
                                            <option value="102">Galletas Sabrosas S.A.</option>
                                            <option value="103">Refrescos Frescos</option>
                                            <option value="104">Bimbo Distribuciones E.I.R.L.</option>
                                            <option value="105">Hershey's Distribuciones S.A.</option>
                                        </select></td>
                                    </tr>
                                    <tr>
                                        <div class="mb-3">
                                            <th><label for="formFile" class="form-label">Imagen</label></th>
                                            <td colspan="4"><input class="form-control" type="file" id="formFile" name="formFile"></th>
                                        </div>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center py-3">
                                <button id="saveProduct" type="submit" class="btn btn-success me-3">Agregar</button>
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