<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FELYSOFT</title>
    <link rel="shortcut icon" href="imagenes/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="scriptL.js"></script>
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
                            <li><a id="sideList" class="dropdown-item" href="libros.php">Libros</a></li>
                            <li><a id="sideList" class="dropdown-item" href="servicios.html">Servicios</a></li>
                        </ul>
                    </div>
                    <a class="rounded" href="/principal/404.html">Estadísticas</a>
                    <a class="rounded" href="#configuración">Configuración</a>
                    <img id="iconBar" class="icon" src="imagenes/icon.png" alt="">
                </div>
                <div class="content" style="width: 1200px;">
                    <header class="py-3 mb-3 border-bottom">
                        <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
                            <div class="d-flex align-items-center">
                                <form class="w-100 me-3" action="<?=$_SERVER['PHP_SELF']?>" role="search" method="post">
                                    <input id="buscar" name="buscar" type="search" class="form-control" placeholder="Buscar libros..." aria-label="Search">
                                </form>
                                <div class="flex-shrink-0 dropdown">
                                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
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
                        <button id="mostrarFormularioLibros" class="btn btn-success py-2 px-3 mb-4 mx-2">Agregar Libro</button>
                        <a href="libros.php" type="button" class="btn btn-primary py-2 px-3 mb-4 mx-2">Mostrar todos los libros</a>
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Codigo Libro</th>
                                <th scope="col">Título</th>
                                <th scope="col">Editorial</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Año de Publicación</th>
                                <th scope="col">Precio (COP)</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Género</th>
                                <th scope="col">Acciones</th>
                                
                            </tr>
                        </thead>
                        <button id="mostrarFormuAutorbtn" class="btn btn-success py-2 px-3 mb-4 mx-2">Agregar Autor</button>
                        <tbody>
                            <?php 
                             include '../../CONTROLADOR/Conexion.php';
                             if (isset($_POST['buscar'])){
                                //Mostrar Busqueda 
                                $inputBuscar= $_POST['buscar'];
                                if (empty($inputBuscar)){
                                    echo "<script language='JavaScript'>
                                                alert('Ingrese el nombre del libro a buscar');
                                                location.assign('libros.php');
                                              </script>";
                                }else{
                                    $sql = "SELECT pkIdLibro, titulo, editorial, libros.descripcion as Descripcion, anioPublicacion, precioHora, autores.nombre as Autor, genero.nombre as Genero FROM libros INNER JOIN autores ON fkIdAutor = pkIdAutor INNER JOIN genero ON fkIdGenero = pkIdGenero WHERE titulo like '%".$inputBuscar."%'";
                                }
                                $query= mysqli_query($conectar,$sql);
                                while ($row = mysqli_fetch_assoc($query)){                    
                            ?>
                           <tr>
                                <th scope="row"><?php echo $row['pkIdLibro'];?></th>
                                <td><?php echo $row['titulo']?></td>
                                <td><?php echo $row['editorial']?></td>
                                <td><?php echo $row['Descripcion']?></td>
                                <td><?php echo $row['anioPublicacion']?></td>
                                <td><?php echo $row['precioHora']?></td>
                                <td><?php echo $row['Autor']?></td>
                                <td><?php echo $row['Genero']?></td>
                                <td>                                    
                                    <?php echo "<a type='button' id='updateLibrobtn' href='../../CONTROLADOR/updateLibro.php?pkIdLibro=".$row['pkIdLibro']."' class='btn btn-success me-3'>Editar</a>"?>
                                    <?php echo "<a type='button' href='../../CONTROLADOR/deleteLibro.php?pkIdLibro=".$row['pkIdLibro']."' class='btn btn-danger' onclick='return confirmarDelete()'>Eliminar</a>"?>
                                </td>
                            </tr>
                            <?php
                                }
                            }else{ 
                                   $select = "SELECT pkIdLibro, titulo, editorial, libros.descripcion as Descripcion, anioPublicacion, precioHora, autores.nombre as Autor, genero.nombre as Genero FROM libros INNER JOIN autores ON fkIdAutor = pkIdAutor INNER JOIN genero ON fkIdGenero = pkIdGenero ORDER BY pkIdLibro";

                                $result = mysqli_query($conectar, $select);

                                if(!$result) {
                                    die("Error en la obtención de datos: " . mysqli_error($conectar));
                                }

                                while($filas = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $filas['pkIdLibro'];?></th>
                                <td><?php echo $filas['titulo']?></td>
                                <td><?php echo $filas['editorial']?></td>
                                <td><?php echo $filas['Descripcion']?></td>
                                <td><?php echo $filas['anioPublicacion']?></td>
                                <td><?php echo $filas['precioHora']?></td>
                                <td><?php echo $filas['Autor']?></td>
                                <td><?php echo $filas['Genero']?></td>
                                <td>
                                    <?php echo "<a type='button' href='../../CONTROLADOR/updateLibro.php?pkIdLibro=".$filas['pkIdLibro']."' class='btn btn-success me-3'>Editar</a>"?>
                                    <?php echo "<a type='button' href='../../CONTROLADOR/deleteLibro.php?pkIdLibro=".$filas['pkIdLibro']."' class='btn btn-danger' onclick='return confirmarDelete()'>Eliminar</a>"?>
                                </td>
                            </tr>

                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>

                    <div id="formularioAgregarLibros" class="formulario-agregar-productos" >
                        <h2 class="text-center py-3">Agregar Libro</h2>
                        <form action="../../CONTROLADOR/insertLibro.php" method="post">
                            <table style="width:830px;">
                            <tbody>
                                <tr>
                                    <th><label for="titulo">Título</label></th>
                                    <td><input type="text" id="titulo" name="titulo" class="form-control" require></td>
                                    <th class="ps-4"><label for="editorial">Editorial</label></th>
                                    <td><input type="text" id="editorial" name="editorial" class="form-control" require></td>
                                 </tr>
                                <tr>
                                    <th><label for="precio">Precio (COP)</label></th>
                                    <td><input type="text" id="precio" name="precio" class="form-control"></td>
                                                                      
                                    <th class="ps-4"><label for="anioPublicacion">Año Publicación</label></th>
                                    <td><input type="text" id="anioPublicacion" name="anioPublicacion"  class="form-control"></td>
                                 </tr>    
                                 <tr>
                                    <th><label for="Descripcion">Descripcion</label></th>
                                    <td colspan="3"><textarea cols="30" type="text" id="Descripcion" name="Descripcion" class="form-control" required style="resize: none;"></textarea></td>
                                </tr>  
                                <tr>
                                <?php
                                        //Variable contenedora de la consulta a realizar
                                        $sqlA = "SELECT pkIdAutor, nombre FROM autores ORDER BY nombre";

                                        $result = mysqli_query($conectar, $sqlA);
                                    ?>

                                    <th><label for="autor">Autor</label></th>
                                    <td><select  id="autor" name="autor"  class="form-select" required>
                                        <option selected>Seleccione el Autor</option>
                                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $row['pkIdAutor']?>"><?php echo $row['nombre']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select></td>

                                    <?php
                                        //Variable contenedora de la consulta a realizar
                                        $sqlG = "SELECT pkIdGenero, nombre FROM genero ORDER BY nombre";

                                        $result = mysqli_query($conectar, $sqlG);
                                    ?>

                                        <th class="ps-4"><label for="genero">Género</label></th>    
                                        <td><select  id="genero" name="genero"  class="form-select" required>
                                        <option selected>Seleccione el Genero</option>
                                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $row['pkIdGenero']?>"><?php echo $row['nombre']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select></td>
                                 </tr> 
                                </tbody>
                                </table>
                                <?php
                                // Cerrando la conexion con la base de datos
                                mysqli_close($conectar);
                            ?>
                            <div class="text-center py-3"> 
                            <button type="submit" class="btn btn-success me-3" id="btnAgregar" name="btnAgregar" onclick='return confirmarInsert()'>Agregar</button>
                            <button id="cerrarFormularioL" class="btn btn-danger">Cerrar</button></div>
                           
                        </form>
                    </div>

                    <div id="formularioAgregarAutor" class="formulario-agregar-productos">
                        <h2>Agregar Autor</h2>
                        <form action="../../CONTROLADOR/insertAutor.php" method="post">
                            <label for="autor">Nombre Autor</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                            <label for="nacionalidad">Nacionalidad</label>
                            <input type="text" id="nacionalidad" name="nacionalidad" class="form-control" required>
                            <label for="fechaNacimiento">Fecha de Nacimiento</label>
                            <input type="date" id="fechaNacim" name="fechaNacim" class="form-control" required>
                            <label for="biografia">Biografia</label>
                            <textarea type="text"  cols="30" id="biografia" name="biografia" class="form-control" required style="resize: none;"></textarea>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success me-3">Agregar</button>
                                <button id="cerrarFormularioA" class="btn btn-danger">Cerrar</button>
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