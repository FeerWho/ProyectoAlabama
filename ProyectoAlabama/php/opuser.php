<?php

// ++++++   SERVIDOR EN LA NUBE   ++++++ //
$host = 'bszv53k76fdegoaun32k-mysql.services.clever-cloud.com';
$userDB = 'u58xocum4dkzwo89';
$passDB = 'yH9WPgoUWlyXotDR0JMQ';
$nameDB = 'bszv53k76fdegoaun32k';

$conexion = new mysqli($host, $userDB, $passDB, $nameDB);

if($conexion->connect_error){
    die('Error de conexion a la base de datos: ' . $conexion->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $accion = $_POST['accion'];

    //++++++++++++++++++++++++++++++++++INSERT++++++++++++++++++++++++++++++++++//
    if($accion === 'insert'){
        $user = $_POST['txtUser'];
        $contrasena = $_POST['txtContrasena'];
        $rango = $_POST['cbxRango'];
        
        $query = "INSERT INTO usuarios(user,contrasena,rango) VALUES('$user','$contrasena','$rango')";
        
        if(!mysqli_query($conexion, $query)){
            $conexion->close();
            die('Error al intentar ejecutar la accion.');
        }

        header('Location: ../usuarios.php');

    //++++++++++++++++++++++++++++++++++UPDATE++++++++++++++++++++++++++++++++++//
    }elseif($accion === 'update'){
        $user = $_POST['txtUser'];
        $contrasena = $_POST['txtContrasena'];
        $rango = $_POST['cbxRango'];
        
        $query = "UPDATE usuarios SET contrasena='$contrasena',rango='$rango' WHERE user='$user'";
        
        if(!mysqli_query($conexion, $query)){
            $conexion->close();
            die('Error al intentar ejecutar la accion.');
        }

        header('Location: ../usuarios.php');

    //++++++++++++++++++++++++++++++++++DELETE++++++++++++++++++++++++++++++++++//
    }elseif($accion === 'delete'){
        $user = $_POST['txtUser'];

        $consulta = "SELECT * FROM usuarios WHERE user='$user'";
        $resultado = $conexion->query($consulta);

        if($resultado->num_rows == 1){
            $query = "DELETE FROM usuarios WHERE user='$user'";

            if(!mysqli_query($conexion, $query)){
                $conexion->close();
                die('Error al intentar ejecutar la accion.');
            }
        }
        
        header('Location: ../usuarios.php');

    
    }
    
}

$conexion->close();

?>