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
											<li><a href="forum_topicos_adm.php">Fórum</a></li>
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


<h2>LISTA DE CONTAS BLOQUEADAS</h2>



<?php
	$ligax = mysqli_connect('localhost', 'root', '');

	if (!$ligax) {echo '<p> Falha na Ligação.'; exit;}

	mysqli_select_db($ligax, 'asecurity_bd');

	$consulta = "select * From UTILIZADORES WHERE bloq_fom='S' 
	ORDER BY login asc";
		
	$result = mysqli_query($ligax, $consulta);

	$nregistos = mysqli_num_rows($result);
	echo"<br/>";
	echo"<center>";
	//echo 'Nº de registos encontrados: '.$nregistos;

	echo"<table border= '1' style='width: 60%;'> ";

		echo"<tr>";
		echo "<td style='color: yellow;'>cod_ut</td>";
		echo "<td style='color: yellow;'>login</td>"; 		
		//echo "<td style='color: red; text-align: center;'>bloqueadas</td>";
		//echo "<td style='color: green; text-align: center;'>desbloqueadas</td>";
		echo"</tr>";



	for($i=0; $i <$nregistos; $i++) 
	{
		$registo = mysqli_fetch_assoc($result);

		$cod_ut_consultado = $registo['cod_ut'];
		$login_consultado = $registo['login'];
		$bloq_fom_consultado = $registo['bloq_fom'];
		//$cod_top = $registo['cod_top'];
		//$cod_ut_top = $registo['cod_ut_top'];
		//$dat_top = $registo['dat_top'];
		//$msg_top = $registo['msg_top'];

		
		echo"<tr>";
		echo '<td>'.$cod_ut_consultado.'</td>';


		 
		
		if($bloq_fom_consultado == 'S')
		{
			echo "<td style='color: red;'>".$login_consultado."</td>";
/*
		  echo "<td style='color: red; text-align: center;'>Bloqueado</td>";

		  echo "<td style='text-align: center;'> 
		  <input type='submit' value= 'Desbloquear'  
		  onclick="."location.href='adm_area_desbloq_ut_confirmacao.php?login_desbloq=".
		  $login_consultado."';"."> </td>";
*/
		   		 
/*
		  echo "<td> 
		  <input type='submit' value= 'Bloqueado' style='color: red;'> 
		   </td>";
*/
		}
/*		else
		{
			echo "<td style='color: green;'>".$login_consultado."</td>";

		  echo "<td style='text-align: center;'> 
		  <input type='submit' value= 'Bloquear' 
		  onclick="."location.href='adm_area_bloq_ut_confirmacao.php?login_bloq=".
		  $login_consultado."';"."> </td>";

		  echo "<td style='color: green; text-align: center;'>Desbloqueado</td>";



		}
*/
		echo"</tr>";
	
		
  	}


  	echo"</table>";


echo"</center>";

  	echo"<table>";
	echo"<tr>";
	echo"<td colspan='3' align='center'>";
  	echo "<a href='adm_area_bloqs.php'>Voltar</a>";
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