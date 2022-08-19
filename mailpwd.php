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
    <?php
require_once 'db_connection.php';  
if(isset($_POST['usuario']))
{
$user=$_POST['usuario'];
$sql = "SELECT id_part,correoe_part,contrasena_part FROM tbl_participantes WHERE correoe_part='$user'";
$result = mysqli_query($con,$sql);
if ($result->num_rows > 0)
 {
    while($row = $result->fetch_assoc()) 
    {
        ?>
        <div class="contenedor contenido-header">
            <div class="entrada">
                <form action="newpass.php" method="POST"/>
                    <input type="text" hidden name="user" value="<?php echo $user;?>">
                    <label>Nueva Contraseña</label><input type="password" name="contrasena" required>
                    <input class="boton boton-verde" type="submit" name="enviar" value="Guardar">
                </form>
            </div>
        </div> 
        <?php
    }
} 
else
  {
    echo "<script>
                       Swal.fire({
                             title: 'Datos incorrectos.',
                             text:'Correo no encontrado.',
                             icon: 'error',
                             confirmButtonText: 'Ok',
                            
                                                     })
                         .then(resultado => {
                             if (resultado.value) {
                             // Hicieron click en Sí
                             self.location = 'pwdchange.php';
                             } else {
                             // Dijeron que no
                        
                             }
                         })
                                     </script>";
  }

}

    ?>
</body>
</html>