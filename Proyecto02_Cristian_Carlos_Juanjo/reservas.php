<!DOCTYPE html>
<html>
<title>Reservas</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="css/miestilo.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="js/ejercicios.js"></script>
<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","tiltmaximo2.php?q="+str,true);
  xmlhttp.send();
}
</script>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
</style>
<?php
session_start();
    $conexion = mysqli_connect ('localhost', 'root', '', 'proyecto2');
    if (!$conexion) {
        echo "Error: No se pudo conectar a MySQL. " . PHP_EOL;
        echo "Errno de depuración: " . mysqli_connect_errno () . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
        exit;
    }
    if (isset($_REQUEST['recursos'])){
      $sqlrec = "SELECT * FROM recursos WHERE rec_tipo = '".$_REQUEST['recursos']."'";
    }
    else{
      $sqlrec = "SELECT * FROM recursos";
    }
    echo $sqlrec;
$_SESSION['usuario']="aplans";
?>
<body class="w3-light-grey w3-content" style="max-width:1600px" onload="showUser('Todo')">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <img src="img/independance.gif" style="width:45%;" class="w3-round"><br><br>
    <h4><b><?php echo $_SESSION['usuario']; ?></b></h4>
    <p class="w3-text-grey">Hola</p>
  </div>
  <div class="w3-bar-block">
    <a href="#portfolio" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>Inicio</a>
    <a href="#resultado" onclick="funcion1()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-exclamation-triangle fa-fw w3-margin-right"></i>Incidencias</a>
    <a href="#reserva" onclick="funcion3()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-book fa-fw w3-margin-right"></i>Reservas Activas</a>
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>Cerrar Sesion</a> 
  </div>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">
    <a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1><b>Intranet: Reservas</b></h1>
    <div class="w3-section w3-bottombar w3-padding-16">
      <span class="w3-margin-right">Filtros:</span> 
      <button id="todo" class="w3-button w3-black" onclick="showUser('Todo'), todito()">Todo</button>
      <button id="aulas" class="w3-button w3-white" onclick="showUser('Aulas'), aulas()"><i class="fa fa-book w3-margin-right"></i>Aulas</button>
      <button id="despachos" class="w3-button w3-white w3-hide-small" onclick="showUser('Despachos/Salas'), despachos()"><i class="fa fa-users w3-margin-right"></i>Despachos/Salas</button>
      <button id="material" class="w3-button w3-white w3-hide-small" onclick="showUser('Material de trabajo'), material()"><i class="fa fa-laptop w3-margin-right"></i>Material de trabajo</button>
    </div>
    </div>
  </header>
  
  <!-- First Photo Grid-->
