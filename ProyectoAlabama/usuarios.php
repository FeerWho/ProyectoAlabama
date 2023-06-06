<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="styles/movements.css">
</head>
<body align="center">

    <section>
        <div>
            <h1>Usuarios</h1>
        </div>
    <div>
                <form id="usuarios" action="php/opuser.php" method="post" onsubmit="return validarDatosUsuario()">

                    <div>
                        <input type="text" class="entrada-control" id="txtUser" name="txtUser" placeholder="Usuario">
                    </div>
                    <div>
                        <input type="password" class="entrada-control" id="txtContrasena" name="txtContrasena" placeholder="Contraseña">
                    </div>
                    <div>
                        <select name="cbxRango" id="cbxRango" class="entrada-control">
                            <option value="NA" selected>NA</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" id="btn-guardar" name="accion" class="generic-btn" value="insert">Guardar</button>
                        <button type="submit" id="btn-modificar" name="accion" class="generic-btn" value="update">Modificar</button>
                        <button type="submit" id="btn-eliminar" name="accion" class="generic-btn" value="delete">Eliminar</button>
                    </div>
                </form>
    </div>
    <div>
        <button type="menu" class="close-btn" onclick="closeButton()">Salir</button>
    </div>
    <br><br>
    <div class="table-scroll" align="center">
            <table id="data" align="center">
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

                $query = "SELECT * FROM usuarios";
                $resultado = mysqli_query($conexion, $query);

                echo '<table>';
                    echo '<tr><th>User</th><th>Contraseña</th><th>Rango</th></tr>';
                    while($fila = mysqli_fetch_assoc($resultado)){
                        echo '<tr>';
                            echo '<td>' . $fila['user'] . '</td>';
                            echo '<td>**********</td>';
                            echo '<td>' . $fila['rango'] . '</td>';
                        echo '</tr>';
                    }
                echo '</table>';

                $conexion->close();
            ?>
            </table>
    </div>
    </section>
</body>
</html>