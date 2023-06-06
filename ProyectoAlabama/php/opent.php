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
        $nombre = $_POST['txtNombre'];
        $telefono = $_POST['txtTelefono'];
        $curp = $_POST['txtCURP'];
        $cantidad = (int)$_POST['txtCantidad'];
        $compra = (int)$_POST['txtDinero'];
        $descripcion = $_POST['txtDescripcion'];
        $fecha = date('Y-m-d H:i:s');

        $query = "INSERT INTO entradas(nombre,telefono,curp,cantidad,compra,descripcion,fecha) VALUES('$nombre','$telefono','$curp',$cantidad,$compra,'$descripcion','$fecha')";
        
        if(!mysqli_query($conexion, $query)){
            $conexion->close();
            die('Error al intentar ejecutar la accion.');
        }

        $consulta = "SELECT * FROM almacen ORDER BY fecha DESC LIMIT 1";
        $resultado = $conexion->query($consulta);
        $fila = mysqli_fetch_assoc($resultado);
        $valor = (int)$fila['cantidad'];
        $nuevoValor = $valor + $cantidad;
        $insertarNuevo = "INSERT INTO almacen(cantidad,fecha) VALUES($nuevoValor,'$fecha')";

        if(!mysqli_query($conexion, $insertarNuevo)){
            $conexion->close();
            die('Error al intentar ejecutar la accion.');
        }

        header('Location: ../entradas.php');

    //++++++++++++++++++++++++++++++++++UPDATE++++++++++++++++++++++++++++++++++//
    }elseif($accion === 'update'){
        $nombre = $_POST['txtNombre'];
        $telefono = $_POST['txtTelefono'];
        $curp = $_POST['txtCURP'];
        $cantidad = (int)$_POST['txtCantidad'];
        $compra = (int)$_POST['txtDinero'];
        $descripcion = $_POST['txtDescripcion'];
        $fecha = date('Y-m-d H:i:s');
        $folio = (int)$_POST['txtFolio'];

        $consulta1 = "SELECT * FROM entradas WHERE folio=$folio";
        $resultado1 = $conexion->query($consulta1);
        $fila1 = mysqli_fetch_assoc($resultado1);
        $valorAnterior = (int)$fila1['cantidad'];
        
        if($valorAnterior != $cantidad){
            $consulta = "SELECT * FROM almacen ORDER BY fecha DESC LIMIT 1";
            $resultado = $conexion->query($consulta);
            $fila = mysqli_fetch_assoc($resultado);
            $valor = (int)$fila['cantidad'];
            $nuevoValor = ($valor - $valorAnterior) + $cantidad;
            $insertarNuevo = "INSERT INTO almacen(cantidad,fecha) VALUES($nuevoValor,'$fecha')";

            if(!mysqli_query($conexion, $insertarNuevo)){
                $conexion->close();
                die('Error al intentar ejecutar la accion.');
            }
        }
        
        $query = "UPDATE entradas SET nombre='$nombre',telefono='$telefono',curp='$curp',cantidad=$cantidad,compra=$compra,descripcion='$descripcion',fecha='$fecha' WHERE folio=$folio";
        
        if(!mysqli_query($conexion, $query)){
            $conexion->close();
            die('Error al intentar ejecutar la accion.');
        }

        header('Location: ../entradas.php');

    //++++++++++++++++++++++++++++++++++DELETE++++++++++++++++++++++++++++++++++//
    }elseif($accion === 'delete'){
        $folio = (int)$_POST['txtFolio'];
        $fecha = date('Y-m-d H:i:s');

        $consultaAlmacen = "SELECT * FROM almacen ORDER BY fecha DESC LIMIT 1";
        $resultadoAlmacen = $conexion->query($consultaAlmacen);
        $filaAlmacen = mysqli_fetch_assoc($resultadoAlmacen);
        $valorAlmacen = (int)$filaAlmacen['cantidad'];

        $consultaEntradas = "SELECT * FROM entradas WHERE folio=$folio";
        $resultadoEntradas = $conexion->query($consultaEntradas);
        $filaEntradas = mysqli_fetch_assoc($resultadoEntradas);
        $valorEntradas = (int)$filaEntradas['cantidad'];

        $nuevoValor = $valorAlmacen - $valorEntradas;
        $insertarNuevo = "INSERT INTO almacen(cantidad,fecha) VALUES($nuevoValor,'$fecha')";

        if(!mysqli_query($conexion, $insertarNuevo)){
            $conexion->close();
            die('Error al intentar ejecutar la accion.');
        }

        $query = "DELETE FROM entradas WHERE folio=$folio";

        if(!mysqli_query($conexion, $query)){
            $conexion->close();
            die('Error al intentar ejecutar la accion.');
        }
        
        header('Location: ../entradas.php');

    
    }
    
}

$conexion->close();

?>