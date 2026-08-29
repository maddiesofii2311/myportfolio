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
							<p align="center"><a href="expveridicas_adm.php"><b>1º História</b></p>
                            <p align="center"><a href="expveridicas2_adm.php"><b>2º História</b></a></p>
                            <p align="center"><a href="#dest1"><b>3º História</b></a></p>
                            <p align="center"><a href="expveridicas4_adm.php"><b>4º História</b></a></p>
						</header>
						<a name="dest1"></a>
						<section class="wrapper style5">
							<div class="inner">

								<h3 style="color:Green;" align="center">3º História - Insegurança existente na Internet</h3>
								<p style="color:Blue;" align="justify">"Em Agosto de 2020 tentei comprar uns bilhetes na Ryanair, no entanto quando punha os dados todos dizia pagamento não autorizado. Achei estranho, tendo em conta que raramente uso o cartão de crédito e apenas o tinha usado nesse ano duas vezes (uma em fevereiro e outra em maio). Assim, depois de várias tentativas falhadas e de ver sempre o resultado "Pagamento não autorizado" fui ao banco e informaram-me que o cartão se encontrava na lista negra. Fiquei chocada, sendo que as compras que tinha feito foram em sites seguros e nunca guardei os dados de pagamento em nenhum site. Nos movimentos do cartão apareceu que o youtube me retirou dinheiro e outros anúncios sendo que o senhor do banco disse que a causa pode ser dos cookies e de ter outros separadores abertos durante a compra. Aconselhou-me a que sempre que fosse efetuar uma compra, limpar os cookies nas definições e ter sempre apenas o separador da compra aberto ou mesmo utilizar outro programa como o Microsoft Edge. Desde então fiz compras e não houve nenhum problema. Na semana passada estava a fazer uma compra e apesar de ter limpado os cookies esqueci-me de fechar os restantes separadores apesar de serem relativos à compra. Felizmente, apercebi-me da situação e resolvi. Não encontrei o papel que o senhor do banco me forneceu com o movimento do cartão mas, em anexo, têm uma captura de ecrã do que me apareceu quando não autorizava o pagamento."</p>
								<p style="color:Blue;" align="justify">Para além desta história verídica não estar relacionada a nenhum crime, não significa que seja uma história menos importante sendo que o que podemos observar neste caso é a falta de segurança existente na internet. Ou seja, esta pessoa afirma que perdeu dinheiro sem realizar nenhuma compra e a compra que realmente queria não deixava ser paga. Podemos concluir que existe insegurança tanto na internet (para perder dinheiro em algo que não tinha pago alguém teve de fazer aquela transação) e também poderá relacionar-se com a insegurança existente na conta bancária desta pessoa sendo que conseguiram aceder ao cartão e retirar dinheiro. O conselho que esta pessoa recebeu do senhor que trabalhava no banco é bom e realmente consegue resolver o problema.</p>

								<p align="center"><img src="imagens/exp3.jpg" width="900px" height="600px"></p>

								<p style="color:Blue;" align="center">Clique no botão abaixo para ler a próxima história verídica ou anteceder de página!</p>
                            	<ul class="actions special" align="center">
                    				<li><a href="expveridicas2_adm.php" class="button primary">Anteceder</a></li>
                    				<li><a href="expveridicas4_adm.php" class="button primary">Avançar</a></li>
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