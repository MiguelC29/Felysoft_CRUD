<?php
  require 'Conexion.php';
 ?>
 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FELYSOFT-ACTUALIZAR LIBROS</title>
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
       if (isset($_REQUEST["updateLibro"])) {

        $pkIdLibro= $_POST['pkIdLibro'];
        $titulo = $_POST['titulo'];
        $editorial = $_POST['editorial'];
        $descripcion = $_POST['Descripcion'];
        $anioPublicacion = $_POST['anioPublicacion'];
        $precioHora = $_POST['precioHora'];
        $autor = $_POST['autor'];
        $genero = $_POST['genero'];
      
        $update = "UPDATE libros SET titulo = '$titulo', editorial = '$editorial', descripcion = '$descripcion', anioPublicacion = '$anioPublicacion', precioHora = '$precioHora', fkIdAutor = '$autor', fkIdGenero = '$genero' WHERE pkIdLibro = '$pkIdLibro'";

        $query= mysqli_query($conectar,$update);
      
        if ($query) {
            echo "<script language='JavaScript'>
                    alert('Los datos se actualizaron correctamente');
                    location.assign('../VISTA/principal/libros.php');
                </script>";
        } else {
            echo "<script language='JavaScript'>
                    alert('Los datos NO se actualizaron');
                    location.assign('../VISTA/principal/libros.php');
                </script>";
        }
     }else {
        $pkIdLibro = $_GET['pkIdLibro'];
        $select = "SELECT pkIdLibro, titulo, editorial, libros.descripcion as Descripcion, anioPublicacion, precioHora, autores.nombre as Autor, genero.nombre as Genero FROM libros INNER JOIN autores ON fkIdAutor = pkIdAutor INNER JOIN genero ON fkIdGenero = pkIdGenero  WHERE pkIdLibro = '".$pkIdLibro."'";

        $quer= mysqli_query($conectar,$select);
        $row= mysqli_fetch_assoc($quer);

        $titulo = $row['titulo'];
        $editorial = $row['editorial'];
        $descripcion = $row['Descripcion'];
        $anioPublicacion = $row['anioPublicacion'];
        $precioHora = $row['precioHora'];
        $autor = $row['Autor'];
        $genero = $row['Genero'];
        ?>
        <div id="formUpdateLibro" class="formulario-agregar-productos">
        <h2 class="text-center py-3">Editar Libro</h2>
        
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <table style="width: 830px;">
                <tbody>
                    <tr>
                        <input type="hidden" id="pkIdLibro" name="pkIdLibro" value="<?php echo $pkIdLibro ?>">
                        <th><label for="titulo">Nombre del Libro</label></th>
                        <td><input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo $titulo?>" required></td>
                        <th class="ps-4"><label for="editorial">Editorial</label></th>
                        <td><input type="text" id="editorial" name="editorial" class="form-control" value="<?php echo $editorial?>" required></td>
                    </tr>
                    <tr>
                        <th><label for="precioHora">Precio Por Hora</label></th>
                        <td><input type="text" id="precioHora" name="precioHora" class="form-control" value="<?php echo $precioHora?>" required></td>
                        <th class="ps-4"><label for="anioPublicacion">Año de Publicación</label></th>
                        <td><input type="text" id="anioPublicacion" name="anioPublicacion" class="form-control" value="<?php echo $anioPublicacion?>"></td>
                    </tr>
                    <tr>
                        <th><label for="Descripcion">Descripcion</label></th>
                        <td colspan="3"><input type="text" id="Descripcion" name="Descripcion" class="form-control" value="<?php echo $descripcion?>" required></td>
                    </tr>
                    <tr>
                    <?php
                        //Variable contenedora de la consulta a realizar
                        $sqlA = "SELECT pkIdAutor, nombre FROM autores ORDER BY nombre";

                        $result = mysqli_query($conectar, $sqlA);
                    ?>
                    <th><label for="autor">Autor</label></th>
                    <td><select  id="autor" name="autor"  class="form-select" required>
                        <option selected><?php echo $autor?></option>
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
                        <td><select  id="genero" name="genero"  class="form-select" require>
                        <option selected><?php echo $genero?></option>
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
                <button name="updateLibro" id="updateLibro" type="submit" class="btn btn-success me-3" onclick='return confirmarUpdate()'>Actualizar</button>
                <a href="../VISTA/principal/libros.php" class="btn btn-danger">Cerrar</a>
            </div>
        </form>
    </div>
    <?php
        }
    ?>
</body>
</html>
