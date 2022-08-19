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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<style>
  .swal2-title {

color:#ffffff !important;
}
.swal2-content {
color:#ffffff !important;
}
button.swal2-confirm.swal2-styled{
 border-left-color:#ff0080 !important;
}
.swal2-styled:hover{
 background-color:#214a5f !important;
}
a{
    font-size:12px;
    background-color:rgba(52, 73, 94, 0.45);
    padding:4px 0 4px 0;
}
/* unvisited link */
a:link {
  color: black;
  text-decoration: none;
  display: flex;
  justify-content: center;
  align-items: center;
  
 }
/* visited link */
a:visited {
  color: black;
}
/* mouse over link */
a:hover {
  color: white ;
  background-color:rgba(52, 73, 94, 1);
}
/* selected link */
a:active {
  color: #808080;
}
</style>
</head>
<body>
    <header class="site-header inicio">
        <div class="contenedor contenido-header">
            <div class="entrada">
              <!-- Evitar guardar datos autocomplete="off"-->
                   <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                   <!--<form action="index2.php" method="POST"> -->
                    <label>Usuario</label><input type="email" name="usuario">
                    <label>Contrase&ntilde;a</label><input type="password" name="contrasena">
                    <input class="boton boton-verde" type="submit" name="enviar" value="Entrar">
                    <br>
                    <a href="pwdchange.php">¿Olvidaste la contraseña?</a>
                    <input class="boton boton-rojo" type="button" name="registro" value="Registro" onclick="window.location.href='registro.html'">
                </form>
            </div>
        </div>
    </header>
    <div class="logo-index">
    <img style="display:scroll;position:fixed; top:10px; right:10px;" src="img/index_logo.png" alt="">
    </div>
    
</body>

</html>

<?php
session_start();
if(isset($_SESSION['usuariop']))
{
  print "<script> window.location='participante.php'; </script>";
}
elseif (isset($_SESSION['usuarioa']))
{
  print "<script> window.location='administrador.php'; </script>";
}

if (isset($_POST['enviar']))
{
  if (isset($_POST['usuario']) && isset($_POST['contrasena']))
    {
  include 'db_connection.php';
  $user1=$_POST['usuario'];
  $pass1=$_POST['contrasena'];
  $sql=mysqli_query($con,"SELECT * FROM tbl_usuarios LEFT JOIN tbl_participantes ON tbl_usuarios.id_user=tbl_participantes.id_part UNION SELECT * FROM tbl_usuarios RIGHT JOIN tbl_participantes ON tbl_usuarios.id_user=tbl_participantes.id_part");
  while ($row = mysqli_fetch_object($sql))
        {
            if(($row->correoe_part == $user1) && (password_verify($pass1, $row->contrasena_part) == $row->contrasena_part) && ($row->estatus_part == 'activo') && ($row->id_evento != NULL))
              {
                
                $_SESSION['usuariop']=$row->id_part;
                $_SESSION['evento']=$row->id_evento;
                $_SESSION['tiempo']=time();
                
                date_default_timezone_set('America/Mexico_City');
                date_default_timezone_get();
                $ahora=date('Y-m-d H:i:s');
                $ip=$_SERVER['REMOTE_ADDR'];
                
                $sql="INSERT INTO tbl_conec (id_part,fecha,ip) VALUES ('$row->id_part','$ahora','$ip')";
                mysqli_query($con,$sql);
                print "<script> window.location='participante.php'; </script>";
                
                
              } 
            elseif(($row->correoe_user == $user1) && (password_verify($pass1, $row->contrasena_user) == $row->contrasena_user) && ($row->estatus_user == 'activo'))
              {
                
                $_SESSION['usuarioa']=$row->id_user;
                $_SESSION['tiempo']=time();
                
                print "<script> window.location='administrador.php'; </script>";
              }
            
            }
           
          }
          echo '<script>
          Swal.fire({
              title: "Datos incorrectos",
              text: "Intente de nuevo",
              icon: "error",
              showCancelButton: false,
              background: "rgba(52, 73, 94, 0.45)",
              confirmButtonText: "Ok",
              cancelButtonText: "Cancelar",
          })
          .then(resultado => {
              if (resultado.value) {
                  self.location = "index.php";
              } 
          })
      </script>'; 
}






?>