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

	$cod_ut= $registo['cod_ut'];
	$tipo_ut= $registo['tipo_ut'];
	$dat_ult_login= $registo['dat_ult_login'];
	$hrs_ult_login= $registo['hrs_ult_login'];
	
	
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
		<link rel="stylesheet" href="assets/css/main2.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="landing is-preload">
	<iframe src="imagens/silence.mp3" allow="autoplay" id="audio" style="display: none"></iframe>

	<audio  autoplay="autoplay" loop preload="preload">
		<source src="imagens/musica.wav" type="audio/wav">
	</audio>
		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1><a href="adm_index.php">Always Security</a></h1>
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
											<li><a href="problemasi_log.php">Problemas existentes na Internet</a></li>
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

				<!-- Banner -->
					<section id="banner">

						<p><img src="imagens/logotipopap.jpg" width="300px" height="200px"></p>

						<div class="inner">


<h2>JOGO</h2>

<?php
echo"</br>";echo"</br>";

//CRIAR e INICIALIZAR ARRAY
$A_sorteados = ARRAY(0,0,0,0,0,0,0,0,0,0,0);
//11 posições para descartar a posição 0
/*
echo $A_sorteados[0]; echo " - ";
echo $A_sorteados[1]; echo " - ";
echo $A_sorteados[2]; echo " - ";
echo $A_sorteados[3]; echo " - ";
echo $A_sorteados[4]; echo " - ";
echo $A_sorteados[5]; echo " - ";
echo $A_sorteados[6]; echo " - ";
echo $A_sorteados[7]; echo " - ";
echo $A_sorteados[8]; echo " - ";
echo $A_sorteados[9]; echo " - ";
echo $A_sorteados[10];

echo"</br>";echo"</br>";

*/

//CRIAR e INICIALIZAR ARRAY para guardar codigos de perguntas
$A_codigos_perg = ARRAY(0,0,0,0,0,0,0,0,0,0,0);
//11 posições para descartar a posição 0

/*
echo $A_codigos_perg[0]; echo " - ";
echo $A_codigos_perg[1]; echo " - ";
echo $A_codigos_perg[2]; echo " - ";
echo $A_codigos_perg[3]; echo " - ";
echo $A_codigos_perg[4]; echo " - ";
echo $A_codigos_perg[5]; echo " - ";
echo $A_codigos_perg[6]; echo " - ";
echo $A_codigos_perg[7]; echo " - ";
echo $A_codigos_perg[8]; echo " - ";
echo $A_codigos_perg[9]; echo " - ";
echo $A_codigos_perg[10];

echo"</br>";echo"</br>";

*/

//consultar o n total de perguntas existentes
	$consulta = "select * from PERGUNTAS";
	$result = mysqli_query($ligax, $consulta);

	$nregistos = mysqli_num_rows($result);
	//echo 'N de perguntas encontradas:'.$nregistos;


	//echo"</br>";echo"</br>";

	//sortear 10 codigos de perguntas que não se podem repetir
	//versão mais antiga
	//$gera = rand(1,100);
	//echo rand(1,5);
	//echo"</br>";

	//versão mais recente
	//$gera = mt_rand(1,100);
	//echo mt_rand(1,5);
	//echo"</br>";


	for($i=1;$i<=10;$i++)
	{
		$sorteado= rand(1,$nregistos);
		//echo $sorteado;
		//echo " - ";
		// verificar se o nº já saiu anteriormente
		for($j=1;$j<=10;$j++)
		{
			if($A_sorteados[$j]==$sorteado)
			{
				// n repetido
				$j=11;
				$i--;
			}
			elseif($A_sorteados[$j]==0)
			{
				$A_sorteados[$j]= $sorteado;
				$j=11;
				
			}

		}


	}


//echo"</br>";echo"</br>";

//mostrar sorteados
//echo $A_sorteados[0]; echo " - ";
/*
echo $A_sorteados[1]; echo " - ";
echo $A_sorteados[2]; echo " - ";
echo $A_sorteados[3]; echo " - ";
echo $A_sorteados[4]; echo " - ";
echo $A_sorteados[5]; echo " - ";
echo $A_sorteados[6]; echo " - ";
echo $A_sorteados[7]; echo " - ";
echo $A_sorteados[8]; echo " - ";
echo $A_sorteados[9]; echo " - ";
echo $A_sorteados[10];

echo"</br>";echo"</br>";
*/

//extrair todos os registos da consulta
//Quando o nº de registo coincidir com nº sorteado
//guardar código no array



