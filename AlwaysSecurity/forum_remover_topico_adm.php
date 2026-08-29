<?php include "valida_session.php"; 

$login=$_SESSION["login"];
//echo "</BR>";

	$ligax = mysqli_connect('localhost','root','');
	if(!$ligax) {echo '<p> Falha na Ligação.';exit;}

	mysqli_select_db($ligax,'asecurity_bd');

	$consulta = "select * from UTILIZADORES WHERE login='".$login."'";
	$result = mysqli_query($ligax, $consulta);

	$nregistos = mysqli_num_rows($result);
	//echo 'Nº de registos encontrados:'.$nregistos;

	$registo = mysqli_fetch_assoc($result);

	$cod_ut = $registo['cod_ut'];
	$tipo_ut= $registo['tipo_ut'];
	$dat_ult_login= $registo['dat_ult_login'];
	$hrs_ult_login= $registo['hrs_ult_login'];
	
	
		//echo 'tipo de utilizador:'.$tipo;
		//echo"</BR>";
		//echo"Bem vindo ao sistema";
		
		
	if($tipo_ut!="adm") header("Location: pagina_principal.php");

?>
<!DOCTYPE HTML>
<html lang="pt-pt">
	<head>
		<title>Always Security</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="landing is-preload">
	<iframe src="imagens/silence.mp3" allow="autoplay" id="audio" style="display: none"></iframe>

	<audio  autoplay="autoplay" loop preload="preload">
		<source src="imagens/musica.wav" type="audio/wav">
	</audio>
		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1><a href="adm_index.php">Always Security</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="adm_pagina_principal.php">Área Administradora</a></li>
											<li><a href="adm_index.php">Início</a></li>
											<li><a href="definicaosi_adm.php">O que é Segurança na Internet</a></li>
											<li><a href="sredeswifi_adm.php">Segurança Redes Wi-Fi</a></li>
											<li><a href="navegars_adm.php">Navegue em Segurança</a></li>
											<li><a href="problemasi_adm.php">Problemas existentes na internet</a></li>
											<li><a href="transcompweb_adm.php">Transferências Financeiras e Compras Online</a></li>
											<li><a href="redessociaiss_adm.php">Redes Sociais - Utilizar de forma Segura</a></li>
											<li><a href="protmenores_adm.php">Proteção de menores de idade</a></li>
											<li><a href="expveridicas_adm.php">Experiências Verídicas</a></li>
											<li><a href="stuestac_adm.php">Estatísticas - Estudo a jovens entre os 12 e 15 anos</a></li>
											<li><a href="adm_area_jogo.php">Administração Jogo</a></li>
											<li><a href="logout.php">Sair</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Banner -->
					<section id="banner">

						<p><img src="imagens/logotipopap.jpg" width="300px" height="200px"></p>

						<div class="inner">


<h2>FÓRUM</h2>



<?php
	
	$cod_top = $_GET['cod_top'];
	
	
//	$tipo_ut = $_POST['tipo_ut'];
//	$bloq_fom = $_POST['bloq_fom'];
//	$dat_ult_login = $_POST['dat_ult_login'];
//	$hrs_ult_login = $_POST['hrs_ult_login'];	

if(!$cod_top )
{
	echo'Atenção! Campos em falta! Volte atrás e tente de novo!';
	exit;
}

//echo'Dados Recebidos:</br>';
//echo'login: '.$login.'</br>';
//echo'senha: '.$senha.'</br>';
// echo'tipo_ut: '.$tipo_ut.'</br>';
// echo'bloq_fom: '.$bloq_fom.'</br>';
// echo'dat_ult_login: '.$dat_ult_login.'</br>';
// echo'hrs_ult_login: '.$hrs_ult_login.'</br>';

$ligar=mysqli_connect ('localhost','root','');

if(!$ligar)
	{echo  '<p>Erro: Falha na ligação.</p>';exit;}

mysqli_select_db($ligar,'asecurity_bd');


//remover topico
$remove = "delete from TOPICOS
	where cod_top = $cod_top" ;

$result = mysqli_query($ligar, $remove);

if($result ==0) 
{
	echo '<p>Não removido</p></BR>';
	exit;
}
else
{
// se não deu erro então inserir log remover topico
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
  ('',$cod_ut,'".$dat_ult_login."','".$hrs_ult_login."','".$dat_oper."','".$hrs_oper."',2)";

  $result=mysqli_query($ligar,$inserir);

  if($result!=1) echo '<p>Erro no registo! Tente novamente!</p></br>';
  
}





header("Location: forum_topicos_adm.php");
	
?>










 

					</section>
				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="https://instagram.com/maddiie_2311?igshid=6ly2p0yxyaq2" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="mailto:maddiesofii2311@gmail.com" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
							<li><a href="https://www.youtube.com/channel/UCDoF9llATdrvYd0LiTs1Nxg" class="icon brands fa-youtube"><span class="label">Youtube</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Copyright <script type="text/javascript">document.write(new Date().getFullYear());
							</script> | by <a href="https://instagram.com/maddiie_2311?igshid=6ly2p0yxyaq2">Sofia Silva</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</body>
</html>