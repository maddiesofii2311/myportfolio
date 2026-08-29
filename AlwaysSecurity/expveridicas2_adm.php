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
							<p align="center"><a href="expveridicas_adm.php"><b>1º História</b></p>
                            <p align="center"><a href="#dest1"><b>2º História</b></a></p>
                            <p align="center"><a href="expveridicas3_adm.php"><b>3º História</b></a></p>
                            <p align="center"><a href="expveridicas4_adm.php"><b>4º História</b></a></p>
						</header>
						<a name="dest1"></a>
						<section class="wrapper style5">
							<div class="inner">

								<h3 style="color:Green;" align="center">2º História - Vítima de Phishing</h3>
								<p style="color:Blue;" align="justify">"Normalmente costumo fazer compras pela internet, mais própriamente em sites como Aliexpress. Tinha encomendado inúmeros artigos e esperei assim pelas encomendas, que normalmente costumam demorar 1 mês a chegar. Passado uma semana de fazer a encomenda, mais própriamente no dia 29 de novembro (era um domingo), recebi dois email da SantanderTotta sobre atualizações que necessitava de fazer à conta. Ignorei pois normalmente as pessoas que lá trabalham não costumam comunicar pelo email e pensei que fosse uma partida de crianças. Passados 3 dias, voltei a receber 3 email's. Um era outra vez da SantaderTotta que me alertou de algo importante confidencial. Os outros dois email's eram da aplicação App Store, sendo que não utilizo nenhum equipamento da apple e outro era sobre o site Mozello, sendo que nunca teria acedido ao mesmo pois não o conhecia. Pensei em ligar para polícia contudo calculei que poderia ser algum erro das pessoas que trabalham com aquelas marcas. Uma semana depois, recebo um email da Netflix a dizer que o pagamento automático falhou e achei estranho sendo que nunca criei conta nesta aplicação. Decidi assim ligar para o meu banco para me fazerem uma análise ao meu cartão bancário para verificar o saldo e as transações e estes informão que não continha nada da Netflix. Não compreendi a situação e o senhor que me atendeu falou que poderia estar a ser vítima de <u>phishing</u>, explicando-me de seguida o que significava e disse-me para se caso me acontecesse algo do género outra vez, para contactar a polícia. No final dessa semana volto a receber um email da Apple (com um endereço de email diferente) dizendo que tinha a minha conta pendente. Acabei por nem abri-lo sendo que nunca usei nenhum dispositivo da apple. No dia asseguir, recebo um email da DHL Express sobre a minha ecomenda e decidi assim contactar para eles para saber se a informação era verdadeira, onde eles me confirmaram que era. Por fim, no dia aseguir, recebo um email dos Ctt falando sobre a encomenda que já teria sido tratada no dia anterior por uma outra companhia de encomendas internacionais, ou seja, eu sabia que aquele email era falso. Como não quis estar a dirigir-me á polícia, contactei um amigo meu com curso superior em informática que me resolveu o problema eliminando aquela conta de email e criar-me uma nova e a colocar segurança no meu computador, como antivírus por exemplo. Desde aí, nunca mais tive problemas alguns."</p>
								<p style="color:Blue;" align="justify">Este história relaciona o crime <u>phishing</u> pois o hacker tentou várias vezes enganar este indivíduo para conseguir informações confidenciais do mesmo, através de email's. As evidências estão apresentadas abaixo.</p>

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
                            		<img src="imagens/exp2_img1.jpg" width="1050px" height="600px">  
                            		<br /><br />
                            	</div>  
                            	<div class="carousel-item">
                            		<img src="imagens/exp2_img2.jpg" width="1050px" height="600px">
                            		<br /><br />
                            	</td></tr>
            					</table>
                            	</div>
                            	<p style="color:Blue;" align="center">Clique no botão abaixo para ler a próxima história verídica ou anteceder de página!</p>
                            	<ul class="actions special" align="center">
                    				<li><a href="expveridicas_adm.php" class="button primary">Anteceder</a></li>
                    				<li><a href="expveridicas3_adm.php" class="button primary">Avançar</a></li>
                    			</ul>
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