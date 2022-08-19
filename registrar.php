<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
 
</head>
<body>
<?php
include_once 'db_connection.php';

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : " ";
    $apellidop = isset($_POST['apellidop']) ? $_POST['apellidop'] : " ";
    $apellidom = isset($_POST['apellidom']) ? $_POST['apellidom'] : " ";
    $edad = isset($_POST['edad']) ? $_POST['edad'] : " ";
    $correo = isset($_POST['correoe']) ? $_POST['correoe'] : " ";
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : " ";

    $sql = 'SELECT * FROM tbl_participantes';
    $result = mysqli_query($con, $sql);
    $existe = 0;
        while ($row = mysqli_fetch_object($result)) 
            {
                if($row->correoe_part == $correo)
                {
                    $existe=1;
                    echo '<script>
                                    Swal.fire({
                                        title: "USUARIO NO REGISTRADO",
                                        text: "Correo duplicado",
                                        icon: "error",
                                        showCancelButton: false,
                                        confirmButtonText: "Ok",
                                        cancelButtonText: "Cancelar",
                                    })
                                    .then(resultado => {
                                        if (resultado.value) {
                                            self.location = "registro.html";
                                        } 
                                    })
                                </script>'; 
                } 
            }
           
        if($existe == 0)
            {
                
                $ahora=date('d-m-Y H:i:s');
                $contrasena = password_hash($contrasena,PASSWORD_DEFAULT,array("cost"=>12));
                $sql = "INSERT INTO tbl_participantes  (nombre_part,apellidop_part,apellidom_part,edad_part,correoe_part,contrasena_part,usuario_part,rol_part,estatus_part,alta_part) VALUES ('$nombre','$apellidop','$apellidom','$edad','$correo','$contrasena','$correo','participante','activo','$ahora')";
                    if(mysqli_query($con,$sql))
                    {
                        echo '<script>
                                    Swal.fire({
                                        title: "Bienvenido",
                                        text: "'.$nombre.' '.$apellidop.' '.$apellidom.'",
                                        icon: "success",
                                        showCancelButton: false,
                                        confirmButtonText: "Ok",
                                        
                                    })
                                    .then(resultado => {
                                        if (resultado.value) {
                                            self.location = "index.php";
                                        } 
                                    })
                                </script>'; 
                    }
                    else
                    {
                        echo '<script>
                                    Swal.fire({
                                        title: "ERROR",
                                        icon: "warning",
                                        showCancelButton: false,
                                        confirmButtonText: "Ok",
                                        
                                    })
                                    .then(resultado => {
                                        if (resultado.value) {
                                            self.location = "registro.html";
                                        } 
                                    })
                                </script>'; 
                        print "Error: " . $sql . "" . mysqli_error($con);
                    }
            }  
    mysqli_free_result($result);
    mysqli_close($con);
?>
</body>
</html>

