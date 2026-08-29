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
											<li><a href="sredeswifi_log.php">Segurança Redes Wi-Fi</a></li>
											<li><a href="navegars_log.php">Navegue em Segurança</a></li>
											<li><a href="problemasi_log.php">Problemas existentes na internet</a></li>
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

				<!-- Main -->
					<article id="main">
						<header>
							<h2><u>O que é Segurança na Internet?</u></h2>
                                <p align="center"><a href="#dest1"><b>Definição</b></p>
                                <p align="center"><a href="#dest2"><b>Principais riscos da Internet</b></p>
                                <p align="center"><a href="#dest3"><b>Como evitar problemas na Internet</b></p>
                                <p align="center"><a href="#dest4"><b>Conselhos para possuir segurança na internet</b></p>
                                <p><b>Abrir &#8595;</b></p> 
							    <ul class="actions special">
								<li><a href="https://www.youtube.com/channel/UCDoF9llATdrvYd0LiTs1Nxg"><img src="imagens/youtube.png" width="100px" height="100px"></a></li>
						</header>
						<a name="dest1"></a>
						<section class="wrapper style5">
							<div class="inner">

								<h3 style="color:Green;">Definição</h3>
								<p style="color:Blue;" align="justify">A Segurança na Internet são todos os cuidados que devemos ter para proteger os elementos que fazem parte da internet (Redes Sociais em geral) onde se obtem informações pessoais facilitadamente, que sem proteção haverá maior “ataque” pelos cibercriminosos (hackers). A segurança informática é responsável pela criação de métodos, procedimentos e normas que conseguem identificar e eliminar as vulnerabilidades das informações e equipamentos físicos, como computadores, telemóveis, etc. Esta segurança conta com bases de dados, arquivos e aparelhos que fazem com que informações importantes não caiam em mãos de pessoas erradas.</p>

								<p align="center"><img src="imagens/definicao.jpg"></p>

								<a name="dest2"></a>
								<hr />

								<h4 style="color:Green;">Principais riscos da Internet</h4>
								<p style="color:Blue;">Normalmente, os cibercriminosos tentam:</p>
								<ul>
									<li style="color:Blue;">Roubar informações;</li>
									<li style="color:Blue;">Corromper informações;</li>
									<li style="color:Blue;">Atacar sistemas ou equipamentos;</li>
									<li style="color:Blue;">Roubar identidade;</li>
									<li style="color:Blue;">Vender dados pessoais;</li>
									<li style="color:Blue;">Roubar dinheiro.</li>
								</ul>

								<p style="color:Blue;" align="justify">Os criminosos cibernéticos usam várias formas para atacar uma vítima na rede, como vírus, por exemplo, no qual tentam romper sistemas e alterar o funcionamento dos aparelhos eletrónicos. Outra modalidade é o phishing, onde o cibercriminoso se faz passar por uma pessoa diferente através de e-mails, mensagens instantâneas ou nas redes sociais, para conseguir informações confidenciais, como senhas, números de cartões de crédito, e outros.</p>

								<p align="center"><img src="imagens/riscosinternet.jpg"></p>

								<a name="dest3"></a>
								<hr />

								<h4 style="color:Green;">Como evitar problemas na Internet</h4>
								<p style="color:Blue;">Para as pessoas que lidam com informações confidenciais e possuem vários equipamentos, como nas empresas, devem solicitar ajuda de profissionais que trabalham com segurança na internet.</p>
								<p style="color:Blue;">Para utilizadores comuns, podemos adotar várias medidas como:</p> 
								<ul>
									<li style="color:Blue;">Manter ativos e atualizados os antivírus nos aparelhos que acedem à Internet;</li>
									<li style="color:Blue;">Evitar fazer transações financeiras em redes abertas ou em computadores públicos;</li>
									<li style="color:Blue;">Verificar os arquivos anexos de mensagens de estranhos, evitando baixá-los se não tiver certeza do seu conteúdo.</li>
								</ul>

								<p align="center"><img src="imagens/evitar.jpg"></p>

								<a name="dest4"></a>
								<hr />

								<h4 style="color:Green;">Conselhos para possuir segurança na internet</h4>
								<p style="color:Blue;">Para qualquer pessoa que utilize internet ter segurança na mesma, deve:</p>
								<ul>
									<li style="color:Blue;">Sempre clicar em “Logout”/”Sair” quando pretende sair de uma rede social, por exemplo;</li>
									<li style="color:Blue;">Criar senhas difíceis de ser descobertas;</li>
									<li style="color:Blue;">Apenas utilizar navegadores atualizados com o momento;</li>
									<li style="color:Blue;">Instalar/Atualizar sempre o seu antivírus;</li>
									<li style="color:Blue;">Ter cuidado com downloads de ficheiros seja em sites, emails, etc.;</li>
									<li style="color:Blue;">Evitar softwares piratas;</li>
									<li style="color:Blue;">Ter cuidado com mensagem de WhatsApp, por exemplo, com links incluídos;</li>
									<li style="color:Blue;">Não acreditar em mensagens/emails falsos;</li>
									<li style="color:Blue;">Evitar sites não seguros;</li>
									<li style="color:Blue;">Ter cuidado ao fazer compras online e na utilização de sites de bancos;</li>
									<li style="color:Blue;">Nunca responder a ameaças, provocações ou intimidações e informar a polícia;</li>
									<li style="color:Blue;">Nunca revelar informações pessoais/confidenciais na internet;</li>
									<li style="color:Blue;">Ter cuidado ao criar uma conta online;</li>
									<li style="color:Blue;">Ter em atenção que as redes Wi-Fi públicas podem ser perigosas.</li>
								</ul>

								<p align="center"><img src="imagens/consegint.jpg"></p>

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