<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal empleado</title>
</head>
<body>
    <?php
        //indica que el usuario inicio sesion
        session_start();
        //si el usuario no se encontro
        if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipo_empleado'])) {
            //lo redirecciona a iniciar sesion
            header('Location:formulario_login.html');
        } 
    ?>

    <header>
        <h3>
            <?php
                echo "! Hola {$_SESSION['usuario']}!<br>";
                //si la cookie esta creada o aactiva
                if (isset($_COOKIE['nombre_usuario'])) {
                    //muetra nuestro nombre con el parametro nombre_usuario
                    echo '¡ Hola '.$_COOKIE['nombre_usuario'].' !';
                }
            ?>
        </h3>
        
        <tr>
            <!-- link a pagina de cerra sesion -->
            <th colspan="3"><a href="cerrar_sesion.php">Cerrar sesion</a></th>
        </tr>
    
        <nav>
            <ul>
                <li>
                    <p>Registrar usuario</p>
                </li>

                <li>
                    <p>Control de usuarios</p>
                    <a href="control_paciente/formulario_paciente.php">Registrar paciente</a>
                </li>

                <li>
                    <p>Realizar cita</p>
                </li>

                <li>
                    <p>Mandar Resultados</p>
                </li>
            </ul>

        </nav>
    </header>

    <section>
        <h1>Hola Labs</h1>

    </section>

    <footer>
        <p>Acerca de nosotros</p>
    </footer>