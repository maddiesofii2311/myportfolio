<?php 
include "valida_session.php"; 

// registar logout em LOGS
// consultar e recolher de utilizadores
// cod_ut | dat_ult_login | hrs_ult_login
$login=$_SESSION["login"];
//echo "</BR>";

	$ligar = mysqli_connect('localhost','root','');
	if(!$ligar) {echo '<p> Falha na Ligação.';exit;}

	mysqli_select_db($ligar,'asecurity_bd');

	$consulta = "select * from UTILIZADORES WHERE login='".$login."'";
	$result = mysqli_query($ligar, $consulta);

	$nregistos = mysqli_num_rows($result);
	//echo 'Nº de registos encontrados:'.$nregistos;

	$registo = mysqli_fetch_assoc($result);

	$cod_ut = $registo['cod_ut'];
	//$tipo_ut= $registo['tipo_ut'];
	$dat_ult_login= $registo['dat_ult_login'];
	$hrs_ult_login= $registo['hrs_ult_login'];


//recolher data e horas atuais
$ano=date("Y");
$mes=date("m");
$dia=date("d");
$data=$ano."-".$mes."-".$dia;
//echo $data;
$hor=date("H");
$min=date("i");
$seg=date("s");
$hora=$hor.":".$min.":".$seg;
//echo $hora;

$dat_oper = $data;
$hrs_oper = $hora;



  $inserir="INSERT into LOGS values
  ('',$cod_ut,'".$dat_ult_login."','".$hrs_ult_login."','".$dat_oper."','".$hrs_oper."',7)";

  $result=mysqli_query($ligar,$inserir);

  if($result!=1) echo '<p>Erro no registo! Tente novamente!</p></br>';
  //else 
  //echo"<p>Log Registado com sucesso!</p></br>";





session_start();
$_SESSION = array();
session_destroy();

header("Location: index.html");
?>