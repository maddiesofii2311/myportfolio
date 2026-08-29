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

				<!-- Main -->
					<article id="main">
						<header>
							<h2><u>Redes Sociais - Utilizar de forma Segura</u></h2>
							<p align="center"><a href="#dest1"><b>Definição</b></p>
							<p align="center"><a href="#dest2"><b>Como instalar/compartilhar arquivos com segurança</b></p>
							<p><b>Abrir &#8595;</b></p> 
							    <ul class="actions special">
								<li><a href="https://www.youtube.com/channel/UCDoF9llATdrvYd0LiTs1Nxg"><img src="imagens/youtube.png" width="100px" height="100px"></a></li>
						</header>
						<a name="dest1"></a>
						<section class="wrapper style5">
							<div class="inner">

								<h3 style="color:Green;">Definição</h3>
								<p style="color:Blue;" align="justify">Hoje em dia as pessoas utilizam imenso as redes sociais, como Instagram por exemplo pois podemos aceder a elas em qualquer lugar desde que estejamos inseridos numa rede e que tenhamos connosco um dispositivo como smartphone, por exemplo. O grande problema das redes sociais, como com qualquer área da informática, é que podemos correr riscos se não soubermos utilizar corretamente as mesmas. Para evitar problemas e utilizar as redes sociais de uma forma segura deve-se:</p>
								<ul>
									<li style="color:Blue;" align="justify">Colocar a sua conta como privada para apenas autorizar as pessoas que queiramos que veja as nossas fotos, etc.;</li>
									<li style="color:Blue;" align="justify">Nunca aceitar pedido de amizade de pessoas estranhas;</li>
									<li style="color:Blue;" align="justify">Nunca colocar dados pessoais/confidenciais nas redes sociais;</li>
									<li style="color:Blue;" align="justify">Ter em atenção no conteúdo que colocamos nas nossas redes sociais pois a partir do mesmo em que estão publicadas nunca mais teremos controlo nas mesmas;</li>
									<li style="color:Blue;" align="justify">Sempre que existir algum problema (quer seja consigo ou com outra pessoa) deve sempre denunciar a conta da pessoa que queira mal pois isso é crime.</li>
								</ul>

								<p align="center"><img src="imagens/redessociais.jpg"></p>

								<a name="dest2"></a>
								<hr />

								<h4 style="color:Green;">Como instalar/compartilhar arquivos com segurança</h4>
								<p style="color:Blue;" align="justify">As pessoas que utilizam email, WhatsApp e/ou outras ferramentas poderão necessitar de compartilhar/instalar arquivos através das mesmas contudo, o ficheiro poderá não ser seguro e, sendo assim, poderão “cair” nas mãos erradas e ter acesso ao dispositivo.</p>
								<p style="color:Blue;" align="justify">Sempre que queiramos compartilhar arquivos com alguém, devemos utilizar sempre os serviços da nuvem como o Google Drive/OneDrive em vez de partilhar diretamente no email/WhatsApp, entre outros. Quando recebemos um ficheiro que não termos certeza se é seguro como prémios/sorteios inexistentes, por exemplo, nunca deveremos partilhar pois provavelmente será um vírus e não o deveremos espalhar para que não se torne uma pandemia.</p>
								<p style="color:Blue;">No caso de querer baixar um arquivo em segurança, deve:</p>
								<ul>
									<li style="color:Blue;" align="justify">Instalar e manter atualizado o antivírus pois assim irá saber se o ficheiro é seguro ou não enquanto o baixa;</li>
									<li style="color:Blue;" align="justify">Nunca instalar ficheiros em sites não seguros (que não tenham o protocolo HTTPS) pois poderão ter vírus ou prejudicar o seu futuro por ser algo ilegal;</li>
									<li style="color:Blue;" align="justify">No caso de receber um arquivo através do email deve confirmar de o emissor é de confiança e no caso de não ser, não deve instalar o arquivo;</li>
									<li style="color:Blue;" align="justify">Deve ter cuidado com arquivos que terminam em .exe, .scr, .bat, .com e .pif, no caso de não ter certeza se é seguro.</li>
								</ul>

								<p align="center"><img src="imagens/redesociais.jpg"></p>

								
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