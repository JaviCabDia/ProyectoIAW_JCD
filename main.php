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
session_start();
$usuario = $_SESSION['usuario'];
$accion = $_GET['ac'];
?>

<body>
    <header>
        <div class="d-flex justify-content-end">
            <div class="p-2"><b>Has iniciado sesión como: <?php echo $usuario; ?> <a href="index.php"> (Cerrar sesión)</a></b></div>
        </div>
    </header>
    <div class="d-flex justify-content-center">
        <h3>Bienvenido/a a la aplicación de gestión de CabeDi</h3>
    </div>
    <div class="d-flex justify-content-center">
        <h5>Seleccione la acción que desee realizar:</h5>
    </div>
    <form action="" method="post">
        <div class="float-container">
            <div class="float-child">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <b>Gestión</b>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Base de datos</h6>
                        <hr>
                        <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg> Para modificar/eliminar se hará desde las tablas en 'Mostrar...'</i>
                        <h6 class="card-title">Empleados</h6>
                        <input type="submit" class="btn btn-success" name="btnAddEmple" value="Añadir">
                        <br><br>
                        <h6 class="card-title">Departamentos</h6>
                        <input type="submit" class="btn btn-success" name="btnAddDep" value="Añadir">
                        <br><br>
                        <h6 class="card-title">Centros</h6>
                        <input type="submit" class="btn btn-success" name="btnAddCent" value="Añadir">
                        <hr>
                        <h6 class="card-title">Usuarios</h6>
                        <hr>
                        <input type="submit" class="btn btn-warning" name="regUsu" value="Registrar usuarios">
                    </div>
                </div>
            </div>
    </form>
    <?php
    if (isset($_POST["btnAddEmple"])) {
        header("Location:gestion.php?ac=ae");
    } else if (isset($_POST["btnAddDep"])) {
        header("Location:gestion.php?ac=ad");
    } else if (isset($_POST["btnAddCent"])) {
        header("Location:gestion.php?ac=ac");
    } else if (isset($_POST['regUsu'])) {
        header("Location:gestion.php?ac=ru");
    }
    ?>
    <form action="" method="post">
        <div class="float-child">
            <div class="card">

                <div class="card-header d-flex justify-content-center">
                    <b>Mostrar datos</b>
                </div>
                <div class="card-body">
                    <input type="submit" class="btn btn-primary" name="verEmple" value="Ver empleados">
                    <input type="submit" class="btn btn-primary" name="verDep" value="Ver departamentos">
                    <input type="submit" class="btn btn-primary" name="verCent" value="Ver centros">
                </div>
                <?php
                if (isset($_POST["verEmple"])) {
                ?>

                    <table class="table table-striped table-responsive table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Fecha de Nacimiento</th>
                                <th scope="col">Activo</th>
                                <th scope="col">Departamento</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $empleados = "SELECT * FROM empleados";
                            $resultados = mysqli_query($enlace, $empleados);
                            while ($fila = mysqli_fetch_assoc($resultados)) {
                                echo "<tr>";
                                echo "<th scope='row'>" . $fila['codigo'] . "</th>";
                                echo "<th>" . $fila['nombre'] . "</th>";
                                echo "<th>" . $fila['apellidos'] . "</th>";
                                echo "<th>" . $fila['correo'] . "</th>";
                                echo "<th>" . $fila['fechaNac'] . "</th>";
                                echo "<th>" . $fila['activo'] . "</th>";
                                echo "<th>" . $fila['codigoDep'] . "</th>";
                                echo '<th><a style="color:green;" href="gestion.php?ac=edit&cod='.$fila['codigo'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                              </svg></a>
                              

                              
                              <a style="color:red;" href="gestion.php?ac=elim&cod='.$fila['codigo'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg></a></th>';
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else if (isset($_POST['verDep'])) {
                ?>
                    <table class="table table-striped table-responsive table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Director</th>
                                <th scope="col">Centro</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $departamentos = "SELECT * FROM departamentos";
                            $resultados = mysqli_query($enlace, $departamentos);
                            while ($fila = mysqli_fetch_assoc($resultados)) {
                                echo "<tr>";
                                echo "<th scope='row'>" . $fila['codigo'] . "</th>";
                                echo "<th>" . $fila['nombre'] . "</th>";
                                echo "<th>" . $fila['codigo_director'] . "</th>";
                                echo "<th>" . $fila['codigo_centro'] . "</th>";
                                echo '<th><a style="color:green;" href="gestion.php?ac=editD&cod='.$fila['codigo'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                              </svg></a>
                              

                              
                              <a style="color:red;" href="gestion.php?ac=elimD&cod='.$fila['codigo'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg></a></th>';
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else if (isset($_POST['verCent'])) {
                ?>
                    <table class="table table-striped table-responsive table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $centros = "SELECT * FROM centros";
                            $resultados = mysqli_query($enlace, $centros);
                            while ($fila = mysqli_fetch_assoc($resultados)) {
                                echo "<tr>";
                                echo "<th scope='row'>" . $fila['codigo'] . "</th>";
                                echo "<th>" . $fila['direccion'] . "</th>";
                                echo '<th><a style="color:green;" href="gestion.php?ac=editC&cod='.$fila['codigo'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                              </svg></a>
                              

                              
                              <a style="color:red;" href="gestion.php?ac=elimC&cod='.$fila['codigo'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg></a></th>';
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                }
                ?>
            </div>
        </div>
        </div>
    </form>
</body>
<?php
include("footer.php");
?>