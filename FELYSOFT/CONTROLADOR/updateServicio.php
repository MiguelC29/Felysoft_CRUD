<?php
    include("Conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FELYSOFT</title>
    <link rel="shortcut icon" href="imagenes/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/Felysoft/FELYSOFT/VISTA/principal/style.css">
    <script src="scriptS.js"></script>
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
                            <li><a id="sideList" class="dropdown-item" href="/felysoft/FELYSOFT/VISTA/principal/servicios.php">Servicios</a></li>
                        </ul>
                    </div>
                    <a class="rounded" href="../VISTA/principal/404.html">Estadísticas</a>
                    <a class="rounded" href="#configuración">Configuración</a>
                    <img id="iconBar" class="icon" src="/felysoft/FELYSOFT/VISTA/principal/imagenes/icon.png" alt="">
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
                                        <img src="/felysoft/FELYSOFT/VISTA/principal/imagenes/user.png" alt="mdo" width="55" height="55" class="rounded-circle">
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

                    <?php
                        if(isset($_POST['enviar'])){
                                //aqui entra cuando se presiona el boton de enviar (actualizar)
                                
                                $nombre = $_POST["nombre"];
                                $descripcion = $_POST["descripcion"];
                                $precio = $_POST["precio"];
                                $id = $_POST["id"];

                                //actualizar el registro
                                $sql = "UPDATE `tiposervicio` SET `nombre` = '$nombre', `descripcion` = '$descripcion', `precio` = '$precio' WHERE `tiposervicio`.`idTipoServicio` = '" . $id . "'";
                                $resultado=mysqli_query($conectar,$sql);

                                if($resultado){
                                    echo "<script> alert('Los datos se actualizaron correctamente.'); location.href='../VISTA/principal/servicios.php'; </script>";
                                }else{
                                    echo "<script> alert('Los datos NO se actulizaron correctamente.'); location.href='../VISTA/principal/servicios.php'; </script>";
                                }

                                mysqli_close($conectar);

                        }else{
                                //aqui entra si no se ha presionado el boton enviar (actualizar)
                                $id=$_GET['id'];
                                $sql="SELECT * FROM tiposervicio WHERE idTipoServicio='".$id."'";
                                $resultado=mysqli_query($conectar, $sql);

                                $fila=mysqli_fetch_assoc($resultado);
                                $nombre = $fila["nombre"];
                                $descripcion = $fila["descripcion"];
                                $precio = $fila["precio"];

                                mysqli_close($conectar);
                    ?>

                    <h2 class="text-center">Actualizar Servicio</h2>
                    <form class="was-validated" id="formServicio" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Servicio</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingresa el nombre del servicio a actualizar.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingresa la descripción del servicio a actualizar.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio (COP)</label>
                            <input type="text" name="precio" class="form-control" value="<?php echo $precio; ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingresa el precio del servicio a actualizar.
                            </div>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="text-center">
                            <button type="submit" name="enviar" class="btn btn-success">Actualizar</button>                          
                        </div>
                    </form>   
                    
                    <a href="/felysoft/FELYSOFT/VISTA/principal/servicios.php"><button id="cerrarFormularioUpdate" class="btn btn-danger">Cerrar</button></a>
                    
                        <?php
                            }
                        ?>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</body>
</html>

