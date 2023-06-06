<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="styles/general.css">
</head>
<body align="center">
    <section>
        <h1>Menú</h1>
        <div>
            <button type="menu" class="generic-btn" onclick="newWindow('entradas.php')">Entradas</button>
        </div>
        <div>
            <button type="menu" class="generic-btn" onclick="newWindow('salidas.php')">Salidas</button>
        </div>
        <div>
            <button type="menu" class="admin-btn" onclick="newWindow('usuarios.php')">Usuarios</button>
        </div>
        <div>
            <button type="menu" class="close-btn" onclick="btnPressed('index.html')">Salir</button>
        </div>
        <div>
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

                $consulta = "SELECT * FROM almacen ORDER BY fecha DESC LIMIT 1";
                $resultado = $conexion->query($consulta);

                if($resultado->num_rows == 1){
                    $fila = mysqli_fetch_assoc($resultado);
                    echo '<h2>Cantidad en almacen: ' . $fila['cantidad'] . 'kg</h2>';
                    echo '<div><h3>Fecha del dato: ' . $fila['fecha'] . '</h3></div>';
                }
                ?>
        </div>
        <div>
            <button class="reload-btn" onclick="reloadWindow()"><img src="images/reload-icon.png"></button>
        </div>
    </section>
</body>
</html>