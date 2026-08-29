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
		
		
	if($tipo_ut=="adm") header("Location: adm_pagina_principal.php");

?>

<!DOCTYPE HTML>
<html lang="pt-pt">
	<head>
		<title>Always Security</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

	<iframe src="imagens/silence.mp3" allow="autoplay" id="audio" style="display: none"></iframe>

	<audio  autoplay="autoplay" loop preload="preload">
		<source src="imagens/musica.wav" type="audio/wav">
	</audio>
	
		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="pagina_principal.php">Always Security</a></h1>
						<p align="center" style="color:Yellow; font-weight: bolder;"><?php echo "Olá ".$login."!"; ?></p>
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

				<!-- Main -->
					<article id="main">
						<header>
							<h2><u>Experiências Verídicas</u></h2>
							<p align="center"><a href="expveridicas_log.php"><b>1º História</b></p>
                            <p align="center"><a href="expveridicas2_log.php"><b>2º História</b></a></p>
                            <p align="center"><a href="expveridicas3_log.php"><b>3º História</b></a></p>
                            <p align="center"><a href="#dest1"><b>4º História</b></a></p>
						</header>
						<a name="dest1"></a>
						<section class="wrapper style5">
							<div class="inner">

								<h3 style="color:Green;" align="center">4º História - Publicidade Enganosa</h3>
								<p style="color:Blue;" align="justify">"Muitas vezes quando vou visitar alguns sites menos seguros (como sites de receitas ou notícias), estes algumas vezes tem hiperligações que, ao clicar nos mesmos, levam-nos para outros sites maliciosos como este, por exemplo, que fez uma ligação com uma página que insinua ter ganho um dispositivo da marca Apple da operadora MEO."</p>
								<p style="color:Blue;" align="justify">Este história demonstra a insegurança existente em websites onde permitem assim a colocação de publicidade enganosa que, no caso de o utilizador acreditar, poderá colocar o seu dispositivo em risco, quer a nível de vírus, trojans, etc. como também o acesso ao mesmo com possibilidade de roubo de informações/ficheiros confidenciais. Neste exemplo, se observarmos bem as imagens (encontram-se abaixo) verificamos que quando representa a data do dia em que acedeu à publicidade enganosa, deveria aparecer no mês "Março" em vez de "Marte". Por vezes os utilizadores não têm em conta nestes pequenos erros contudo, é o suficiente para perceber que se trata de uma publicidade enganosa.</p>

								<div id="demo" class="carousel slide" data-ride="carousel">
								<table width="100%">
								<tr><td align="center" bgcolor="white">
          						<ul class="carousel-indicators ">
            						<li data-target="#demo" data-slide-to="0" class="active"></li>
            						<li data-target="#demo" data-slide-to="1"></li>
            					</ul>
            					<div class="carousel-inner"> 

            					<a class="carousel-control-prev" href="#demo" data-slide="prev">
            					<span class="carousel-control-prev-icon"></span>
          						</a>
          						<a class="carousel-control-next" href="#demo" data-slide="next">
            					<span class="carousel-control-next-icon"></span>
          						</a>

            					<div class="carousel-item active">
                            		<img src="imagens/exp4_img1.png" width="1050px" height="600px">  
                            		<br /><br />
                            	</div>  
                            	<div class="carousel-item">
                            		<img src="imagens/exp4_img2.png" width="1050px" height="600px">
                            		<br /><br />
                            	</td></tr>
            					</table>
                            	</div>

								<p style="color:Blue;" align="center">Clique no botão abaixo para anteceder de página!</p>
                            	<ul class="actions special" align="center">
                    				<li><a href="expveridicas3_log.php" class="button primary">Anteceder</a></li>
                    			</ul>

							</div>
						</section>
					</article>

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