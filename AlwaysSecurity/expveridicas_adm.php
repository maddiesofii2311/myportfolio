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
						<h1><a href="adm_index.php">Always Security</a></h1>
						<p align="center" style="color:Yellow; font-weight: bolder;"><?php echo "Olá ".$login."!"; ?></p>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="adm_pagina_principal">Área Administradora</a></li>
											<li><a href="adm_index.php">Início</a></li>
											<li><a href="definicaosi_adm.php">O que é Segurança na Internet</a></li>
											<li><a href="sredeswifi_adm.php">Segurança Redes Wi-Fi</a></li>
											<li><a href="navegars_adm.php">Navegue em Segurança</a></li>
											<li><a href="problemasi_adm.php">Problemas existentes na Internet</a></li>
											<li><a href="transcompweb_adm.php">Transferências Financeiras e Compras Online</a></li>
											<li><a href="redessociaiss_adm.php">Redes Sociais - Utilizar de forma Segura</a></li>
											<li><a href="protmenores_adm.php">Proteção de menores de idade</a></li>
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

				<!-- Main -->
					<article id="main">
						<header>
							<h2><u>Experiências Verídicas</u></h2>
							<p align="center"><a href="#dest1"><b>1º História</b></p>
                            <p align="center"><a href="expveridicas2_adm.php"><b>2º História</b></a></p>
                            <p align="center"><a href="expveridicas3_adm.php"><b>3º História</b></a></p>
                            <p align="center"><a href="expveridicas4_adm.php"><b>4º História</b></a></p>
						</header>
						<a name="dest1"></a>
						<section class="wrapper style5">
							<div class="inner">

								<h3 style="color:Green;" align="center">1º História - Vítima de Phishing e Smishing</h3>
								<p style="color:Blue;" align="justify">"Estava num dia normal de trabalho quando recebo uma mensagem inesperada da Millennium (pensava eu) onde me informava que necessitava de abrir um link para evitar uma multa de 59€ (primeira imagem representada abaixo). Como achei aquela situação estranha, não abri o link e compareci no banco da Millennium da minha cidade e relatei a situação. De seguida o senhor respondável pelo banco informou-me que aquela mensagem não foi enviada por eles. Assim sendo, decidi dirigir-me á polícia da minha cidade e relatar a situação para fazer uma queixa. Antes de me dirigir á polícia, decidi pesquisar um pouco sobre segurança na internet pois queria saber o que estava a acontecer e apercebi-me que tinha sido vítima de phishing. Quando apresentei queixa, pensei que me fossem confiscar o telemóvel para perceber o endereço IP de onde aquela mensagem foi enviada contudo, a polícia apenas me pediu para relatar a história para escreverem no depoimento, onde fiz questão de informar que seria vítima de phishing sendo que o senhor que me entendeu demostrou-me não perceber sobre segurança na internet. Foi-me entregue uma cópia desse ficheiro (segunda imagem representada abaixo). Até hoje não se descobriu quem estava por trás daquela mensagem."</p>
								<p style="color:Blue;" align="justify">Este história relaciona dois crimes pois, para além de existir <u>phishing</u> (por o hacker passar-se por uma identidade para recolher informação confidencial), existe também <u>smishing</u> pois o modo que o hacker utilizou para recolher informação foi através de uma hiperligação para uma aplicação de texto (neste caso para a aplicação mensagens que vem incorporada com o telemóvel).</p>

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
                            		<img src="imagens/exp1_img1.jpg" width="800px" height="600px">  
                            		<br /><br />
                            	</div>  
                            	<div class="carousel-item">
                            		<img src="imagens/exp1_img2.jpg" width="1050px" height="600px">
                            		<br /><br />
                            	</td></tr>
            					</table>
                            	</div>
                            	<p style="color:Blue;" align="center">Clique no botão abaixo para ler a próxima história verídica!</p>
                    			<p align="center"><a href="expveridicas2_adm.php" class="button primary">Avançar</a></p>
                        		</div>
                    			</div>		
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