/*
	echo"</br>";

	echo"<center>";
	echo"<table border= '1' style='width: 60%;'> ";

		echo"<tr>";
		echo "<td>cod_perg</td>";
		echo "<td>cod_ut</td>"; 		
		echo "<td>cod_tema</td>";
		echo "<td>perg</td>";
		echo"</tr>";

*/

	for($i=1; $i <=$nregistos; $i++) 
	{
		$registo = mysqli_fetch_assoc($result);

		$cod_perg = $registo['cod_perg'];
		$cod_ut_autor = $registo['cod_ut'];
		$cod_tema = $registo['cod_tema'];
		$perg = $registo['perg'];


		if($i==$A_sorteados[1]) $A_codigos_perg[1]=$cod_perg;
		if($i==$A_sorteados[2]) $A_codigos_perg[2]=$cod_perg;
		if($i==$A_sorteados[3]) $A_codigos_perg[3]=$cod_perg;
		if($i==$A_sorteados[4]) $A_codigos_perg[4]=$cod_perg;
		if($i==$A_sorteados[5]) $A_codigos_perg[5]=$cod_perg;
		if($i==$A_sorteados[6]) $A_codigos_perg[6]=$cod_perg;
		if($i==$A_sorteados[7]) $A_codigos_perg[7]=$cod_perg;
		if($i==$A_sorteados[8]) $A_codigos_perg[8]=$cod_perg;
		if($i==$A_sorteados[9]) $A_codigos_perg[9]=$cod_perg;
		if($i==$A_sorteados[10]) $A_codigos_perg[10]=$cod_perg;

/*
		
		echo"<tr>";
		//echo "<td><a href="."forum_respostas_adm.php?cod_top=".$cod_top.">$msg_top</td>";
		echo '<td>'.$cod_perg.'</td>'; 
		echo '<td>'.$cod_ut.'</td>';
		echo '<td>'.$cod_tema.'</td>';
		echo '<td>'.$perg.'</td>';
		echo"</tr>";
*/			
  	}
/*
  	echo"</table>";
*/


//echo"</br>";echo"</br>";

//mostrar os códigos das perguntas
//echo $A_codigos_perg[0]; echo " - ";

/*
echo $A_codigos_perg[1]; echo " - ";
echo $A_codigos_perg[2]; echo " - ";
echo $A_codigos_perg[3]; echo " - ";
echo $A_codigos_perg[4]; echo " - ";
echo $A_codigos_perg[5]; echo " - ";
echo $A_codigos_perg[6]; echo " - ";
echo $A_codigos_perg[7]; echo " - ";
echo $A_codigos_perg[8]; echo " - ";
echo $A_codigos_perg[9]; echo " - ";
echo $A_codigos_perg[10];

echo"</br>";echo"</br>";
*/

//Agora guardar códigos na tabela TESTES
 	$ano=date("y");
    $mes=date("m");
    $dia=date("d");
    $data=$ano."-".$mes."-".$dia;
    //echo$data;
    $dat_real_teste=$data;

    $hora=date("H");
    $min=date("i");
    $seg=date("s");
    $hora=$hora.":".$min.":".$seg;
    //echo$hora;
    $hrs_real_teste=$hora;


$inserir="INSERT into JOGO values
('','".$dat_real_teste."','".$hrs_real_teste."',$cod_ut,
	$A_codigos_perg[1],
	$A_codigos_perg[2],
	$A_codigos_perg[3],
	$A_codigos_perg[4],
	$A_codigos_perg[5],
	$A_codigos_perg[6],
	$A_codigos_perg[7],
	$A_codigos_perg[8],
	$A_codigos_perg[9],
	$A_codigos_perg[10],
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	'N',
	NULL)";


$result=mysqli_query($ligax,$inserir);

if($result!=1) echo '<p>Erro no registo! Tente novamente!</p></br>';
//else 
//  echo"<p>Registado com sucesso!</p></br>";


//Registar LOG de escolha responder questionário
$dat_oper = $data;
$hrs_oper = $hora;

  $inserir="INSERT into LOGS values
  ('',$cod_ut,'".$dat_ult_login."','".$hrs_ult_login."','".$dat_oper."','".$hrs_oper."',5)";

  $result=mysqli_query($ligax,$inserir);

  if($result!=1) echo '<p>Erro no registo! Tente novamente!</p></br>';



//echo"<p>INSTRUÇÕES:</p>";
//echo "</BR>";
echo"<p>Atenção! as respostas estão limitadas por 40 segundos</p>";
echo"<p>Boa Sorte!</p>";
echo "</BR>";
echo"<img src='imagens/smile_like.jpg' width='300px' height='200px'>";
echo "</BR>";
echo "</BR>";
echo "<a href='zona_jogo_jogar_teste.php' class='button primary'>COMEÇAR</a>";





echo"</center>";

echo"</br>";echo"</br>";echo"</br>";

  	echo"<table>";
	echo"<tr>";
	echo"<td colspan='3' align='center'>";
  	echo "<a href='zona_jogo.php'>Voltar</a>";
  	echo"</td>";
	echo"</tr>";
  	echo"</table>";
?>

</br>







 

					</section>
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