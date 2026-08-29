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

	$tipo_ut= $registo['tipo_ut'];
	
	
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
		<link rel="stylesheet" href="assets/css/main2.css" />
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
											<li><a href="forum_topicos_adm.php">Fórum - Partilha a tua experiência, conhecimento e dúvidas aqui!</a></li>
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


<h2>JOGOS DE UTILIZADOR</h2>

<?php
	
	$login_ut = $_POST['login'];
	
	

if(!$login_ut )
{
	//echo'Atenção! Campos em falta! Volte atrás e tente de novo!';
	//exit;
	header("Location: adm_area_jogo_utilizador_frm.php");
}



	$ligax = mysqli_connect('localhost', 'root', '');

	if (!$ligax) {echo '<p> Falha na Ligação.'; exit;}

	mysqli_select_db($ligax, 'asecurity_bd');


	$consulta = "select * From UTILIZADORES, JOGO
	 WHERE UTILIZADORES.cod_ut= JOGO.cod_ut AND 
	 UTILIZADORES.login='".$login_ut."'
	 ORDER BY dat_real_teste desc, hrs_real_teste desc";



		
	$result = mysqli_query($ligax, $consulta);

	$nregistos = mysqli_num_rows($result);
	echo"<br/>";
	echo"<center>";
	//echo 'Nº de registos encontrados: '.$nregistos;

	echo"<table border= '1' style='width: 60%;'> ";

		echo"<tr>";
		echo "<td style='color: yellow;'>data</td>";
		echo "<td style='color: yellow;'>horas</td>"; 		
		echo "<td style='color: yellow; text-align: center;'>login</td>";
		echo "<td style='color: yellow; text-align: center;'>concluído</td>";
		echo "<td style='color: yellow; text-align: center;'>classificação final</td>";
		echo"</tr>";



	for($i=0; $i <$nregistos; $i++) 
	{
		$registo = mysqli_fetch_assoc($result);

		$login_ut = $registo['login'];
		$dat_real_teste = $registo['dat_real_teste'];
		$hrs_real_teste = $registo['hrs_real_teste'];
		$concluido = $registo['concluido'];
		$class_final = $registo['class_final'];

		
		echo"<tr>";
		//echo "<td><a href="."forum_respostas_adm.php?cod_top=".$cod_top.">$msg_top</td>";
		echo '<td>'.$dat_real_teste.'</td>'; 
		echo '<td>'.$hrs_real_teste.'</td>';
		echo '<td>'.$login_ut.'</td>';
		echo "<td style='text-align: center;'>".$concluido."</td>";
		if($concluido == 'S')
		  echo "<td style='text-align: center;'>".$class_final."%</td>";
		else
		  echo "<td style='text-align: center;'>".$class_final."</td>";
		
		echo"</tr>";
	
		
  	}

  	echo"</table>";



echo"</center>";

  	echo"<table>";
	echo"<tr>";
	echo"<td colspan='3' align='center'>";
  	echo "<a href='adm_area_jogo.php'>Voltar</a>";
  	echo"</td>";
	echo"</tr>";
  	echo"</table>";
?>

</br>












 

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