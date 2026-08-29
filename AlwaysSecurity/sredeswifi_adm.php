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

				<!-- Main -->
					<article id="main">
						<header>
							<h2><u>Segurança - Redes Wi-Fi</u></h2>
                                <p align="center"><a href="#dest1"><b>Definição</b></p>
                                <p align="center"><a href="#dest2"><b>Géneros de conexões Wi-Fi</b></p>
                                <p align="center"><a href="#dest3"><b>Como prevenir problemas no router, rede e dispositivos</b></p>
                                <p align="center"><a href="#dest4"><b>Segurança em aparelhos móveis</b></p>
                                <p><b>Abrir &#8595;</b></p> 
							    <ul class="actions special">
								<li><a href="https://www.youtube.com/channel/UCDoF9llATdrvYd0LiTs1Nxg"><img src="imagens/youtube.png" width="100px" height="100px"></a></li>
						</header>
						<a name="dest1"></a>
						<section class="wrapper style5">
							<div class="inner">

								<h3 style="color:Green;">Definição</h3>
								<p style="color:Blue;" align="justify">As redes Wi-Fi são, nos dias de hoje, as mais utilizadas pelo mundo inteiro pelo crescimento da tecnologia: sem necessidade de conexão por fio. Assim sendo, as pessoas vão a cafés, restaurantes, centros comerciais, entre outros, e têm a possibilidade de aceder à rede com os seus smartphones/notebooks por um router para verificar um email por exemplo. Todavia, quando nos conectamos a uma rede Wi-Fi, nunca pensamos na sua segurança, algo importante pois, no caso de conectarmo-nos nua rede Wi-Fi insegura, poderá existir o roubo de arquivos pessoais, senhas, etc. </p>

								<p align="center"><img src="imagens/redeswifi.png"></p>

								<a name="dest2"></a>
								<hr />

								<h4 style="color:Green;">Géneros de conexões Wi-Fi</h4>
								<h6 style="color:Blue;">Conexão em casa</h6>
								<p style="color:Blue;" align="justify">Para além de este género de conexão poder ser das mais seguras, estas precisam de ter as configurações de segurança corretas pois, caso contrário, permitirá o acesso à rede a pessoas estranhas. Mesmo que as intenções de alguém estranho não sejam mais quando acede à rede (apenas utilizar para ter acesso gratuito à internet) estará a afetar o consumo, ou seja, dependendo do pagamento da pessoa pela sua rede com a sua capacidade, nunca a terá completa e gastará muito mais rapidamente o que, no caso de não ser ilimitada, poderá ficar sem rede facilmente. Contudo, se as intenções de alguém estranho com acesso à rede forem negativas, o mesmo poderá roubar informações com fins criminosos.</p>
								<p style="color:Blue;" align="justify">Para a conexão de casa ser segura, deve primeiramente colocar uma senha para o acesso à mesma (recomenda-se o género de criptografia WPA2 por ser mais segura que o WPA, WEP e TKIP, no qual será mais complicado de alguém conseguir aceder à rede sem palavra passe). Seguidamente e último, deve configurar o router pelo protocolo HTTPS para impedir roubo de senha e a visualização do nome identificativo à rede para que pessoas de fora não vejam quando procuram uma conexão com a rede. No caso de não saber configurar a rede, deve entrar em contacto com o provedor de rede para que o ajude a configurar.</p>

								<p align="center"><img src="imagens/wificasa.jpg"></p>

								<h6 style="color:Blue;">Conexões Wi-Fi privadas</h6>

								<p style="color:Blue;" align="justify">As conexões privadas são por exemplo as conexões à rede em casa de amigos/familiares, onde necessitamos de pedir a senha para aceder à mesma. Devemos ter em atenção se essa rede que queremos aceder está segura pois existe a possibilidade de não estar.</p>
								<p style="color:Blue;" align="justify">No caso de aceder a uma rede privada, deve confirmar se a mesma está configurada com a criptografia WPA/WPA2 por serem as mais seguras. No caso se suspeitar de algo, não deve conectar-se a essa rede e deve comunicar com o seu amigo/familiar para que resolva o problema.</p>

								<p align="center"><img src="imagens/wifiprivado.jpg"></p>

								<h6 style="color:Blue;">Conexões Wi-Fi públicas</h6>

								<p style="color:Blue;" align="justify">As conexões públicas são normalmente as conexões menos seguras pois qualquer pessoa poderá aceder a essa rede e, infelizmente, nem todas as pessoas tem as boas intenções quando a usam.</p>
								<p style="color:Blue;" align="justify">Nas situações em que necessitar de aceder a uma rede pública, deve selecionar Rede pública quando o dispositivo perguntar o género de conexão pois assim a segurança que o aparelho terá será maior. Se aceder a um site, deve verificar que o mesmo contém o protocolo HTTPS para o seu seguro. Não deve aceder a sites onde necessita de colocar senhas como redes socias por exemplo quando está conectado a uma rede pública.</p>

								<p align="center"><img src="imagens/wifipublico.jpg"></p>

								<a name="dest3"></a>
								<hr />

								<h4 style="color:Green;">Como prevenir problemas no router, rede e dispositivos</h4>
								<p style="color:Blue;" align="justify">Após retratar os géneros de conexões de Wi-fi, podemos concluir que devemos proteger o nosso router, rede e, consecutivamente, os nossos dispositivos. Para isso, devemos:</p>
								<ul>
									<li style="color:Blue;" align="justify">Nunca utilizar <u>palavras passe iguais</u> para a <b>administração do router</b> e para o <b>acesso à rede Wi-Fi</b> pois, caso contrário, o router e a rede não estarão seguras pois se as palavras passe fossem as mesmas, qualquer pessoa teria acesso à administração do router (nem todas as pessoas sabem gerir um router/rede para estabelecer segura). Seria também uma facilidade de acesso para um hacker sendo que já possuía a palavra passe sem qualquer género de roubo;</li>
									<li style="color:Blue;" align="justify">Deve <u>desativar</u> no router o protocolo <b>WPS (Wi-Fi Protected Setup)</b> pois este facilita ligações protegidas de um router para outros dispositivos, ou seja, o router partilha a palavra passe com o dispositivo e, assim sendo, o utilizador/hacker não necessita de colocar qualquer palavra passe. Posto isto, podemos concluir que este protocolo não deve estar ativado pela segurança do nosso router/rede;</li>
									<li style="color:Blue;" align="justify">Deve <u>ativar</u> o <b>MAC Address</b> (idenficação de cada router, diferente do endereço IP por ser uma identificação única sendo que o endereço IP é uma identificação de uma região) pois o mesmo aumenta a segurança de uma rede sem fios uma vez que possuir apenas a palavra passe da rede não será suficiente, necessitando também da identificação do MAC Address. A única desvantagem do MAC Address é que sempre que um dispositivo queira conectar-se à rede, necessita de ir à administração do router e autorizar o mesmo equipamento a aceder;</li>
									<li style="color:Blue;" align="justify">Deve sempre <u>atualizar</u> o <b>firmware</b> do <b>router</b> (sistema operativo de um router), assim como os <b>sistemas operativos</b> dos <b>dispositivos</b> (portáteis, smartphone, etc.) para proteger os mesmos equipamentos de uma ligação à rede e proteção de hackers (no caso dos routers);</li>
									<li style="color:Blue;" align="justify">No caso de estar <u>indeciso</u> entre <u>ligações da rede por cabo</u> ou <u>sem fios</u>, deve sempre <u>preferir</u> as <b>ligações por cabo</b> pois são mais seguras, sendo que nas redes Wi-Fi existem imensas ferramentas de decodificação. Apenas deve utilizar ligações sem fio no caso de não existir nenhuma possibilidade de optar por ligações por cabo, como nos smartphones;</li>
									<li style="color:Blue;" align="justify">Sempre que <u>não utiliza a rede Wi-Fi</u>, deve sempre <b>desligar o router</b> para que nenhum hacker consiga entrar na administração do router ou na rede sem a sua autorização/controlo;</li>
									<li style="color:Blue;" align="justify">Deve sempre <u>utilizar</u> uma <b>VPN (rede privada virtual)</b> (protocolo que protege os dados de um dispositivo através de encriptação) que impede hackers a aceder ao seu dispositivo sem autorização, quando está conectado à internet. Assim sendo, é importante que o utilize quando acede à internet através de redes públicas/desprotegidas;</li>
									<li style="color:Blue;" align="justify">Deve <u>diminuir</u> o <b>alcance da rede Wi-Fi</b> pois assim existirá um menor núcleo de pessoas com acesso à rede, ou seja, mais segurança. Quando uma rede tem um bom alcance, a rede torna-se mais insegura sendo que o núcleo é maior e não existirá controlo total e poderão hackear a rede facilmente;</li>
									<li style="color:Blue;" align="justify">Deve sempre <u>utilizar mais que uma</u><b> firewall</b> (género de “barreira” que dificulta o acesso a hackers) para aumentar a segurança do router, da rede e do dispositivo. Sendo que normalmente os routers tem essa proteção incluída, apenas necessita de equipar um firewall no dispositivo para existir uma segurança total. Mesmo assim, devemos também verificar sempre na administração do router se a firewall está ativada (nos router as firewalls são dominadas por SPI (Stateful Packet Inspection)/NAT (Network Address Translation);</li>
									<li style="color:Blue;" align="justify">Deve sempre <u>criar</u> nos seus dispositivos <u>mais que uma conta</u> de utilizador e <u>definir uma</u> como <b>administrador</b>, limitando os privilégios das outras contas de utilizadores para que exista uma maior segurança tanto no dispositivo como na rede, não possibilitando a facilidade da colocação de softwares de roubo de informação, entre outros. O administrador de um dispositivo deve também colocar softwares no mesmo para proteger de pirataria e não ser vítima de spyware/ransomware.</li>
								</ul>

								<p align="center"><img src="imagens/seguro.jpg"></p>

								<a name="dest4"></a>
								<hr />

								<h4 style="color:Green;">Segurança em aparelhos movéis</h4>
								<p style="color:Blue;" align="justify">Os aparelhos móveis (smartphone/tablets) são extremamente úteis pois com eles conseguimos conectar-nos à rede em qualquer lugar por dados móveis/redes Wi-Fi e conseguimos fazer neles tudo como se estivéssemos num computador. Porém, este género de tecnologia também pode sofrer ameaças no caso de não estarem seguros.</p>
								<h6 style="color:Blue;">Géneros de ameaças</h6>
								<ul>
									<li style="color:Blue;" align="justify"><b>Perder o telemóvel</b> – no caso de perder/roubarem o telemóvel e cair em mãos desconhecidas, pode ter problemas no caso de não ter uma senha para aceder ao conteúdo do mesmo pois assim qualquer pessoa conseguirá aceder ao mesmo;</li>
									<li style="color:Blue;" align="justify"><b>Vírus informático</b> – este género de ameaça é a mais habitual para qualquer tecnologia e, com vírus, qualquer pessoa poderá ter acesso ao dispositivo e roubar informações por exemplo;</li>
									<li style="color:Blue;" align="justify"><b>Ataques com Malware</b> – são softwares maliciosos que atacam o sistema do computador, smartphone, etc. para roubar dados pessoais/confidenciais, por exemplo. Este género de software pode estar incorporado em jogos, emails, entre outros. Outro género de malware existente são os anúncios publicitários (demonstrados em aplicativos gratuitos) que pode aceder às configurações dos smartphones/tablets e extrai o número de identificação do telefone (IMEI) e muitos outros dados;</li>
									<li style="color:Blue;" align="justify"><b>Roubo de informação (via Bluetooth)</b> – infelizmente, o bluetooth é uma via onde é possível existir acesso ao dispositivo não sendo o dono do mesmo e sem necessidade de aceder com o telemóvel presente.</li>
								</ul>

								<h6 style="color:Blue;">Como se prevenir</h6>
								<p style="color:Blue;">Para prevenir este género de ameaças, devemos:</p>
								<ul>
									<li style="color:Blue">Instalar um antivírus no equipamento e mantê-lo atualizado;</li>
									<li style="color:Blue" align="justify">Apenas instalar/comprar aplicativos em lojas oficiais (Play Store no sistema operativo Android, por exemplo);</li>
									<li style="color:Blue">Desligar sempre o bluetooth quando não utilizar;</li>
									<li style="color:Blue">Ter sempre senhas seguras para aceder aos dispositivos, contas, etc.;</li>
									<li style="color:Blue">Fazer backups de segurança;</li>
									<li style="color:Blue">Utilize serviços/aplicações de localização em caso de roubo.</li>

								<p align="center"><img src="imagens/smartphonesafety.jpg"></p>

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