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
						<h1><a href="index.html">Always Security</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="adm_pagina_principal">Área Administradora</a></li>
											<li><a href="adm_index.php">Início</a></li>											
											<li><a href="definicaosi~_adm.php">O que é Segurança na Internet</a></li>
											<li><a href="sredeswifi_adm.php">Segurança Redes Wi-Fi</a></li>
											<li><a href="navegars_adm.php">Navegue em Segurança</a></li>
											<li><a href="problemasi_adm.php">Problemas existentes na internet</a></li>
											<li><a href="transcompweb_adm.php">Transferências Financeiras e Compras Online</a></li>
											<li><a href="redessociaiss_adm.php">Redes Sociais - Utilizar de forma Segura</a></li>
											<li><a href="protmenores_adm.php">Proteção de menores de idade</a></li>
											<li><a href="expveridicas_adm.php">Experiências Verídicas</a></li>
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
							<h2><u>Estatísticas - Estudo a jovens entre os 12 e 15 anos</u></h2>
						</header>
						<section class="wrapper style5">
							<div class="inner">

								<p style="color:Blue;" align="justify">Este estudo foi realizado com a intuição de informar as pessoas o conhecimento dos jovens entre os 12 e 15 anos sobre a segurança na internet nos dias de hoje (em maioria) pois iremos poder observar abaixo que existe certos aspetos que estes jovens não tiveram a oportunidade de conhecer para se poderem proteger de ameaças.</p>

								<p align="center"><img src="imagens/jovtecn.jpg"></p>

								<hr />

								<p align="center"><img src="imagens/est1.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Não” com 68,6%, ou seja, 24 pessoas responderam “Não” e 11 pessoas responderam “Sim” (31,4%). De acordo com estes resultados, podemos concluir que grande parte destes jovens conhecem a falsificação das publicidades porém, existe ainda uma parte que acredita, algo preocupante sendo que poderá existir futuramente o roubo de informações/ficheiros a estes jovens sem o devido conhecimento. É aconselhável que os seus tutores ensinem as possíveis consequências destas publicidades.</p>

								<hr />

								<p align="center"><img src="imagens/est2.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Sim” com 71,4%, ou seja, 25 pessoas responderam “Sim” e 10 pessoas responderam “Não” (28,6%). De acordo com estes resultados, podemos concluir que grande parte destes jovens já presenciaram mensagens enganosas, ou seja, demonstra a probabilidade e frequência que este género de mensagens acontece onde se deve ter o devido cuidado nestas situações.</p>

								<hr />

								<p align="center"><img src="imagens/est3.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Sim” com 71,4%, ou seja, 25 pessoas responderam “Sim” e 10 pessoas responderam “Não” (28,6%). De acordo com estes resultados, podemos concluir que grande parte destes jovens não conhece os perigos existentes quando falam com pessoas desconhecidas. É aconselhável que os seus tutores ensinem as possíveis consequências destas conversas com pessoas estranhas.</p>

								<hr />

								<p align="center"><img src="imagens/est4.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Não” com 57,1%, ou seja, 20 pessoas responderam “Não” e 15 pessoas responderam “Sim” (42,9%). De acordo com estes resultados, podemos concluir que grande parte destes jovens não conhece os perigos existentes quando se encontram com pessoas desconhecidas. É aconselhável que os seus tutores ensinem as possíveis consequências destes encontros com pessoas desconhecidas.</p>

								<hr />

								<p align="center"><img src="imagens/est5.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Não” com 74,3%, ou seja, 26 pessoas responderam “Não” e 9 pessoas responderam “Sim” (25,7%). De acordo com estes resultados, podemos concluir que grande parte destes jovens não conhece os perigos existentes quando publica conteúdo na internet (como redes sociais por exemplo) sem pensar nas suas consequências futuras, sendo que a partir do momento que o mesmo é publicado ficará sempre guardado numa base de dados, mesmo após a pessoa apagar o conteúdo. É aconselhável que os seus tutores ensinem as possíveis consequências da publicação de conteúdo sem pensar bem antes.</p>

								<hr />

								<p align="center"><img src="imagens/est6.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Não” com 88,6%, ou seja, 31 pessoas responderam “Não” e 4 pessoas responderam “Sim” (11,4%). De acordo com estes resultados, podemos concluir que grande parte destes jovens conhece os perigos de partilhar informação confidencial/pessoal na internet. Contudo, existe ainda um grupo de jovens que não possuem o devido conhecimento sobre este tema. É aconselhável que os seus tutores ensinem as possíveis consequências da partilha de informação confidencial/pessoal na internet.</p>

								<hr />

								<p align="center"><img src="imagens/est7.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Não” com 68,6%, ou seja, 24 pessoas responderam “Não” e 11 pessoas responderam “Sim” (31,4%). De acordo com estes resultados, podemos concluir que grande parte destes jovens conhece os perigos de partilhar informação confidencial/pessoal através de mensagens/chamadas. Contudo, existe ainda um grupo de jovens que não possuem o devido conhecimento sobre este tema. É aconselhável que os seus tutores ensinem as possíveis consequências da partilha de informação confidencial/pessoal através de mensagens/chamadas.</p>

								<hr />

								<p align="center"><img src="imagens/est8.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Não” com 57,1%, ou seja, 20 pessoas responderam “Não” e 15 pessoas responderam “Sim” (42,9%). De acordo com estes resultados, podemos concluir que grande parte destes jovens sabe como se deve proteger equipamentos tecnológicos para não serem invadidos, no caso de serem vítimas. Contudo, existe ainda um grupo de jovens que não possuem o devido conhecimento sobre este tema. É aconselhável que os seus tutores ensinem as possíveis consequências da falta de proteção nos equipamentos tecnológicos, como também sobre o facto de ser considerado crime invadir contas/dispositivos sem a autorização do proprietário da mesma.</p>

								<hr />

								<p align="center"><img src="imagens/est9.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Sim” com 54,3%, ou seja, 19 pessoas responderam “Sim” e 16 pessoas responderam “Não” (45,7%). De acordo com estes resultados, podemos concluir que grande parte destes jovens sabe como se deve proteger equipamentos tecnológicos para não exista a dúvida de estarem a ser espiados, ou não. Contudo, existe ainda um grupo de jovens que não possuem o devido conhecimento sobre este tema. É aconselhável que os seus tutores ensinem as possíveis consequências da falta de proteção nos equipamentos tecnológicos.</p>

								<hr />

								<p align="center"><img src="imagens/est10.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Não” com 82,9%, ou seja, 29 pessoas responderam “Não” e 6 pessoas responderam “Sim” (17,1%). De acordo com estes resultados, podemos concluir que infelizmente existem pessoas que “stalkeiam” outras onde não sabem que é considerado crime, provavelmente. É aconselhável que os seus tutores ensinem as possíveis seguranças em redes sociais, por exemplo, devem ser ativadas para prevenir situações como esta.</p>

								<hr />

								<p align="center"><img src="imagens/est11.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Não” com 80%, ou seja, 28 pessoas responderam “Não” e 7 pessoas responderam “Sim” (20%). De acordo com estes resultados, podemos concluir que felizmente existe cada vez menos bullying na internet contudo, ainda existe. É aconselhável que os seus tutores ensinem as possíveis consequências psicológicas que as vítimas de bullying poderão ter ensinando sucessivamente a saber respeitar o próximo. Para as vítimas, devem ensinar sobre como colocar a sua conta/dispositivos seguras para além de saber como se comportar em situações deste género.</p>

								<hr />

								<p align="center"><img src="imagens/est12.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Não” com 80%, ou seja, 28 pessoas responderam “Não” e 7 pessoas responderam “Sim” (20%). De acordo com estes resultados, podemos concluir que os jovens nos dias de hoje conhecem os devidos perigos quando partilham conteúdo erótico para outras pessoas contudo, existe ainda uma percentagem de jovens que não possuem esse conhecimento. É aconselhável que os seus tutores ensinem as possíveis consequências da partilha de conteúdo erótico para outras pessoas ou para a internet.</p>

								<hr />

								<p align="center"><img src="imagens/est13.jpg"></p>

								<p style="color:Blue;" align="justify">A moda deste gráfico é “Não” com 85.7%, ou seja, 30 pessoas responderam “Não” e 5 pessoas responderam “Sim” (14.3%). De acordo com estes resultados, podemos concluir que os jovens nos dias de hoje conhecem as políticas destes atos contudo, existe ainda uma percentagem de pessoas que não conhecem. É aconselhável que os seus tutores ensinem as más consequências de publicar conteúdo de outra pessoa sem o seu consentimento, podendo ser levado a tribunal e ser considerado crime.</p>

								<hr />

								<div id="demo" class="carousel slide" data-ride="carousel">
								<table width="100%">
								<tr><td align="center" bgcolor="white">
          						<ul class="carousel-indicators ">
            						<li data-target="#demo" data-slide-to="0" class="active"></li>
            						<li data-target="#demo" data-slide-to="1"></li>
            						<li data-target="#demo" data-slide-to="2"></li>
            					</ul>
            					<div class="carousel-inner"> 

            					<a class="carousel-control-prev" href="#demo" data-slide="prev">
            					<span class="carousel-control-prev-icon"></span>
          						</a>
          						<a class="carousel-control-next" href="#demo" data-slide="next">
            					<span class="carousel-control-next-icon"></span>
          						</a>

            					<div class="carousel-item active">
                            		<img src="imagens/est14_part1.jpg" width="641px" height="400px">  
                            		<br /><br />
                            	</div>  
                            	<div class="carousel-item">
                            		<img src="imagens/est14_part2.jpg" width="641px" height="400px">
                            		<br /><br />
                            	</div>
                            	<div class="carousel-item">
                            		<img src="imagens/est14_part3.jpg" width="641px" height="400px">
                            		<br /><br />
                            	</td></tr>
            					</table>
                            	</div>

								<p style="color:Blue;" align="justify">A moda das respostas é “Não”, ou seja, 19 pessoas responderam “Não” e 16 pessoas responderam “Sim”. De acordo com estes resultados, podemos concluir que grande parte dos jovens nos dias de hoje não tem o controlo dos pais, no que refere à utilização da internet. É aconselhável que os seus tutores vejam a utilização da internet dos seus menores. Não existe a necessidade de verificar todos os dias porém, de uma vez por outra é conveniente sendo que os menores poderão se meter em problemas futuros (como alguns exemplos referidos nas perguntas do inquérito acima) sem dar conta.</p>												

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