<div id="txtHint"><b>Aqui van los recursos</b></div>
  <!-- Pagination 
  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
      <a href="#" class="w3-bar-item w3-black w3-button">1</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
    </div>
  </div> -->
  <div id="reserva" class="modalmask">
      <div class="modalbox movedown" id="reservaContent">
        <a href="#cerrar" title="Close" class="close">X</a>
        <div class="w3-section w3-bottombar w3-padding-16">
          <h1 id="tituloResultado"><b>Mis reservas activas</b></h1>
        </div>
        <div id="reservaResultado">
          <?php
          $usuario=$_SESSION['usuario'];
              $sql = "SELECT `reservas`.*, `recursos`.`rec_estado`, `recursos`.`rec_nombre`
                      FROM `recursos`
                      INNER JOIN `reservas` ON `reservas`.`rec_id` = `recursos`.`rec_id` WHERE `reservas`.`res_fin` = '0000-00-00 00:00:00' AND `recursos`.`rec_estado` = 'Reservado' AND `reservas`.`usu_user` = '$usuario'";
              $reserva = mysqli_query($conexion, $sql);
              echo "<table class='w3-table-all w3-hoverable'>
                      <thead>
                        <tr class='w3-light-grey'>
                          <th>Numero de reserva</th>
                          <th>Recurso reservado</th>
                          <th>Fecha de reserva</th>
                          <th>Cerrar Reserva</th>
                        </tr>
                      </thead>";

              while($res = mysqli_fetch_array($reserva)){
                $fechaini = date_create($res['res_inicio']);//usamos date_create para poder
                echo '<tr>
                <td>'.$res['res_id'].'</td>
                <td>'.$res['rec_nombre'].'</td>
                <td>'.date_format($fechaini, 'd-m-y H:i:s').'</td>
                <td>
                  <form action="modreservas.proc.php" method="GET" >
                    <input type="hidden" name="usuarios" value="'.$_SESSION['usuario'].'">
                    <input type="hidden" name="recursos" value="'.$res['rec_id'].'">
                    <input type="hidden" name="reservas" value="'.$res['res_id'].'">
                    <input class="w3-button w3-light-grey w3-margin-bottom" type="submit" name="reserva" value="Liberar">
                  </form>
                </td>
                </tr>';
              }
              echo "</table>";

          ?>
        </div>
      </div>
    </div>
  <div id="resultado" class="modalmask">
      <div class="modalbox movedown" id="resultadoContent">
        <a href="#cerrar" title="Close" class="close">X</a>
        <div class="w3-section w3-bottombar w3-padding-16">
          <h1 id="tituloResultado"><b>Incidencias</b></h1>
        </div>
        <div id="contenidoResultado">
          <?php
              $sql = "SELECT * FROM incidencias";
              $incidencia = mysqli_query($conexion, $sql);
              while($consulta = mysqli_fetch_array($incidencia)){
                $fechaini = date_create($consulta['inc_fecha_incidencia']);//usamos date_create para poder convertir la fecha del formato de la bbdd al que nosotros queremos
                $fechafin = date_create($consulta['inc_fecha_solucion']);
                $usuario = 'SELECT * FROM usuarios WHERE usu_user = "'.$consulta['usu_user'].'"';
                $recursoreparado = 'SELECT * FROM recursos WHERE rec_id = "'.$consulta['rec_id'].'"';
                $usu_incidencia = mysqli_query($conexion, $usuario);
                $recursoreparado = mysqli_query($conexion, $recursoreparado);
                echo 'Numero incidencia: '.$consulta['inc_id'].'<br/>
                Descripcion incidencia: '.$consulta['inc_descripcion'].'<br/>
                Fecha creacion: '.date_format($fechaini, 'd-m-y').'<br/>
                Fecha solucion: '.date_format($fechafin, 'd-m-y').'<br/>';
                while($recurso = mysqli_fetch_array($recursoreparado))
                echo 'Recurso reparado: '.$recurso['rec_nombre'].'<br/>';//usamos date_format para darle el formato que queremos a la fecha, en este caso dia-mes-año
                 
                while($nombre = mysqli_fetch_array($usu_incidencia)){
                  echo 'Usuario informante: '.$nombre['usu_nombre'].' '.$nombre['usu_apellido'].'<br/>';
                }

              }
          ?>
        </div>
      </div>
    </div>
  <!-- Footer -->
  <footer class="w3-container w3-padding-32">
  <!--
  <div class="w3-row-padding">
    <div class="w3-third">
      <h3>FOOTER</h3>
      <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </div>
  
    <div class="w3-third">
      <h3>BLOG POSTS</h3>
      <ul class="w3-ul w3-hoverable">
        <li class="w3-padding-16">
          <img src="/w3images/workshop.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Lorem</span><br>
          <span>Sed mattis nunc</span>
        </li>
        <li class="w3-padding-16">
          <img src="/w3images/gondol.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Ipsum</span><br>
          <span>Praes tinci sed</span>
        </li> 
      </ul>
    </div>

    <div class="w3-third">
      <h3>POPULAR TAGS</h3>
      <p>
        <span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">London</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">DIY</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Family</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Shopping</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Games</span>
      </p>
    </div>

  </div> -->
  
  
  <div class="w3-black w3-center w3-padding-24">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></div>

<!-- End page content -->
</div>
</footer>
<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>
