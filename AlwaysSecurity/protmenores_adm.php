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
											<li><a href="adm_pagina_principal.php">Área Administradora</a></li>
											<li><a href="adm_index.php">Início</a></li>
											<li><a href="definicaosi_adm.php">O que é Segurança na Internet</a></li>
											<li><a href="sredeswifi_adm.php">Segurança Redes Wi-Fi</a></li>
											<li><a href="navegars_adm.php">Navegue em Segurança</a></li>
											<li><a href="problemasi_adm.php">Problemas existentes na Internet</a></li>
											<li><a href="transcompweb_adm.php">Transferências Financeiras e Compras Online</a></li>
											<li><a href="redessociaiss_adm.php">Redes Sociais - Utilizar de forma Segura</a></li>
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

				<!-- Main -->
					<article id="main">
						<header>
							<h2><u>Proteção de menores de idade</u></h2>
							<p align="center"><a href="#dest1"><b>Definição</b></a></p>
							<p align="center"><a href="#dest2"><b>5 dicas para menores de idade navegarem na Internet em segurança</b></a></p>
							<p><b>Abrir &#8595;</b></p> 
							    <ul class="actions special">
								<li><a href="https://www.youtube.com/channel/UCDoF9llATdrvYd0LiTs1Nxg"><img src="imagens/youtube.png" width="100px" height="100px"></a></li>
						</header>
						<a name="dest1"></a>
						<section class="wrapper style5">
							<div class="inner">

								<h3 style="color:Green;">Definição</h3>
								<p style="color:Blue;" align="justify">As crianças, infelizmente, são normalmente as principais vítimas dos cibercriminosos por não conhecer bem o mundo da internet e nem sequer saberem da existência da segurança na internet. Porém, os adolescentes também costumam ser vítimas de cibercriminosos. Os adultos encarregues dos seus menores devem demonstrar como navegar em segurança na internet, nas redes sociais, etc. Para isso, os adultos devem:</p>
								<ul>
									<li style="color:Blue;" align="justify">Explicar a importância de não partilhar informação pessoal como idade, morada, número de telemóvel em qualquer lugar da internet (explicar sobre a sua privacidade);</li>
									<li style="color:Blue;" align="justify">Explicar como defender-se de ameaças;</li>
									<li style="color:Blue;" align="justify">Ensinar a criar senhas seguras paras as suas redes sociais, por exemplo;</li>
									<li style="color:Blue;" align="justify">Explicar os géneros existentes de problemas ilegais que existem na internet como o cyberbullying e explicar que não deve expor conteúdos seus sem pensar para que não exista problemas futuramente;</li>
									<li style="color:Blue;" align="justify">Demonstrar a importância de não confiar em estranhos/pessoas conhecidas apenas na internet pois existem pessoas que têm intenções maliciosas na utilização da internet;</li>
									<li style="color:Blue;" align="justify">Não permitir que instale conteúdo ilegal (principalmente se o site não conter o protocolo HTTPS) e explicar as suas consequências;</li>
									<li style="color:Blue;" align="justify">Alertar que devem ter cuidado quando acedem a links de sites como com ficheiros instalados e explicar a sua importância.</li>
								</ul>
								<p style="color:Blue;" align="justify">No caso das crianças, existe nos dias de hoje uma proteção para as mesmas que poderá selecionar nos dispositivos chamado controlo parental, onde as crianças não irão ter acesso a todo o conteúdo existente na internet e no caso de fazerem algo como entrar numa rede social, o adulto receberá um email a informar o mesmo, no caso de fornecer o seu email.</p>

								<p align="center"><img src="imagens/webmenida.jpg"></p>
								
								<a name="dest2"></a>
								<hr />
								

								<h4 style="color:Green;">5 dicas para menores de idade navegarem na Internet em segurança</h4>
								<p style="color:Blue;" align="justify">Para os menores de idade que navegam na internet, para que não sejam alvos de ameaças, sexting, cyberbulling, grooming, stalking, entre outros devem em atenção os seguintes conselhos:</p>
								<ol>
									<li style="color:Blue;" align="justify">Nunca partilhar conteúdo íntimo em nenhum lugar da internet e com ninguém por mensagem. No caso de pedirem esse género de conteúdo deve alertar no momento os seus educandos para que os mesmos tomem as medidas necessárias;</li>
									<li style="color:Blue;" align="justify">Nunca fornecer as suas senhas com ninguém;</li>
									<li style="color:Blue;" align="justify">Nunca fornecer para a internet/pessoas as suas informações pessoais/confidenciais;</li>
									<li style="color:Blue;" align="justify">Nunca fazer compras online sem o conhecimento dos seus educandos;</li>
									<li style="color:Blue;" align="justify">Nunca aceitar pedido de amizade de estranhos nas redes socias e nunca se encontre com pessoas que conheceu apenas pela internet;</li>
								</ol>

								<p align="center"><img src="imagens/teenweb.jpg"></p>

								
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