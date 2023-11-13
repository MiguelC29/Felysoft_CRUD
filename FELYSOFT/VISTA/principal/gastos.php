<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FELYSOFT</title>
    <link rel="shortcut icon" href="imagenes/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
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

                    <table style="width: 1650px;" class="table">
                        <a href="insert.php"><button id="agregarGastosBtn" class="btn btn-success py-2 px-3 mb-4 mx-2">Registrar gastos</button></a>
                        <thead class="table-primary">
                            <tr>

                                <th scope="col">Código</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Total</th>
                                <th scope="col">Mètodo de pago</th>

                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            require '../../CONTROLADOR/Conexion.php';

                            $consultar = "SELECT gastos.pkIdGasto, gastos.fecha, gastos.monto, gastos.descripcion,
                                COALESCE(total, 'Ninguno') AS total,
                                COALESCE(metodoPago, 'Ninguno') AS metodoPago
                                FROM gastos 
                                LEFT JOIN compras  ON gastos.fkIdCompra = compras.pkIdCompra
                                LEFT JOIN pago  ON gastos.fkIdPago = pago.pkIdPago";

                            $query = mysqli_query($conectar, $consultar);

                            while ($row = mysqli_fetch_assoc($query)) {

                            
                            ?>

                                <tr>
                                    <th> <?php echo $row['pkIdGasto'] ?> </th>
                                    <th> <?php echo $row['fecha'] ?> </th>
                                    <th> <?php echo $row['monto'] ?></th>
                                    <th> <?php echo $row['descripcion'] ?></th>
                                    <th> <?php echo $row['total'] ?></th>
                                    <th> <?php echo $row['metodoPago'] ?></th>


                                    <th> <a href="" class="btn btn-success">Editar</a></th>
                                    <th> <a href="" class="btn btn-danger">Eliminar</a></th>
                                </tr>

                                <?php } ?>
                        </tbody>
                    </table>




                </div>
    </section>
</body>

</html>