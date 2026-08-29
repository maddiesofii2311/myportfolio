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

	$cod_ut= $registo['cod_ut'];
	$tipo_ut= $registo['tipo_ut'];
	
	
		//echo 'tipo de utilizador:'.$tipo;
		//echo"</BR>";
		//echo"Bem vindo ao sistema";
		
		
	if($tipo_ut=="adm") header("Location: adm_pagina_principal.php");

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
											<li><a href="pagina_principal.php">Início</a></li>
											<li><a href="definicaosi_log.php">O que é Segurança na Internet</a></li>
											<li><a href="sredeswifi_log.php">Segurança Redes Wi-Fi</a></li>
											<li><a href="navegars_log.php">Navegue em Segurança</a></li>
											<li><a href="problemasi_log.php">Problemas existentes na Internet</a></li>
											<li><a href="transcompweb_log.php">Transferências Financeiras e Compras Online</a></li>
											<li><a href="redessociaiss_log.php">Redes Sociais - Utilizar de forma Segura</a></li>
											<li><a href="protmenores_log.php">Proteção de menores de idade</a></li>
											<li><a href="expveridicas_log.php">Experiências Verídicas</a></li>
											<li><a href="stuestac_log.php">Estatísticas - Estudo a jovens entre os 12 e 15 anos</a></li>
											<li><a href="forum_topicos.php">Fórum - Partilha a tua experiência, conhecimento e dúvidas aqui!</a></li>				
											<li><a href="zona_jogo.php">Vamos Jogar! - Quanto sabes sobre segurança na internet?</a></li>
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


<h2>RESULTADOS DE JOGOS</h2>

<?php
echo"</br>";echo"</br>";


  	//Apresentar a pergunta antes das respostas possíveis
	$consulta = "select * from JOGO WHERE cod_ut='".$cod_ut."'
	AND concluido='S'
	ORDER BY dat_real_teste desc, hrs_real_teste desc";

	$result = mysqli_query($ligax, $consulta);

	$nregistos = mysqli_num_rows($result);
	//echo 'N de respostas encontradas:'.$nregistos;

	echo"<center>";
	echo"<table border= '1' style='width: 60%;'> ";

		echo"<tr>";
		echo "<td style='color: yellow;'>DATA</td>";
		echo "<td style='color: yellow;'>HORAS</td>";
		echo "<td style='color: yellow;' align='center'>RESULTADO</td>";		
		//echo "<td style='color: yellow; text-align: center;'>login</td>";
		//echo "<td style='color: yellow; text-align: center;'>desc_oper</td>";
		echo"</tr>";


		for($i=0; $i <$nregistos; $i++) 
		{
			$registo = mysqli_fetch_assoc($result);

			$dat_real_teste = $registo['dat_real_teste'];
			$hrs_real_teste = $registo['hrs_real_teste'];
			$class_final = $registo['class_final'];


			echo"<tr>";
			//echo "<td><a href="."forum_respostas_adm.php?cod_top=".$cod_top.">$msg_top</td>";
			echo '<td>'.$dat_real_teste.'</td>';
			echo '<td>'.$hrs_real_teste.'</td>';
			echo "<td align='center'>".$class_final."%</td>";
			echo"</tr>";
	}

	echo"</table>";
	echo"</center>";







echo"</br>";echo"</br>";echo"</br>";

  	echo"<table>";
	echo"<tr>";
	echo"<td colspan='3' align='center'>";
  	echo "<a href='zona_jogo.php'>Voltar</a>";
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