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

				<!-- Main -->
					<article id="main">
						<header>
							<h2><u>Navegue em Segurança</u></h2>
								<p align="center"><a href="#dest1"><b>Definição</b></p>
                                <p align="center"><a href="#dest2"><b>Ferramentas para uma navegação segura</b></p>
                                <p align="center"><a href="#dest3"><b>7 dicas para navegar em segurança</b></p>
                                <p><b>Abrir &#8595;</b></p> 
							    <ul class="actions special">
								<li><a href="https://www.youtube.com/channel/UCDoF9llATdrvYd0LiTs1Nxg"><img src="imagens/youtube.png" width="100px" height="100px"></a></li>
						</header>
						<a name="dest1"></a>
						<section class="wrapper style5">
							<div class="inner">

								<h3 style="color:Green;">Definição</h3>
								<p style="color:Blue;" align="justify">Nos dias de hoje, é habitual os utilizadores de tecnologia navegarem na internet através de um navegador (Chrome, Firefox, etc.) onde acedem a sites de seu interesse. Contudo, nem todos os sites são seguros de navegar. Para navegar em segurança deve:</p>
								<ul>
									<li style="color:Blue;" align="justify">Atualizar o navegador na maioria da vezes pois os vírus estão sempre em circulação na internet e assim sendo é necessária possuir sempre a versão mais atualizada do navegador;</li>
									<li style="color:Blue;" align="justify">Ter cuidado com softwares livres e donwloads ilegais na rede pois o equipamento fica em risco pelas informações guardadas nele, para além de ser um crime;</li>
									<li style="color:Blue;" align="justify">Criar duplos emails (um principal e outro secundário) sendo que o secundário servirá para receber informações de problemas do email principal (necessita de associar uma conta à outra) para saber sempre que género de problema existe para resolver;</li>
									<li style="color:Blue;" align="justify">Ter atenção se os sites onde navega possuem o protocolo HTTPS pois este é uma das provas da segurança do site e da navegação do utilizador.</li>
								</ul>

								<p align="center"><img src="imagens/navseg.jpg"></p>

								<a name="dest2"></a>
								<hr />

								<h4 style="color:Green;">Ferramentas para uma navegação segura</h4>
								<ul>
									<li style="color:Blue;" align="justify"><b>Gestão de Palavras Passe</b> – existe softwares de encriptação que mantêm guardadas as palavras passe e com capacidade de gerir as mesmas (deve mudar regularmente as palavras passe de serviços mais sérios como banco e nunca utilizar a mesma palavra passe para diferentes contas). O sistema KeePass, verificado pela União Europeia, é um exemplo de software que guarda e gere as palavras passe que atualiza constantemente. É um programa gratuito, disponível para qualquer dispositivo e é “open-source” (qualquer pessoa com conhecimentos na área pode trabalhar com este sistema que diminuirá vulnerabilidades). Pode também aplicar a dupla autenticação (necessita de colocar a palavra passe e confirmar o acesso através de uma senha enviada por mensagem);</li>
									<li style="color:Blue;" align="justify"><b>Antivírus e Firewall</b> – qualquer pessoa que utilize tecnologia (portátil, smartphone, etc.) deve possuir no mesmo um antivírus e um firewall, sempre ativos, pois estes detetam ameaças quer seja de um website ou de uma aplicação/programa. Normalmente, os sistemas operativos possuem á partida firewall contudo, não possuem antivírus. Um antivírus gratuito conhecido é o Avast que corresponde ao pretendido;</li>
									<li style="color:Blue;" align="justify"><b>Atualizações do Sistema Operativo</b> – quando possuímos um dispositivo, devemos atualizar sempre que possível o sistema operativos pois o mesmo impedirá imensos problemas, como por exemplo os “bugs”;</li>
									<li style="color:Blue;" align="justify"><b>Rede VPN</b> – A VPN (rede privada virtual) é um protocolo que protege os dados de um dispositivo através de encriptação que impede hackers a aceder aos seus dispositivos sem autorização, quando está conectado à internet. Assim sendo, é importante que o utilize quando acede à internet através de redes públicas/desprotegidas.</li>
								</ul>

								<p align="center"><img src="imagens/fernavseg.jpg"></p>

								<a name="dest3"></a>
								<hr />

								<h4 style="color:Green;">7 dicas para navegar em segurança</h4>

								<ol>
									<li style="color:Blue;">Evite divulgar informações na Internet;</li>
									<li style="color:Blue;">Ter cuidado ao aceder nas contas bancárias na Internet;</li>
									<li style="color:Blue;">Não instalar aplicações piratas no seu computador;</li>
									<li style="color:Blue;">Ter atenção ao utilizar o seu cartão de crédito em compras online;</li>
									<li style="color:Blue;">Ter cuidado com downloads de arquivos;</li>
									<li style="color:Blue;">Evitar anúncios duvidosos;</li>
									<li style="color:Blue;">Ter atenção com os emails falsos.</li>
								</ol>

								<p style="color:Blue;">Se quiser mais dicas para navegar em segurança na internet<a href="https://www.infowester.com/dicaseguranca.php"> clique aqui</a>.</p>

								<p align="center"><img src="imagens/7dnavseg.jpg"></p>

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