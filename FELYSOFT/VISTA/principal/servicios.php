<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FELYSOFT</title>
    <link rel="shortcut icon" href="imagenes/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="scriptS.js"></script>
    <script type="text/javascript">
        function confirmar(){
            return confirm('¿Estas Seguro?, se eliminarán los datos');
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
                    <a class="rounded" href="../VISTA/principal/404.html">Estadísticas</a>
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
                                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="imagenes/user.png" alt="mdo" width="55" height="55" class="rounded-circle">
                                    </a>
                                    <ul class="dropdown-menu text-small shadow">
                                        <li><a class="dropdown-item" href="#">Ajustes</a></li>
                                        <li><a class="dropdown-item" href="../VISTA/principal/500.html">Perfil</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="../VISTA/login/index.html">Salir</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </header>
                    <table style="width: 1650px;" class="table text-center">
                        <button id="mostrarFormulario" class="btn btn-success py-2 px-3 mb-4 mx-2">Crear Servicio</button>
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Servicio</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio (COP)</th>
                                <th scope="col">Acciones</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $host = "localhost";
                            $user = "root";
                            $clave = "";
                            $bd = "db_felysoft";

                            $conectar = mysqli_connect($host, $user, $clave, $bd);
                        
                            $select = "SELECT * FROM tiposervicio";
                            $resultado = mysqli_query($conectar, $select);
                        
                            if(!$resultado){
                                die("Error en la obtención de datos: " . mysqli_error($conectar));
                            }
                        
                            while ($columna = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<td>" . $columna['idTipoServicio'] . "</td>";
                                echo "<td>" . $columna['nombre'] . "</td>";
                                echo "<td>" . $columna['descripcion'] . "</td>";
                                echo "<td>" . $columna['precio'] . "</td>";
                                echo "<td><a href='/Felysoft/FELYSOFT/CONTROLADOR/updateServicio.php?id=" . $columna['idTipoServicio'] . "'><button type='button' class='btn btn-success'>Editar</button></a>    
                                <a href='/Felysoft/FELYSOFT/CONTROLADOR/deleteServicios.php?id=" . $columna['idTipoServicio'] . "'><button type='button' class='btn btn-danger' onclick='return confirmar()'>Eliminar</button></a>
                                </td>";
                                echo "<td></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <div id="formularioAgregarServicios" class="formulario-agregar-servicios" style="display: none; width: 600px;">
                        <h2 class="text-center">Agregar Servicio</h2>
                        <form class="was-validated" id="formServicio" action="../../CONTROLADOR/insertServicio.php" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" id="floatingInput" name="nombre" class="form-control" placeholder="nombre" required>
                                <label for="floatingInput">Nombre Servicio</label>
                                    <div class="invalid-feedback text-light pb-2 ms-3">
                                        Por favor ingresa el nombre del nuevo servicio.
                                    </div>
                            </div>             

                            <div class="form-floating">
                                <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="descripcion" required>
                                <label for="descripcion">Descripción</label>
                                    <div class="invalid-feedback text-light pb-2 ms-3">
                                        Por favor ingresa la descripción del nuevo servicio.
                                    </div>
                            </div>
                            
                            <div class="form-floating">
                                <input type="text" id="precio" name="precio" class="form-control" placeholder="precio" required>
                                <label for="precio">Precio (COP)</label>
                                    <div class="invalid-feedback text-light pb-2 ms-3">
                                        Por favor ingresa el precio del nuevo servicio.
                                    </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" id="registrarFormulario" class="btn btn-success">Agregar</button>
                                <button id="cerrarFormulario" class="btn btn-danger">Cerrar</button>
                            </div>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</body>
</html>

