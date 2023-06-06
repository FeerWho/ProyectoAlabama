<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salidas</title>
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="styles/movements.css">
</head>
<body align="center">

    <section>
        <div>
            <h1>Salidas</h1>
        </div>
    <div>
                <form id="salidas" action="php/opsal.php" method="post" onsubmit="return validarDatos()">

                    <div>
                        <input type="text" class="entrada-control" id="txtFolio" name="txtFolio" placeholder="Folio(Auto)">
                    </div>
                    <div>
                        <input type="text" class="entrada-control" id="txtNombre" name="txtNombre" placeholder="Nombre">
                    </div>
                    <div>
                        <input type="number" class="entrada-control" id="txtTelefono" name="txtTelefono" placeholder="Telefono">
                    </div>
                    <div>
                        <input type="text" class="entrada-control" id="txtCURP" name="txtCURP" placeholder="CURP">
                    </div>
                    <div>
                        <input type="number" class="entrada-control" id="txtCantidad" name="txtCantidad" placeholder="Cantidad(kg)">
                    </div>
                    <div>
                        <input type="number" class="entrada-control" id="txtDinero" name="txtDinero" placeholder="Venta($)">
                    </div>
                    <div>
                        <input type="text" class="entrada-control" id="txtDescripcion" name="txtDescripcion" placeholder="Descripcion(Opcional)">
                    </div>
                    <div>
                        <input type="text" class="entrada-control" id="txtFecha" name="txtFecha" placeholder="Fecha(Auto)" readonly>
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

                $query = "SELECT * FROM salidas";
                $resultado = mysqli_query($conexion, $query);

                echo '<table>';
                    echo '<tr><th>Folio</th><th>Nombre</th><th>Telefono</th><th>CURP</th><th>Cantidad(kg)</th><th>Venta</th><th>Descripcion</th><th>Fecha</th></tr>';
                    while($fila = mysqli_fetch_assoc($resultado)){
                        echo '<tr>';
                            echo '<td>' . $fila['folio'] . '</td>';
                            echo '<td>' . $fila['nombre'] . '</td>';
                            echo '<td>' . $fila['telefono'] . '</td>';
                            echo '<td>' . $fila['curp'] . '</td>';
                            echo '<td>' . $fila['cantidad'] . '</td>';
                            echo '<td>' . $fila['venta'] . '</td>';
                            echo '<td>' . $fila['descripcion'] . '</td>';
                            echo '<td>' . $fila['fecha'] . '</td>';
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