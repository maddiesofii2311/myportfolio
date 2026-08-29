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
											<li><a href="definicaosi_log.php">O que é Segurança na Internet</a></li>
											<li><a href="sredeswifi_log.php">Segurança Redes Wi-Fi</a></li>
											<li><a href="navegars_log.php">Navegue em Segurança</a></li>
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
							<h2><u>Problemas existentes na Internet</u></h2>
							<p><b>Abrir &#8595;</b></p> 
							    <ul class="actions special">
								<li><a href="https://www.youtube.com/channel/UCDoF9llATdrvYd0LiTs1Nxg"><img src="imagens/youtube.png" width="100px" height="100px"></a></li>
						</header>
						<section class="wrapper style5">
							<div class="inner">

								<p style="color:Blue;">Existem diversos géneros de problemas com a Internet. Em baixo, estão alguns exemplos de alguns problemas existentes na Internet:</p>
								<ul>
									<li style="color:Blue;"><a href="#dest1"><b>Cyberbullying</b>;</li>
									<li style="color:Blue;"><a href="#dest2"><b>Stalking</b>;</li>
									<li style="color:Blue;"><a href="#dest3"><b>Sexting</b>;</li>
									<li style="color:Blue;"><a href="#dest4"><b>“Engenharia Social”</b>;</li>
									<li style="color:Blue;"><a href="#dest5"><b>Senhas</b>;</li>
									<li style="color:Blue;"><a href="#dest6"><b>Phishing</b>;</li>
									<li style="color:Blue;"><a href="#dest7"><b>Key Logger</b>;</li>
									<li style="color:Blue;"><a href="#dest8"><b>Vishing</b>;</li>
									<li style="color:Blue;"><a href="#dest9"><b>Smishing</b>;</li>
									<li style="color:Blue;"><a href="#dest10"><b>Vírus</b>;</li>
									<li style="color:Blue;"><a href="#dest11"><b>Grooming</b>;</li>
									<li style="color:Blue;"><a href="#dest12"><b>Ransomware</b>;</li>
									<li style="color:Blue;"><a href="#dest13"><b>Spyware</b>.</li>
								</ul>

								<p align="center"><img src="imagens/problemasinternet.jpg"></p>

								<a name="dest1"></a>
								<hr />

								<h6 style="color:Green;">O que é Cyberbullying?</h6>
								<p style="color:Blue;" align="justify"><u>Cyberbullying</u> é a perseguição moral que uma pessoa poderá sofrer na internet que, normalmente, realiza-se em redes sociais, contudo, existem casos em que este ato acontece em sites, blogs ou em aplicações de mensagens instantâneas. A perseguição moral define-se por agressão moral repentina no qual o agredido fica com problemas emocionais, ansiedade, entre outros. Como se trata de uma agressão através da internet, não é necessário que as pessoas incluídas na situação estejam próximas fisicamente.</p>
								<h6 style="color:Green;">Como detetar?</h6>
								<p style="color:Blue;"> É possível detetar este crime de duas maneiras:</p>
								<ul>
									<li style="color:Blue;" align="justify"><b>Pelo comportamento da vítima</b> - Na verdade, o comportamento irregular da vítima pode não significar que esteja a ser vítima de cyberbulling, contudo, nunca se pode descartar essa hipótese. Normalmente, quando uma pessoa sente stress, ansiedade, depressão, desconfiança (pessoal/para com outras pessoas), raiva, humilhação e, em alguns casos, vontade de cometer suicídio, significa que a pessoa está a sofrer de algum crime como o cyberbulling ou até mesmo cyberbulling;</li>
									<li style="color:Blue;" align="justify"><b>Pelo comportamento do agressor</b> - Pelo comportamento do agressor, quando nos apercebemos que o mesmo faz acusações/coloca imagens engraçadas (editadas ou não) da vítima com intenção de a prejudicar repetidamente através de redes sociais/sites e manipula outras pessoas para que a sua informação se torne credível, é uma atitude de um agressor de cyberbulling. Outro comportamento de um agressor de cyberbulling que poderá significar que existe um crime de cyberbulling é quando o agressor procura obter mais informações sobre a vítima (espiando/através das redes sociais).</li>
								</ul>
								<h6 style="color:Blue;">Como prevenir?</h6>
								<p style="color:Blue;">Felizmente, existe a possibilidade de evitar este género de crime denunciando a conta na rede social/serviço. Podemos evitar também este género de problemas falando com o tutor (no caso de menor de idade) ou falar com a polícia.</p>

								<p align="center"><img src="imagens/cyberbullying.jpg"></p>

								<a name="dest2"></a>
								<hr />

								<h6 style="color:Green;">O que é Stalking?</h6>
								<p style="color:Blue;" align="justify">O <u>stalking/cyberstalking</u> é um crime informático no qual o agressor espia a(s) sua(s)  vítima(s) na internet e, por vezes, envia mensagem à(s) mesma(s). Normalmente, este ato ocorre em redes sociais como Facebook, Instagram ou Twitter pois são as redes onde as pessoas expõem mais as suas informações pessoais. Poderá ocorrer também em serviços de email ou mensagens instantâneas como o WhatsApp, por exemplo, caso o agressor seja fascinado pela(s) vítima(s). O nome atribuído a agressores deste género de crime é “Stalker”.</p>
								<h6 style="color:Green;">Como prevenir?</h6>
								<p style="color:Blue;" align="justify">Para a vítima/iniciantes conseguirem evitar este género de problemas, deve ter cuidado com o conteúdo que coloca na internet como informações pessoais contactos, fotos, etc., pois após a sua colocação, a pessoa perde o controle do mesmo pois as pessoas que o visualizarem poderão fazer o que quiser com a mesma. Deve também não aceitar a visualização de estranhos nas redes sociais configurando a privacidade na rede social que utiliza, denunciar algum(a) mensagem/email suspeito ou alertar a polícia sobre a mesma situação.</p>

								<p align="center"><img src="imagens/stalking.jpg"></p>

								<a name="dest3"></a>
								<hr />

								<h6 style="color:Green;">O que é Sexting?</h6>
								<p style="color:Blue;" align="justify">O <u>sexting</u> é um crime cometido na maioria das vezes pelos adolescentes onde os mesmos partilham fotografias/vídeos eróticos/sexuais de outra pessoa que lhe confiou, onde após a partilha inicial, a imagem/vídeo irá ser partilhada de pessoas para pessoas no qual se tornaria um ciclo. Normalmente este género de crimes acontece em mensagens instantâneas como WhatsApp onde geralmente partilham com amigos. Na maioria das vezes, as raparigas têm mais tendência a enviar este género de conteúdo aos rapazes que os rapazes quando estão num relacionamento e após o término, os rapazes, sendo assim, têm mais tendência a enviar o conteúdo para os amigos que as raparigas contudo, o inverso acontece também. Poderia acontecer também um género diferente de crime que poderá se considerar também sexting, se a pessoa perder-se/tivessem roubado o seu telemóvel e outra pessoa anónima enviar a mesma por maldade, por exemplo. Este género de problema poderá provocar cyberbulling, stalking e grooming (no caso de menor de idade) onde a vítima ficará com depressão, provavelmente.</p>
								<h6 style="color:Green;">Como prevenir?</h6>
								<p style="color:Blue;" align="justify">Quando alguém quer enviar uma foto/vídeo para outra pessoa, deve pensar primeiro se o deve fazer pois após o envio, a pessoa perderá o controle do mesmo. Sendo assim, não é aconselhável enviar conteúdo íntimo pela Internet. No caso de envio, deve ter em atenção na atualização do equipamento (telemóvel, computador, etc.) com antivírus e a colocação de senhas seguras para o caso de serem roubados/hackeados não terem acesso ao mesmo.</p>
								
								<p align="center"><img src="imagens/sexting.jpg"></p>

								<a name="dest4"></a>
								<hr />

								<h6 style="color:Green;">O que é "Engenharia Social"?</h6>
								<p style="color:Blue;" align="justify">A <u>“engenharia social”</u> é um termo correspondente a um crime no qual o criminoso obtém informações confidenciais de pessoas através de manipulação onde conseguem roubar dados bancários, assediar ou fornecer falso testemunho. Normalmente estes criminosos não têm uma vítima concreta, ou seja, escolhem a sua vítima através da Internet e enganam através de emails/mensagens instantâneas. Por exemplo, o criminoso pode fazer de conta que é um empregado de banco para obter os dados financeiros da vítima para roubar. Outro exemplo que infelizmente acontece nos dias de hoje é o envio de uma informação falsa que fornece um link enganoso no qual as vítimas acreditam e, ao abrirem o link, o criminoso consegue aceder a dados pessoais da vítima.</p>
								<h6 style="color:Green;">Como prevenir?</h6>
								<p style="color:Blue;" align="justify">Quando recebemos uma mensagem duvidosa, nunca a devemos abrir pois seriamos vítimas de “engenharia social”. Não devemos também fornecer informações pessoais (senhas por exemplo) para outras pessoas através do telemóvel/internet.</p>

								<p align="center"><img src="imagens/engenhariasocial.jpg"></p>

								<a name="dest5"></a>
								<hr />

								<h6 style="color:Green;">Senhas</h6>
								<p style="color:Blue;" align="justify">Nos dias de hoje, a maioria das pessoas não sabem criar uma <u>senha</u> segura pois pensam que não é algo muito importante e não se informam contudo, a escolha de uma senha é um dos pontos mais seguros para a segurança na Internet para que ninguém consiga aceder à conta sem autorização. Sendo assim, estará abaixo explicado algumas dicas para fazer senhas seguras:</p>
								<ul>
									<li style="color:Blue;">Utilizar diferentes senhas para diferentes contas;</li>
									<li style="color:Blue;">Utilizar caracteres para além de letras (números, @, etc.);</li>
									<li style="color:Blue;">Não utilizar palavras simples;</li>
									<li style="color:Blue;">Não utilizar palavras de informações pessoais;</li>
									<li style="color:Blue;">Manter atualizado cópias de segurança;</li>
									<li style="color:Blue;">Trocar de senha regularmente;</li>
									<li style="color:Blue;">Guardas as senhas num sítio seguro.</li>
								</ul>

								<p align="center"><img src="imagens/senhas.jpg"></p>

								<a name="dest6"></a>
								<hr />

								<h6 style="color:Green;">O que é Phishing?</h6>
								<p style="color:Blue;" align="justify"><u>Phishing</u> é um crime parecido com a “Engenharia Social” contudo, no phishing, o criminoso rouba a identidade de um banco, por exemplo, para adquirir informação confidencial da sua vítima enviando email’s (meio de comunicação mais utilizado nestas situações – pode-se se considerar Spam) com informação falsa para que a vítima fique preocupada e por vezes, acaba por fornecer os seus dados pessoais ao criminoso. Normalmente, estes criminosos utilizam contas de email que parecem originais, contudo possui uma diferença visual que a vítima não repara (<u>meubanco@gmail.com</u> por <u>meubanc0@gmail.com</u>, por exemplo).</p>
								<h6 style="color:Green;">Como prevenir?</h6>
								<p style="color:Blue;" align="justify">No caso de acontecer uma situação destas, a vítima deve primeiramente ter em atenção no user de email para verificar se é enganoso ou não. No caso de não suspeitar de nada, deve entrar em contacto com o banco para confirmar a informação. Caso tenha sido falsificação, a vítima deve relatar o acontecimento á polícia. Deve ter em atenção também que os sites de bancos, lojas online, etc. tenham incluído no link o protocolo HTTPS (HyperText Transfer Protocol Secure), pois este protocolo garante a segurança do site, quanto á criptografia dos dados, identificação de utilizadores, certificados de integridade e confidencialidade das informações (no caso de ser fornecido no email algum link).</p>

								<p align="center"><img src="imagens/phishing.jpg"></p>

								<a name="dest7"></a>
								<hr />

								<h6 style="color:Green;">O que é Key Logger?</h6>
								<p style="color:Blue;" align="justify">O <u>Key Logger</u> é um crime no qual o criminoso grava informação confidencial da vítima, utilizando um software/hardware. Normalmente, este género de crime acontece mais em caixas de multibanco, onde o criminoso coloca uma cópia do teclado numérico (hardware) e, após a vítima deixar as suas impressões digitais na mesma, o criminoso retira e fica com o código do cartão de multibanco, uma informação confidencial.</p>
								<h6 style="color:Green;">Como prevenir?</h6>
								<p style="color:Blue;" align="justify">No caso de utilização de computador/telemóvel, deve ter sempre os antivírus atualizados e nunca utilizar equipamentos públicos para fazer transações, exemplo. No caso de uma caixa de multibanco, deve confirmar sempre se está colocado um teclado adicionar desnecessário e, no caso de existir, deve entregá-lo á polícia e denunciar.</p>

								<p align="center"><img src="imagens/keylogger.jpg"></p>

								<a name="dest8"></a>
								<hr />

								<h6 style="color:Green;">O que é Vishing?</h6>
								<p style="color:Blue;" align="justify"><u>Vishing</u> é um crime no qual o criminoso comunica com a vítima e convence a vítima a revelar informações pessoais para as utilizar para benefício do criminoso. Normalmente, este género de crime acontece por chamada. </p>
								<h6 style="color:Green;">Como prevenir?</h6>
								<p style="color:Blue;" align="justify">Nestas situações, o mais aconselhável é nunca tratar de situações pessoais por chamada, mas sim pessoalmente. No caso de não ter a possibilidade de falar pessoalmente, é aconselhável apenas falar de informações pessoais por números oficiais, de bancos por exemplo.</p>

								<p align="center"><img src="imagens/vishing.jpg"></p>

								<a name="dest9"></a>
								<hr />

								<h6 style="color:Green;">O que é Smishing?</h6>
								<p style="color:Blue;" align="justify"><u>Smishing</u> é um crime onde o criminoso utiliza aplicações de texto (WhatsApp por exemplo) para enviar links enganosos de concurso de prémios falsos à vítima. A vítima, ao clicar no link, “fornece” dados pessoais ao criminoso e o criminoso consegue “entrar” no dispositivo da pessoa e colocar vírus.</p>
								<h6 style="color:Green;">Como prevenir?</h6>
								<p style="color:Blue;" align="justify">Para prevenir esta situação, apenas não deve abrir mensagens estranhas com conteúdo em formato de link/anexo de download, para que não tenha nenhum problema e, no caso de querer abrir, deve confirmar primeiro se é enganoso ou não. Deve também ter em atenção que qualquer mensagem que afirma que ganha algum prémio ou que é colocado num sorteiro, é enganoso, pois estes prémios e sorteiros não existem.</p>

								<p align="center"><img src="imagens/smishing.jpg"></p>

								<a name="dest10"></a>
								<hr />

								<h6 style="color:Green;">O que é um Vírus?</h6>
								<p style="color:Blue;" align="justify">Um <u>vírus</u> é uma forma de entrar no computador, telemóvel, etc. fazendo com que tenha acesso ao dispositivo não estando à beira do mesmo para roubar informações confidenciais/senhas, estragar o equipamento por completo ou alguns componentes. Os géneros de vírus existentes são: códigos maliciosos, trojans e vírus. Um género de espalhamento de vírus conhecido é feita por mensagem (normalmente na aplicação do Facebook) onde encaminham links falsos/linguagem de programação Java onde solicita o download e a instalação de arquivos maliciosos no computador.</p>
								<h6 style="color:Green;">Como prevenir?</h6>
								<p style="color:Blue;" align="justify">Para prevenir estas situações, não devemos abrir as mensagens de links falsos/linguagem de programação Java contudo, no caso de duvida (pois poderia não ser uma mensagem enganosa), deve verificar se o link contém o protocolo HTTPS pois esse mesmo protocolo indica a segurança na utilização. Deve instalar também no seu dispositivo um antivírus e mante-lo sempre atualizado pois este será o principal mecanismo de defesa contra vírus, códigos maliciosos, etc.</p>

								<p align="center"><img src="imagens/virus.jpg"></p>

								<a name="dest11"></a>
								<hr />

								<h6 style="color:Green;">O que é Grooming?</h6>
								<p style="color:Blue;" align="justify">O <u>grooming</u> é um crime onde um adulto tenta aliciar menores através da internet, com o intuito de obter benefícios sexuais. Nesta prática, o adulto cria uma conta falsa numa rede social (Facebook, Instagram, etc.) fazendo-se passar por alguém menor de idade e aproxima-se assim da sua vítima menor de idade. O objetivo principal de um criminoso é ganhar confiança e criar uma relação emocional para aproveitar-se sexualmente da vítima (envia e pede conteúdo erótico à sua vítima onde a vítima cede) onde a insere num mundo de prostituição e pornografia chantageando-a a mostrar/publicar online os conteúdos eróticos da vítima.</p>
								<h6 style="color:Green;">Como prevenir?</h6>
								<p style="color:Blue;">Para prevenir este género de situações, deve-se ensinar os menores de idade a ter um bom uso da tecnologia e da internet com as devidas seguranças necessárias, como:</p>
								<ul>
									<li style="color:Blue;">Encerrar sempre as contas das redes sociais nos computadores públicos para que ninguém consiga aceder ao mesmo e obter as informações pessoais;</li>
									<li style="color:Blue;">Colocar na conta da rede social como privado para que apenas as pessoas que o dono da conta quer que vejam consigam ver;</li>
									<li style="color:Blue;">Não colocar informações pessoais nas redes sociais e ter em atenção no conteúdo que publica (foto/vídeo);</li>
									<li style="color:Blue;">Nunca compartilhar as suas senhas com ninguém;</li>
									<li style="color:Blue;">Nunca aceitar estranhos nas redes sociais que queiram contacto.</li>
								</ul>

								<p align="center"><img src="imagens/grooming.jpg"></p>

								<a name="dest12"></a>
								<hr />

								<h6 style="color:Green;">O que é Ransomware?</h6>
								<p style="color:Blue;" align="justify">O <u>ransomware</u> é um crime onde um criminoso tem a capacidade de aceder a um dispositivo sem autorização e coloca vírus/trojans para aceder aos dados pessoais. Sendo assim, os ficheiros que o dispositivo contem entraram em risco.</p>
								<h6 style="color:Green;">Como prevenir?</h6>
								<p style="color:Blue;" align="justify">Para prevenir este género de situações, deve ter em atenção o seu antivírus, firewall e rede VPN. No caso de possuir ficheiros importantes no seu dispositivos, deve fazer cópias de segurança dos mesmos, quer seja para um disco externo ou mesmo para a cloud.</p>

								<p align="center"><img src="imagens/ransomware.jpg"></p>

								<a name="dest13"></a>
								<hr />

								<h6 style="color:Green;">O que é Spyware?</h6>
								<p style="color:Blue;" align="justify">O <u>spyware</u> é um género de malware não visível que regista informações e rastreia a utilização online da vítima em computadores/smartphone sem o conhecimento da vítima. O mesmo consegue também monitorar/copiar todas as informações do dispositivo seja recente ou antigo e em último caso poderá ser mesmo durante o momento de utilização pela vítima. Alguns malwares conseguem ativar câmaras/microfones e assistir em direto o que está a acontecer.</p>
								<h6 style="color:Green;">Como prevenir?</h6>
								<p style="color:Blue;" align="justify">Para prevenir estas situações, deve utilizar sempre um software antivírus confiável que contenha recursos anti-spyware e manter sempre também os dispositivos e sistemas operativos atualizados. Não deve abrir links/anexos de emails/contactos desconhecidos, abrir anúncios enganosos online (como por exemplo anúncios que dizem oferecer telemóveis) e conversar com pessoas desconhecidas através de aplicativos de mensagem para se prevenir.</p>

								<p align="center"><img src="imagens/spyware.jpg"></p>								

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