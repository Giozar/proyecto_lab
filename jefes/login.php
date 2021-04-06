<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <?php

    //variable que auntentifica si el usuario entra o inicia sesión// al principio es falso
    $autenticar = false;
    $nombre;//<----variable nueva creada

    //se se mandoa el formulario hace lo siguiente
        if (isset($_POST['btn'])) {
            try {
                require("../conexion/conexion.php");
                //se declara la instruccion mysql
                $sql='SELECT * FROM jefes WHERE id = :login AND contrasena=:password';
                //se guarda en variable la instruccion preparada
                $resultado=$base->prepare($sql);
                //adquiere el nombre en entidat html con barras invertidas
                //$login adquiere el nombre del usuario
                //pasword adquiere la contraseña ingresada
                $login=htmlentities(addslashes($_POST['nombre']));
                $password=htmlentities(addslashes($_POST['pass']));
                //se busca en la tabla el valor y los compara para verificar que ya esta registrado y si son iguales 
                $resultado->bindValue(':login',$login);
                $resultado->bindValue(':password',$password);
                //entra y ejecuta
                $resultado->execute();
                //se guardan el numero de filas que se encuentra
                $numero_registro = $resultado->rowCount();
                //si hay datos en la fila de la base de datos que coincidan con los datos introducidos
                if ($numero_registro!=0) {//si hay datos encontrados entonces

                     //el usuario inicia una sesion
                    session_start();
                    //se guarda el nombre del usuario
                    while ($datos = $resultado->fetch(PDO::FETCH_ASSOC)) { 
                        $nombre = $datos['nombre']; 
                    }
                    $_SESSION['usuario']=$nombre;

                    //lo direcciona a una nueva pagina
                    header('Location:principal.php');

                    //autentifica que el usuario inicie sesion y es verdadero
                    $autenticar = true;

                    
                    //si el checkbox de recordar es verdadero//marcado para recordar, se crea la cookie, de lo contrario sigue el codigo
                    if (isset($_POST['recordar'])) {
                        //a la cookie se le da un parametro, que contendra el nombre del usuario dado por el formulario
                        setcookie('nombre_usuario',$nombre,time()+86400);//<-------------------cambio por el nombre
                    }
                }else {
                    //de lo contrario que vuevla a interntar a entrar a la sesion
                    header('Location: formulario_login.html');
                    echo 'usuario y contraseña incorrecta';
                }
                //si nada de lo anterior funciona guardame el error en $e
            } catch (Exception $e) {
                //si se cae todo, muetrame el error en mensaje
                die('error: '.$e->getMessage());
            }
            
        };
        

    /*    
    //si auntetificar es falso o no inicia sesion, sigue codigo
        if ($autenticar==false) {
            //si la cookie no está activa, muestra el formulario de nuevo
            if (!isset($_COOKIE['nombre_usuario'])) {
                include('formulario_login.html');
            }//de lo contrario ya habias inicado sesion
        }
        //si la cookie esta creada o aactiva
        if (isset($_COOKIE['nombre_usuario'])) {
            //muetra nuestro nombre con el parametro nombre_usuario
            echo '¡ Hola '.$_COOKIE['nombre_usuario'].' !';
            //si no esta creada la cookie pero el usuario inicia sesion desde el formulario/ se activa antenticar
        }elseif ($autenticar==true) {//si autenticar es verdadero
            //muestra el nombre del usuario
            echo '¡Hola '.$nombre.' !';//<----------cambio por el nombre
            //
        }

        if ($autenticar == true || isset($_COOKIE['nombre_usuario'])) {
            include("principal.html");
        }
        */


    ?>
    
</body>
</html>