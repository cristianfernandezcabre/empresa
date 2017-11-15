<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$q = $_GET['q'];
$_SESSION['usuario'] = "cfernandez";
$conexion = mysqli_connect ('localhost', 'root', '', 'proyecto2');
    if (!$conexion) {
        echo "Error: No se pudo conectar a MySQL. " . PHP_EOL;
        echo "Errno de depuración: " . mysqli_connect_errno () . PHP_EOL;
        echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
        exit;
    }
    if ($q == "Todo"){
        $sql="SELECT * FROM recursos";
    }else{
        $sql="SELECT * FROM recursos WHERE rec_tipo = '".$q."'";
    }
$result = mysqli_query($conexion,$sql);
$cont=0;
do { echo '<div class="w3-row-padding">';
    while($row = mysqli_fetch_array($result)) {
         echo '
    <div class="w3-third w3-container w3-margin-bottom">
      <img src="img/mis10.jpg" alt="'.$row['rec_nombre'].'" style="width:100%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b>'.$row['rec_nombre'].'</b></p>
        <div style="height:95px;">
        <p><b>Descripcion: </b>'.$row['rec_desc'].'</p>
        <p><b>Estado: </b>'.$row['rec_estado'].'</p>
        </div>
        <div class="w3-right"><a href="#" class="w3-button"><i class="fa fa-exclamation-triangle fa-fw"></i></a></div>';
          if($row['rec_estado']=="Reservado" OR $row['rec_estado']=="Averiado"){
            echo "<button class='w3-btn w3-grey w3-disabled w3-margin-bottom'>Reservar</button>";
          }
          else{
            echo '<form action="reservas.proc.php" method="GET" >
            <input type="hidden" name="usuarios" value="'.$_SESSION['usuario'].'">
            <input type="hidden" name="recursos" value="'.$row['rec_id'].'">
            <input class="w3-button w3-light-grey w3-margin-bottom" type="submit" name="reserva" value="Reservar">
          </form>';
          }

     echo '</div>  
    </div>';
        $cont++;
    } echo "</div>";
}while(($cont%3!=0)&&(mysqli_num_rows($result)!=$cont)); 

mysqli_close($conexion);
?>
</body>
</html>