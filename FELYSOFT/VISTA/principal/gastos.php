<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FELYSOFT</title>
    <link rel="shortcut icon" href="imagenes/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="scriptG.js"></script>
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
                    <a class="rounded" href="gastos.php">Estadísticas</a>
                    <a class="rounded" href="#configuración">Configuración</a>
                    <img id="iconBar" class="icon" src="imagenes/icon.png" alt="">
                </div>

                <div class="content" style="width: 1200px;">
                    <header class="py-3 mb-3 border-bottom">
                        <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">


                            <div class="d-flex align-items-center">
                                <form class="w-100 me-3" role="search">
                                    <input id="buscar" type="search" class="form-control" placeholder="Buscar productos..." aria-label="Search">
                                </form>

                                <div class="flex-shrink-0 dropdown">
                                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="imagenes/user.png" alt="mdo" width="55" height="55" class="rounded-circle">
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
                        <button id="agregarGastosBtn" class="btn btn-success py-2 px-3 mb-4 mx-2">Registrar gastos</button>
                        <thead class="table-primary">
                            <tr>

                                <th scope="col">Código</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Mètodo de pago</th>
                                <th scope="col">Acciones</th>
                                

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            require '../../CONTROLADOR/Conexion.php';

                            $consultar = "SELECT gastos.pkIdGasto, gastos.fecha, gastos.monto, gastos.descripcion,
                                COALESCE(metodoPago, 'Ninguno') AS metodoPago
                                FROM gastos 
                                LEFT JOIN pago  ON gastos.fkIdPago = pago.pkIdPago";

                            $query = mysqli_query($conectar, $consultar);

                            while ($row = mysqli_fetch_assoc($query)) {

                            
                            ?>

                                <tr>
                                    <th> <?php echo $row['pkIdGasto'] ?> </th>
                                    <td> <?php echo $row['fecha'] ?> </td>
                                    <td> <?php echo $row['monto'] ?></td>
                                    <td> <?php echo $row['descripcion'] ?></td>
                                    <td> <?php echo $row['metodoPago'] ?></td>


                                    <td> 
                                    <?php echo "<a type= 'button' href='../../CONTROLADOR/updateGastos.php?pkIdGasto=".$row['pkIdGasto']." 'class='btn btn-success me-3'> Editar </a>" ?> 
                                    
                                    <?php echo "<a type= 'button' href='../../CONTROLADOR/deleteGastos.php?pkIdGasto=".$row['pkIdGasto']." 'class='btn btn-danger' onclick = 'return confirmarDelete()'> Eliminar </a>" ?> 
                                    </td>

                                </tr>

                                <?php } ?>
                        </tbody>
                        
                    </table>

                    <div id="formularioAgregarGastos" class="formulario-agregar-productos">
                        <h2>Registrar gasto</h2>
                        <form action="../../CONTROLADOR/insertGastos.php" method="post">

                            <label for="fecha">Fecha</label>
                            <input type="date" id="fecha" name="fecha" class="form-control">

                            <label for="monto">Monto</label>
                            <input type="text" id="monto" name="monto" class="form-control">

                            <label for="descripcion">Descripción</label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control">





                            <?php

                            $sqlConsulta ="SELECT pkIdPago, metodoPago FROM PAGO ORDER BY pkIdPago desc";

                            $query = mysqli_query($conectar, $sqlConsulta);

                            ?>




                            <label for="pago">Pago</label>
                            <select class="form-select" id="pago" name="pago" required>


                                <option selected>Seleccione la método de pago</option>
                                <?php 
                                 while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <option value="<?php echo $row['pkIdPago']?>"><?php echo $row['metodoPago']?></option>
                                <?php }  
                                // Cerrando la conexion con la base de datos
                                mysqli_close($conectar);?>
                            </select>   

                        
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Agregar</button>
                                <button class="btn btn-danger" id="cerrarFormulario">Cerrar</button>
                            </div>
                        </form>    
                    </div>




                </div>
    </section>
</body>

</html>