<?php

// ++++++   LOCALHOST   ++++++ //
// $host = 'localhost';
// $userDB = 'root';
// $passDB = '';
// $nameDB = 'dbalabama';

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
    $user = $_POST['txtUser'];
    $contrasena = $_POST['txtContrasena'];

    $consulta = "SELECT * FROM usuarios WHERE user='$user' AND contrasena = '$contrasena'";
    $resultado = $conexion->query($consulta);

    if($resultado->num_rows == 1){
        // echo 'El usuario fue encontrado';
        $fila = mysqli_fetch_assoc($resultado);
        $valor = $fila['rango'];
        if($valor == 'admin'){
            header('Location: ../admin.php');
        }else{
            header('Location: ../menu.php');
        }
    }else{
        header('Location: ../badlogin.html');
    }
}

$conexion->close();

?>