<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <input type="text" name="nombre" id="nombre">
        <input type="submit" value="Agregar Producto">

    </form>

    <div id="producto">
        <?php
            $dominio = "localhost";
            $username = "root";
            $password = "";
            $database ="tiendavirtual";
        
            // Conexion base de datos 
        
            $conexion =new mysqli($dominio,$username,$password, $database);
        
            if($conexion->connect_error){
                die("No se pudo conectar". $conexion->connect_error);
            }

            if(isset($_POST['nombre'])){
                $nombre = $_POST['nombre'];
                $sql = "INSERT INTO productos(nombre,stock)
                        VALUES ('$nombre','false')";

                if($conexion->query($sql) == true){
                    
                    echo "se creo correctamente"; 
                }else{
                    die(" no se pudo crear el producto ".$conexion->error);
                }
                
            }

            $sql = "SELECT * FROM productos";
            $resultado = $conexion->query($sql);
            if ($resultado->num_rows > 0){
                while ($row = $resultado->fetch_assoc()) {
                   ?>
                   
                   <div id="<?php echo $row['id'] ?>">
                    <ul>
                   <li>
                    <?php
                     echo $row['nombre'];
                     ?>
                   </li> 
                    </ul>
                   </div>

                   <?php
                   
                }
              
            }
            $conexion->close();
        ?>
    </div>

</body>
</html>