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

$cod_top=$_GET['cod_top'];


//consultar msg de tópico




	$ligax = mysqli_connect('localhost', 'root', '');

	if (!$ligax) {echo '<p> Falha na Ligação.'; exit;}

	mysqli_select_db($ligax, 'asecurity_bd');


	$consulta = "select * From UTILIZADORES, TOPICOS WHERE UTILIZADORES.cod_ut= TOPICOS.cod_ut_top
	AND TOPICOS.cod_top='".$cod_top."'";
	
	$result = mysqli_query($ligax, $consulta);

	$nregistos = mysqli_num_rows($result);
	echo"<br/>";
	echo"<center>";
	//echo 'Nº de registos encontrados: '.$nregistos;

	echo"<table border= '1' style='width: 60%;'> ";

		echo"<tr>";
		echo '<td>Tópico</td>';
		echo '<td>Data</td>'; 
		echo '<td>Autor</td>';
		echo"</tr>";



	for($i=0; $i <$nregistos; $i++) 
	{
		$registo = mysqli_fetch_assoc($result);

		$login_top = $registo['login'];
		$cod_top = $registo['cod_top'];
		//$cod_ut_top = $registo['cod_ut_top'];
		$dat_top = $registo['dat_top'];
		$msg_top = $registo['msg_top'];

		
		echo"<tr>";
		echo "<td><a href="."forum_respostas_adm.php?cod_top=".$cod_top.">$msg_top</td>";
		echo '<td>'.$dat_top.'</td>'; 
		echo '<td>'.$login_top.'</td>';
		echo"</tr>";
	
		
  	}

  	echo"</table>";



//consultar agora as respostas para o tópico escolhido



	$consulta = "select * From UTILIZADORES, COMUNICACOES WHERE UTILIZADORES.cod_ut= COMUNICACOES.cod_ut_resp 
	AND COMUNICACOES.cod_top='".$cod_top."'";
	
	$result = mysqli_query($ligax, $consulta);

	$nregistos = mysqli_num_rows($result);

	//echo 'Nº de registos encontrados: '.$nregistos;



// se não há respostas e o tópico pertence à conta logada
// possibilitar eliminar


  
  echo "<table style='width: 60%;'>";
  echo "<tr>";
  echo "<td align='center'>";
  echo"<a href='forum_remover_topico_adm.php?cod_top=".$cod_top."' class='button small' style='align: right;'>remover tópico</a>";
  echo "</td>";	
  echo "</tr>";
  echo "</table>";


	echo"<br/>";

	echo"<table border= '1' style='width: 60%;'> ";

		echo"<tr>";
		echo '<td>Respostas</td>';
		echo '<td>Data Hora</td>'; 
		echo '<td>Autor</td>';
		echo"</tr>";



	for($i=0; $i <$nregistos; $i++) 
	{
		$registo = mysqli_fetch_assoc($result);

		$login_resp = $registo['login'];
	$bloq_fom = $registo['bloq_fom'];
		$cod_com = $registo['cod_com'];
		$cod_top = $registo['cod_top'];
		$cod_ut_resp = $registo['cod_ut_resp'];
		$dat_com = $registo['dat_com'];
		$hrs_com = $registo['hrs_com'];
		$msg_com = $registo['msg_com'];

		$data_horas = $dat_com." ".$hrs_com;

		echo"<tr>";
		echo '<td>'.$msg_com.'</td>';
		echo '<td>'.$data_horas.'</td>'; 
		echo '<td>'.$login_resp.'</td>';


		if($bloq_fom == 'S')
		{
		  echo "<td style='color: red; text-align: center;'>Bloqueado</td>";
		   
		   		 
/*
		  echo "<td> 
		  <input type='submit' value= 'Bloqueado' style='color: red;'> 
		   </td>";
*/
		}
		else
		{
		  echo "<td> 
		  <input type='submit' value= 'Bloquear' 
		  onclick="."location.href='adm_area_bloq_ut_forum_resposta_confirmacao.php?login_resposta=".
		  $login_resp."&cod_top=".$cod_top."';"."> </td>";

		}







		echo"</tr>";
// se resposta pertencer à conta logada permitir remover

		  echo"<tr>";
  		  echo "<td colspan='3' align='right'>";
  		  echo"<a href='forum_remover_resposta_adm.php?cod_com=".$cod_com."&cod_top=".$cod_top."' class='button small' style='align: right;'>remover resposta</a>";
  		  echo "</td>";	
		  echo"</tr>";


		
	
		
  	}



  	echo"</table>";


//<input type="hidden" id="custId" name="custId" value="3487">
//		echo"<form action="."forum_nova_resposta.php?cod_top=".$cod_top."method='post'>";
echo"<form action='forum_nova_resposta_adm.php' method='post'>";


?>

		<input type="hidden" name="cod_top" value="<?php echo $cod_top ?>">
		<center>
			<table border= "1" style="width:50%">
				<tr>
					<td><textarea name="msg_com" placeholder="Mensagem de Resposta" rows="2"></textarea></td>        
		      	</tr>	
		      					
				<tr>
			   		<td colspan="2" align="center">
			      		<input type="submit" value="Responder">
		           	</td>
		      	</tr>
			</table>
		</center>
		</form>





<?php


echo"</center>";



  	echo"<table>";
	echo"<tr>";
	echo"<td colspan='3' align='center'>";
  	echo "<a href='forum_topicos_adm.php'>Voltar</a>";
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