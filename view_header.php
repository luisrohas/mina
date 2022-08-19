<?php
// if( empty(session_id()) && !headers_sent()){
//     session_start();
if (session_start()){
    if(isset($_SESSION['evento'])&& isset($_SESSION['usuariop']) && isset($_SESSION['tiempo'])){
    $id_evento=$_SESSION['evento'];
    $id_part=$_SESSION['usuariop'];
//Tiempo en segundos para dar vida a la sesión.
$inactivo = 300;//1200 = 20min en este caso.
    
//Calculamos tiempo de vida inactivo.
$vida_session = time() - $_SESSION['tiempo'];

    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if($vida_session > $inactivo)
    {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();              
        //Redirigimos pagina.
        print "<script> window.location='index.php'; </script>";

        exit();
    }

    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiNa</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js" integrity="sha512-NhRZzPdzMOMf005Xmd4JonwPftz4Pe99mRVcFeRDcdCtfjv46zPIi/7ZKScbpHD/V0HB1Eb+ZWigMqw94VUVaw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/codificar.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <style media="screen">
       
 

       #container {
           width: auto
       }
       
       #left {
           float: left;
           width: 100px;
       }
       
       #right {
           float: right;
           margin-top: -90px;
           margin-right: 15px;
           color:blanchedalmond;
           text-align: center;
           font-family: Arial, Helvetica, sans-serif;
           font-size: 18px;
       }
       
       #center {
           margin: 0 auto;
           width: 100px;
       }
       input.dial {
           display: inline-block;
       }
       
               </style>
</head>

<body>

    <header class="site-header">
        <div class="contenedor contenido-header">
            <div class="barra">

            <a href="cerrar.php">
                    <img src="img/logouta.png" alt="Logotipo" title="Salir">
                </a>
                <div id="container">
  
  <div id="right"> 
     <?php
     //Código para calcular avance
     require 'db_connection.php';
     $sql = "SELECT COUNT(llen) AS llen, id_part, tot FROM avance WHERE id_part='".$id_part."' GROUP BY tot";

$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
while ($row = mysqli_fetch_array($result))
{

        $total=$row['tot'];
        $avance=$row['llen'];
        $avance=$avance*100/$total;
        $avance=number_format($avance, 0);
         mysqli_close($con);
      }
    }
      else {

$avance=0;

}
        
     ?>
  <input type="text" value="<?php print $avance;?>"  class="dial">
 
    <p> </p>
   
    <script src="js/progress.js"> 
     </script>

    </div>
 
</div>
            </div>
            <div class="usuario">
<?php
require 'db_connection.php';
require 'functions/cod_decod.php';
$sql = "SELECT * FROM tbl_participantes WHERE id_part='".$id_part."'";
	$result=mysqli_query($con,$sql);
	
		if (isset($_SESSION['usuariop']))
		{
		while ($row = mysqli_fetch_array($result))
		{
				print $row['nombre_part']." ".$row['apellidop_part']." ".$row['apellidom_part'];
				mysqli_close($con);
		}
		}

?>    </div>
        </div>
        
    </header>


<?php
}
else{
    ?>
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiNa</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

</head>

<body style="background-color:#000000;">
    <?php
     
    echo '<script>
    Swal.fire({
        title: "Sesión finalizada",
        text: "Ingresa de nuevo",
        showCancelButton: false,
        confirmButtonColor: "#6d3428",
        /*background: "rgba(52, 73, 94, 0.45)",*/
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
}
    ?>
    </body>
    </html>