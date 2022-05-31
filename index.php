<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilos/estilos.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Proyecto Integrado IAW - Javier Cabello Díaz</title>
</head>
<?php
include("conexionBD.php");
session_start();
?>
<body>
        <div class="wrapper">
            <div id="formContent">
                <!-- FORMULARIO LOGIN -->
                <h1>Login</h1>
                <hr>

                <?php
                if (isset($_POST["btnIniciaSesion"])) { // CONSULTA SI HAS PULSADO EL BOTÓN DE INICIAR SESIÓN
                    $usuario = $_POST["usuario"];
                    $pwd = $_POST["passwd"];
                    $query = "SELECT * FROM usuarios";
                    $resultados = mysqli_query($enlace, $query);

                    while ($fila = mysqli_fetch_assoc($resultados)) {
                        if ($usuario == $fila['usuario'] && $pwd == $fila['pwd']) { // USUARIO CORRECTO
                            $_SESSION['usuario'] = $usuario;
                            header("Location:main.php?ac=");
                        } else { // USUARIO INCORRECTO
                ?>
                            <div class="error">
                                <span>El usuario y/o la contraseña son incorrectos.</span>
                            </div>
                <?php
                        }
                    }
                }
                ?>
                <form action="" method="post">
                    <input type="text" id="login" class="" name="usuario" placeholder="Usuario">
                    <input type="password" id="password" class=" " name="passwd" placeholder="Contraseña">
                    <input type="submit" class=" " name="btnIniciaSesion" value="Iniciar sesión">
                </form>
            </div>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

<?php
    include("footer.php")
?>
</html>