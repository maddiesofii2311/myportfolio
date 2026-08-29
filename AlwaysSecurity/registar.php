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
						<h1><a href="index.html">Always Security</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="index.html">Início</a></li>
											<li><a href="definicaosi.html">O que é Segurança na Internet</a></li>
											<li><a href="sredeswifi.html">Segurança Redes Wi-Fi</a></li>
											<li><a href="navegars.html">Navegue em Segurança</a></li>
											<li><a href="problemasi.html">Problemas existentes na internet</a></li>
											<li><a href="transcompweb.html">Transferências Financeiras e Compras Online</a></li>
											<li><a href="redessociaiss.html">Redes Sociais - Utilizar de forma Segura</a></li>
											<li><a href="protmenores.html">Proteção de menores de idade</a></li>
											<li><a href="expveridicas.html">Experiências Verídicas</a></li>
											<li><a href="stuestac.html">Estatísticas - Estudo a jovens entre os 12 e 15 anos</a></li>
											<li><a href="login.html">Fórum - Partilha a tua experiência, conhecimento e dúvidas aqui!</a></li>
											<li><a href="login.html">Vamos Jogar! - Quanto sabes sobre segurança na internet?</a></li>
											<li><a href="login.html">Entrar</a></li>
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

<?php
	
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
//	$tipo_ut = $_POST['tipo_ut'];
//	$bloq_fom = $_POST['bloq_fom'];
//	$dat_ult_login = $_POST['dat_ult_login'];
//	$hrs_ult_login = $_POST['hrs_ult_login'];	

if(!$login || !$senha)
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

//Testar se o utilizador já existe

$consulta = "select * From UTILIZADORES where login='".$login."'";
	$result = mysqli_query($ligar, $consulta);

	$nregistos = mysqli_num_rows($result);
	//echo 'Nº de registos encontrados: '.$nregistos;
if($nregistos != 0)
{
echo'Atenção! Utilizador já existe, volte atrás e escolha outro nome/email';
}
else
{



$inserir="INSERT into Utilizadores values
('','".$login."','".$senha."','utl','N',NULL,NULL)";

$result=mysqli_query($ligar,$inserir);

if($result!=1) echo '<p>Erro no registo! Tente novamente!</p></br>';
else 
  echo"<p>Registado com sucesso!</p></br>";

}
	
?>
</br>
<a href="index.html">Voltar</a>

					</section>
				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="https://instagram.com/maddiie_2311?igshid=6ly2p0yxyaq2" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="mailto:maddiesofii2311@gmail.com" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
							<li><a href="https://www.youtube.com/channel/UCDoF9llATdrvYd0LiTs1Nxg" class="icon brands fa-youtube"><span class="label">Youtube</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Copyright 2021 | by <a href="https://instagram.com/maddiie_2311?igshid=6ly2p0yxyaq2">Sofia Silva</a></li>
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