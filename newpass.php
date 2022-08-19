<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiNa</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
      <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
  <style>
  .swal2-title {

   color:#000000 !important;
}
.swal2-content {
  color:#000000 !important;
}
button.swal2-confirm.swal2-styled{
    border-left-color:#ff0080 !important;
}
.swal2-styled:hover{
    background-color:#214a5f !important;
}
 </style>
</head>
<body>
    
</body>
</html>
<?php

require_once 'db_connection.php'; 
if(isset($_POST['user']) || isset($_POST['contrasena']))
{
    if($_POST['contrasena']==''){
        echo "<script>
                        Swal.fire({
                            title: 'La contraseña no puede estar vacía.',
                            text:'Intenta nuevamente por favor.',
                            icon: 'error',
                            confirmButtonText: 'Ok',
                            
                                                    })
                        .then(resultado => {
                            if (resultado.value) {
                            // Hicieron click en Sí
                            self.location = 'index.php';
                            } else {
                            // Dijeron que no
                        
                            }
                        })
                                    </script>";
    }
    else
    {
$user= $_POST['user'];
$contrasena= $_POST['contrasena'];
$contrasena = password_hash($contrasena,PASSWORD_DEFAULT,array("cost"=>12));
                        
$sql="UPDATE tbl_participantes SET contrasena_part='$contrasena' WHERE correoe_part='$user'";
 if(mysqli_query($con,$sql)){
      echo "<script>
                        Swal.fire({
                            title: 'Contraseña',
                            text:'Actualizada',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            
                                                    })
                        .then(resultado => {
                            if (resultado.value) {
                            // Hicieron click en Sí
                            self.location = 'index.php';
                            } else {
                            // Dijeron que no
                        
                            }
                        })
                                    </script>";
 }
    }
}

?>