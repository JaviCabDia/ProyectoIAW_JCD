<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilos/estilosmain.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Proyecto Integrado IAW - Javier Cabello Díaz</title>
</head>
<?php
include("conexionBD.php");
include("funciones.php");
session_start();
$accion = $_GET["ac"];
?>

<body>
    <?php
    if ($accion == "ae") { // AÑADIR EMPLEADOS
    ?>
        <div class="d-flex justify-content-center">
            <div class="card col-md-6 mt-3">

                <div class="card-header d-flex justify-content-center">
                    <b>Añadir empleado</b>
                </div>
                <form action="" method="post">
                    <label for="nombre">Nombre:</label>
                    <input class="form-control" type="text" name="nombre" id="">
                    <label for="apellidos">Apellidos:</label>
                    <input class="form-control" type="text" name="apellidos" id="">
                    <label for="correo">Correo:</label>
                    <input class="form-control" type="text" name="correo" id="">
                    <label for="fechaNac">Fecha de nacimiento:</label>
                    <input class="form-control" type="date" name="fechaNac" id="">
                    <label>¿Es activo o no?:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="activo" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Sí
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="activo" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            No
                        </label>
                    </div>
                    <label for="selDep">Departamento asignado:</label>
                    <select name="selDep" class="form-control" id="">
                        <?php
                        $departamentos = "SELECT * FROM departamentos";
                        $resultados = mysqli_query($enlace, $departamentos);
                        echo "<option value=''>Ninguno</option>";
                        while ($fila = mysqli_fetch_assoc($resultados)) {
                            echo "<option value='" . $fila["codigo"] . "'>" . $fila["nombre"] . "</option>";
                        }
                        ?>
                    </select>
                    <input class="btn btn-success my-3" type="submit" value="Añadir empleado" name="btnSubmit">
                    <a href="main.php?ac" class="btn btn-secondary">Volver atrás</a>
                </form>
            </div>
        </div>
        <?php
        if (isset($_POST['btnSubmit'])) {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $fechaNac = $_POST['fechaNac'];
            $activo = $_POST['activo'];
            if ($activo == "on") {
                $activo = 1;
            } else {
                $activo = 0;
            }
            $selDep = $_POST['selDep'];

            $sql = "INSERT INTO empleados (nombre, apellidos, correo, fechaNac, activo, codigoDep) VALUES
            ('$nombre', '$apellidos', '$correo', $fechaNac, '$activo', '$selDep');
            ";
            $resultados = mysqli_query($enlace, $sql);
            if ($resultados) {
                header("Location:main.php?ac");
            } else {
                header("Location:main.php?ac");
            }
        }
    } else if ($accion == "ad") { // AÑADIR DEPARTAMENTO
        ?>
        <div class="d-flex justify-content-center">
            <div class="card col-md-6 mt-3">

                <div class="card-header d-flex justify-content-center">
                    <b>Añadir departamento</b>
                </div>
                <form action="" method="post">
                    <label for="nombreDep">Nombre:</label>
                    <input class="form-control" type="text" name="nombreDep">
                    <label for="director">Director:</label>
                    <select class="form-control" name="director">
                        <?php
                        $empleados = "SELECT * FROM empleados";
                        $resultados = mysqli_query($enlace, $empleados);
                        echo "<option value=''>Ninguno</option>";
                        while ($fila = mysqli_fetch_assoc($resultados)) {
                            echo "<option value='" . $fila["codigo"] . "'>" . $fila["nombre"] . "</option>";
                        }
                        ?>
                    </select>
                    <label for="centro">Centro:</label>
                    <select class="form-control" name="centro">
                        <?php
                        $centros = "SELECT * FROM centros";
                        $resultados = mysqli_query($enlace, $centros);
                        echo "<option value=''>Ninguno</option>";
                        while ($fila = mysqli_fetch_assoc($resultados)) {
                            echo "<option value='" . $fila["codigo"] . "'>" . $fila["direccion"] . "</option>";
                        }
                        ?>
                    </select>

                    <input class="btn btn-success my-3" type="submit" value="Añadir departamento" name="btnSubmitDep">
                    <a href="main.php?ac" class="btn btn-secondary">Volver atrás</a>
                </form>
            </div>
        </div>
        <?php
        if (isset($_POST['btnSubmitDep'])) {
            $nombre = $_POST['nombreDep'];
            $codigo_director = $_POST['director'];
            $codigo_centro = $_POST['centro'];

            $sql = "INSERT INTO departamentos (nombre, codigo_director, codigo_centro) VALUES
            ('$nombre', '$codigo_director', '$codigo_centro');
            ";
            $resultados = mysqli_query($enlace, $sql);
            if ($resultados) {
                header("Location:main.php?ac");
            } else {
                header("Location:main.php?ac");
            }
        }
        ?>
    <?php
    } else if ($accion == "ac") { // AÑADIR CENTROS
    ?>
        <div class="d-flex justify-content-center">
            <div class="card col-md-6 mt-3">

                <div class="card-header d-flex justify-content-center">
                    <b>Añadir centros</b>
                </div>
                <form action="" method="post">
                    <label for="direccion">Dirección:</label>
                    <input class="form-control" type="text" name="direccion">


                    <input class="btn btn-success my-3" type="submit" value="Añadir centro" name="btnSubmitCen">
                    <a href="main.php?ac" class="btn btn-secondary">Volver atrás</a>
                </form>
            </div>
        </div>
        <?php
        if (isset($_POST['btnSubmitCen'])) {
            $direccion = $_POST['direccion'];

            $sql = "INSERT INTO centros (direccion) VALUES
            ('$direccion');
            ";
            $resultados = mysqli_query($enlace, $sql);
            if ($resultados) {
                header("Location:main.php?ac");
            } else {
                header("Location:main.php?ac");
            }
        }
        ?>
    <?php
    } else if ($accion == "ru") { // REGISTRAR USUARIOS EN LA BBDD
    ?>
        <div class="d-flex justify-content-center">
            <div class="card col-md-6 mt-3">

                <div class="card-header d-flex justify-content-center">
                    <b>Registrar usuarios</b>
                </div>
                <form action="" method="post">
                    <label for="usuario">Usuario:</label>
                    <input class="form-control" type="text" name="usuario">
                    <label for="pwd">Contraseña:</label>
                    <input class="form-control" type="text" name="pwd">

                    <input class="btn btn-success my-3" type="submit" value="Registrar usuario" name="btnSubmitUsu">
                    <a href="main.php?ac" class="btn btn-secondary">Volver atrás</a>
                </form>
            </div>
        </div>
        <?php
        if (isset($_POST['btnSubmitUsu'])) {
            $usuario = $_POST['usuario'];
            $pwd = $_POST['pwd'];

            $sql = "INSERT INTO usuarios (usuario, pwd) VALUES
            ('$usuario', '$pwd');
            ";
            $resultados = mysqli_query($enlace, $sql);
            if ($resultados) {
                header("Location:main.php?ac");
            } else {
                header("Location:main.php?ac");
            }
        }
        ?>
        <?php
    } else if ($accion == "edit") { // MODIFICAR USUARIO
        $codigo = $_GET['cod'];
        $sql = "SELECT * FROM empleados WHERE codigo = '" . $codigo . "'";
        $resultados = mysqli_query($enlace, $sql);
        while ($fila = mysqli_fetch_assoc($resultados)) {
        ?>
            <div class="d-flex justify-content-center">
                <div class="card col-md-6 mt-3">

                    <div class="card-header d-flex justify-content-center">
                        <b>Modificando empleado</b>
                    </div>
                    <form action="gestion.php?ac=edit1&cod=<?php echo $codigo; ?>" method="post">
                        <label for="nombre">Nombre:</label>
                        <input class="form-control" type="text" name="nombre" value="<?php echo $fila['nombre']; ?>">
                        <label for="apellidos">Apellidos:</label>
                        <input class="form-control" type="text" name="apellidos" value="<?php echo $fila['apellidos']; ?>">
                        <label for="correo">Correo:</label>
                        <input class="form-control" type="text" name="correo" value="<?php echo $fila['correo']; ?>">
                        <label for="fechaNac">Fecha de nacimiento:</label>
                        <input class="form-control" type="date" name="fechaNac" value="<?php echo fecha($fila['fechaNac']); ?>">
                        <label>¿Es activo o no?:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activo" id="flexRadioDefault1" <?php if ($fila['activo'] == "1") {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Sí
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="activo" id="flexRadioDefault2" <?php if ($fila['activo'] == "0") {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                            <label class="form-check-label" for="flexRadioDefault2">
                                No
                            </label>
                        </div>
                        <label for="selDep">Departamento asignado:</label>
                        <select name="selDep" class="form-control" id="">
                            <?php
                            $departamentos = "SELECT * FROM departamentos";
                            $resultados = mysqli_query($enlace, $departamentos);
                            echo "<option value=''>Ninguno</option>";
                            while ($fila2 = mysqli_fetch_assoc($resultados)) {
                                echo "<option ";
                                if ($fila2['codigo'] == $fila['codigoDep']) {
                                    echo "selected";
                                }
                                echo " value='" . $fila2["codigo"] . "'>" . $fila2["nombre"] . "</option>";
                            }
                            ?>
                        </select>
                        <input class="btn btn-success my-3" type="submit" value="Modificar empleado" name="btnSubmit">
                        <a href="main.php?ac" class="btn btn-secondary">Volver atrás</a>
                    </form>
                </div>
            </div>
        <?php
        }
    } else if ($accion == "edit1") {
        $codigo = $_GET['cod'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $fechaNac = $_POST['fechaNac'];
        $activo = $_POST['activo'];
        $codigoDep = $_POST['selDep'];

        $sql = "UPDATE empleados SET nombre='" . $nombre . "', apellidos='" . $apellidos . "',
        correo='" . $correo . "', fechaNac='" . $fechaNac . "', activo='" . $activo . "', codigoDep='" . $codigoDep . "'
        WHERE codigo = '" . $codigo . "'";
        $resultados = mysqli_query($enlace, $sql);
        if ($resultados) {
            header("Location:main.php?ac");
        } else {
            header("Location:main.php?ac");
        }
    } else if ($accion == "elim") {
        $codigo = $_GET['cod'];

        $sql = "SELECT * FROM empleados WHERE codigo = '" . $codigo . "'";
        $resultados = mysqli_query($enlace, $sql);
        while ($fila = mysqli_fetch_assoc($resultados)) {
            echo "<h1 style='text-align:center;'>¿Está seguro/a que desea eliminar el empleado " . $fila['nombre'] . " ?</h1>";
        ?>
            <div class="d-flex justify-content-center">
                <form action="gestion.php?ac=elim1&cod=<?php echo $codigo; ?>" method="post">
                    <input class="btn btn-success mr-1" type="submit" value="Aceptar" name="btnElimina">
                    <a href="main.php?ac" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        <?php

        }
    } else if ($accion == "elim1") {
        $codigo = $_GET['cod'];
        $delete = "DELETE FROM empleados WHERE codigo='" . $codigo . "'";
        $resultados = mysqli_query($enlace, $delete);
        header("Location:main.php?ac");
    } else if ($accion == "editD") { // MODIFICAR DEPARTAMENTO
        $codigo = $_GET['cod'];
        $sql = "SELECT * FROM departamentos WHERE codigo = '" . $codigo . "'";
        $resultados = mysqli_query($enlace, $sql);
        while ($fila = mysqli_fetch_assoc($resultados)) {
        ?>
            <div class="d-flex justify-content-center">
                <div class="card col-md-6 mt-3">

                    <div class="card-header d-flex justify-content-center">
                        <b>Modificando departamento</b>
                    </div>
                    <form action="gestion.php?ac=editD1&cod=<?php echo $codigo; ?>" method="post">
                        <label for="nombre">Nombre:</label>
                        <input class="form-control" type="text" name="nombre" value="<?php echo $fila['nombre']; ?>">
                        <label for="director">Director:</label>
                        <select class="form-control" name="director">
                            <?php
                            $sql = "SELECT * FROM empleados";
                            $resultados = mysqli_query($enlace, $sql);
                            while ($fila2 = mysqli_fetch_assoc($resultados)) {
                                echo "<option ";
                                if ($fila['codigo_director'] == $fila2['codigo']) {
                                    echo "selected";
                                }
                                echo " value='" . $fila2['codigo'] . "'>" . $fila2['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="centro">Centro:</label>
                        <select class="form-control" name="centro">
                            <?php
                            $sql = "SELECT * FROM centros";
                            $resultados = mysqli_query($enlace, $sql);
                            while ($fila2 = mysqli_fetch_assoc($resultados)) {
                                echo "<option ";
                                if ($fila['codigo_centro'] == $fila2['codigo']) {
                                    echo "selected ";
                                }
                                echo "value='" . $fila2['codigo'] . "'>" . $fila2['direccion'] . "</option>";
                            }
                            ?>
                        </select>
                        <br>
                        <input class="btn btn-success my-3" type="submit" value="Modificar departamento" name="btnSubmitD">
                        <a href="main.php?ac" class="btn btn-secondary">Volver atrás</a>
                    </form>
                </div>
            </div>
        <?php
        }
    } else if ($accion == "editD1") {
        $codigo = $_GET['cod'];
        $nombre = $_POST['nombre'];
        $codigo_director = $_POST['director'];
        $codigo_centro = $_POST['centro'];

        $sql = "UPDATE departamentos SET nombre='" . $nombre . "', codigo_director='" . $codigo_director . "', codigo_centro='" . $codigo_centro . "'
        WHERE codigo LIKE '" . $codigo . "'";
        $resultados = mysqli_query($enlace, $sql);
        header("Location:main.php?ac");
    } else if ($accion == "elimD") {
        $codigo = $_GET['cod'];

        $sql = "SELECT * FROM departamentos WHERE codigo = '" . $codigo . "'";
        $resultados = mysqli_query($enlace, $sql);
        while ($fila = mysqli_fetch_assoc($resultados)) {
            echo "<h1 style='text-align:center;'>¿Está seguro/a que desea eliminar el departamento " . $fila['nombre'] . " ?</h1>";
        ?>
            <div class="d-flex justify-content-center">
                <form action="gestion.php?ac=elimD1&cod=<?php echo $codigo; ?>" method="post">
                    <input class="btn btn-success mr-1" type="submit" value="Aceptar" name="btnElimina">
                    <a href="main.php?ac" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        <?php

        }
    } else if ($accion == "elimD1") {
        $codigo = $_GET['cod'];
        $delete = "DELETE FROM departamentos WHERE codigo='" . $codigo . "'";
        $resultados = mysqli_query($enlace, $delete);
        header("Location:main.php?ac");
    } else if ($accion == "editC") {
        $codigo = $_GET['cod'];

        $sql = "SELECT * FROM centros WHERE codigo='" . $codigo . "'";
        $resultados = mysqli_query($enlace, $sql);
        while ($fila = mysqli_fetch_assoc($resultados)) {
        ?>
            <div class="d-flex justify-content-center">
                <div class="card col-md-6 mt-3">

                    <div class="card-header d-flex justify-content-center">
                        <b>Modificando centro</b>
                    </div>
                    <form action="gestion.php?ac=editC1&cod=<?php echo $codigo; ?>" method="post">
                        <label for="direccion">Direccion:</label>
                        <input class="form-control" type="text" name="direccion" value="<?php echo $fila['direccion']; ?>">
                        
                        <br>
                        <input class="btn btn-success my-3" type="submit" value="Modificar centro" name="btnSubmitC">
                        <a href="main.php?ac" class="btn btn-secondary">Volver atrás</a>
                    </form>
                </div>
            </div>
    <?php
        }
    } else if ($accion == "editC1") {
        $codigo = $_GET['cod'];
        $direccion = $_POST['direccion'];

        $sql = "UPDATE centros SET direccion='".$direccion."' WHERE codigo LIKE '".$codigo."'";
        $resultados = mysqli_query($enlace, $sql);
        header("Location:main.php?ac");
    } else if ($accion == "elimC1") {
        $codigo = $_GET['cod'];
        $delete = "DELETE FROM centros WHERE codigo='".$codigo."'";
        $resultados = mysqli_query($enlace, $delete);
        header("Location:main.php?ac");
    } else if ($accion == "elimC") {
        $codigo = $_GET['cod'];

        $sql = "SELECT * FROM centros WHERE codigo = '".$codigo."'";
        $resultados = mysqli_query($enlace, $sql);
        while ($fila = mysqli_fetch_assoc($resultados)) {
            echo "<h1 style='text-align:center;'>¿Está seguro/a que desea eliminar el centro de " . $fila['direccion'] . " ?</h1>";
        ?>
            <div class="d-flex justify-content-center">
                <form action="gestion.php?ac=elimC1&cod=<?php echo $codigo; ?>" method="post">
                    <input class="btn btn-success mr-1" type="submit" value="Aceptar" name="btnElimina">
                    <a href="main.php?ac" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        <?php

        }
    }
    ?>
</body>

<?php
include("footer.php");
?>