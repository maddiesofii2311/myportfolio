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
	<body class="landing is-preload"  onload=startCountdown() >


<SCRIPT language=JavaScript>

var g_iCount = new Number();

// de 30 a 0 //
var g_iCount = 45;

function startCountdown(){
       if((g_iCount - 1) >= 0){
               g_iCount = g_iCount - 1;
               if(g_iCount <= 40)
                 numberCountdown.innerText = g_iCount+'s';
             
               setTimeout('startCountdown()',1000);
       }
       else
       	window.location.replace("zona_jogo_jogar_teste.php");
}
</SCRIPT>









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

<?php



//echo"</br>";echo"</br>";


//CRIAR e INICIALIZAR ARRAY
// para guardar codigos de_perg em array
$A_cod_perg = ARRAY(0,0,0,0,0,0,0,0,0,0,0);
//11 posições para descartar a posição 0


//CRIAR e INICIALIZAR ARRAY
// guardar class_perg em array V e F
// para mais facilmente percorrer todas as posições e testar conteúdo
$A_class_perg = ARRAY('-','-','-','-','-','-','-','-','-','-','-');
//11 posições para descartar a posição 0
// 'V'-resposta verdadeira
// 'F'-resposta falsa
// '-' ainda não respondida

//Inicializar var classificação a zero
$acumulador_class = 0;



//consultar o n total de perguntas existentes
	$consulta = "select * from JOGO WHERE cod_ut='".$cod_ut."'";
	$result = mysqli_query($ligax, $consulta);

	$nregistos = mysqli_num_rows($result);
	//echo 'N de testes encontrados:'.$nregistos;


//consultar o último registo (último jogo do jogador)
//Quando o nº de registo coincidir com último
//extrair todos os registos da consulta


	for($i=1; $i <=$nregistos; $i++) 
	{
		$registo = mysqli_fetch_assoc($result);
		if($i==$nregistos)
		{
			//guardar dados do registo
			$cod_teste = $registo['cod_teste'];
			$dat_real_teste = $registo['dat_real_teste'];
			$hrs_real_teste = $registo['hrs_real_teste'];
			$cod_ut = $registo['cod_ut'];

/*
echo"</br>";echo"</br>";
echo $cod_teste; echo " - ";
echo $dat_real_teste; echo " - ";
echo $hrs_real_teste; echo " - ";
echo $cod_ut; echo " - ";
echo"</br>";echo"</br>";
*/

			$cod_perg1 = $registo['cod_perg1'];
			$cod_perg2 = $registo['cod_perg2'];
			$cod_perg3 = $registo['cod_perg3'];
			$cod_perg4 = $registo['cod_perg4'];
			$cod_perg5 = $registo['cod_perg5'];
			$cod_perg6 = $registo['cod_perg6'];
			$cod_perg7 = $registo['cod_perg7'];
			$cod_perg8 = $registo['cod_perg8'];
			$cod_perg9 = $registo['cod_perg9'];
			$cod_perg10 = $registo['cod_perg10'];

/*
echo"</br>";echo"</br>";
echo $cod_perg1; echo " - ";
echo $cod_perg2; echo " - ";
echo $cod_perg3; echo " - ";
echo $cod_perg4; echo " - ";
echo $cod_perg5; echo " - ";
echo $cod_perg6; echo " - ";
echo $cod_perg7; echo " - ";
echo $cod_perg8; echo " - ";
echo $cod_perg9; echo " - ";
echo $cod_perg10; echo " - ";
echo"</br>";echo"</br>";
*/

			$class_perg1 = $registo['class_perg1'];
			$class_perg2 = $registo['class_perg2'];
			$class_perg3 = $registo['class_perg3'];
			$class_perg4 = $registo['class_perg4'];
			$class_perg5 = $registo['class_perg5'];
			$class_perg6 = $registo['class_perg6'];
			$class_perg7 = $registo['class_perg7'];
			$class_perg8 = $registo['class_perg8'];
			$class_perg9 = $registo['class_perg9'];
			$class_perg10 = $registo['class_perg10'];

/*
echo $class_perg1; echo " - ";
echo $class_perg2; echo " - ";
echo $class_perg3; echo " - ";
echo $class_perg4; echo " - ";
echo $class_perg5; echo " - ";
echo $class_perg6; echo " - ";
echo $class_perg7; echo " - ";
echo $class_perg8; echo " - ";
echo $class_perg9; echo " - ";
echo $class_perg10; echo " - ";
echo"</br>";echo"</br>";
*/


			$concluido = $registo['concluido'];
			$class_final = $registo['class_final'];

/*
echo"</br>";echo"</br>";
echo $concluido; echo " - ";
echo $class_final; echo " - ";
*/


// guardar codigos de_perg em array

$A_cod_perg[1]=$cod_perg1;
$A_cod_perg[2]=$cod_perg2;
$A_cod_perg[3]=$cod_perg3;
$A_cod_perg[4]=$cod_perg4;
$A_cod_perg[5]=$cod_perg5;
$A_cod_perg[6]=$cod_perg6;
$A_cod_perg[7]=$cod_perg7;
$A_cod_perg[8]=$cod_perg8;
$A_cod_perg[9]=$cod_perg9;
$A_cod_perg[10]=$cod_perg10;

//mostrar conteúdo de array

/*
echo"</br>";echo"</br>";

echo " | ";

for($k=1;$k<=10;$k++)
{
  echo $A_cod_perg[$k]; echo " | ";

}
*/


//echo"</br>";echo"</br>";

//echo $cod_perg1; echo " - "; 
//if($class_perg1== NULL )echo "NULL";
//else echo $class_perg1;

//echo"</br>";echo"</br>";

// guardar class_perg em array V e F
// para mais facilmente percorrer todas as posições e testar conteúdo

if($class_perg1 != NULL) $A_class_perg[1] = $class_perg1;
if($class_perg2 != NULL) $A_class_perg[2] = $class_perg2;
if($class_perg3 != NULL) $A_class_perg[3] = $class_perg3;
if($class_perg4 != NULL) $A_class_perg[4] = $class_perg4;
if($class_perg5 != NULL) $A_class_perg[5] = $class_perg5;
if($class_perg6 != NULL) $A_class_perg[6] = $class_perg6;
if($class_perg7 != NULL) $A_class_perg[7] = $class_perg7;
if($class_perg8 != NULL) $A_class_perg[8] = $class_perg8;
if($class_perg9 != NULL) $A_class_perg[9] = $class_perg9;
if($class_perg10 != NULL) $A_class_perg[10] = $class_perg10;


/*
echo"</br>";echo"</br>";

			//mostrar conteúdo de array
		    echo " | ";

			for($k=1;$k<=10;$k++)
			{
  			  echo $A_class_perg[$k]; echo " | ";
			}
*/
		


		}
		//fim if último registo encontrado

	}
	//fim for fetch registos


//echo"</br>";echo"</br>";
//verificar agora se as questões já foram todas respondidas
		for($k=1;$k<=10;$k++)
		{
  			if($A_class_perg[$k] != '-')
  			{
				if($A_class_perg[$k] == 'V') $acumulador_class=$acumulador_class+10;

				// se k for igual a 10 o teste foi todo respondido e já se pode
				//apresentar classificação final (var acumulador_class)
				if($k==10)
				{
				  echo"<h2>JOGO TERMINADO</h2>";
				  echo"</br>";echo"</br>";
				  echo "RESULTADO FINAL:  ".$acumulador_class."% de RESPOSTAS CERTAS";
				  echo"</br>"; echo"</br>";
				  echo "<img src='imagens/trofeu.jpg' width='300px' height='350px'>";
				  echo"</br>";
				  echo"</br>";

			echo"<center>";


			echo"<table style='width: 60%;'> ";

			echo"<tr>";
			echo "<td style='color: red; text-align: center;'>0%-40%</td>";
			echo "<td style='color: yellow; text-align: center;'>50%-70%</td>";
			echo "<td style='color: green; text-align: center;'>80%-100%</td>";		
			//echo "<td style='color: yellow; text-align: center;'>login</td>";
			//echo "<td style='color: yellow; text-align: center;'>desc_oper</td>";
			echo"</tr>";
			
			echo"<tr>";
			echo "<td style='color: white; text-align: center;'>Mau! Necessitas de APRENDER mais sobre Segurança na internet</td>";
			echo "<td style='color: white; text-align: center;'>Razoável! Deves mesmo assim aprender mais sobre Segurança na Internet para te protegeres melhor!</td>";
			echo "<td style='color: white; text-align: center;'>Muito Bom! Mesmo que não tenhas atingido os 100% não significa que não te consigas proteger da Internet!</td>";		
			//echo "<td style='color: yellow; text-align: center;'>login</td>";
			//echo "<td style='color: yellow; text-align: center;'>desc_oper</td>";
			echo"</tr>";

			echo"</table>";

			echo"</center>";



				//Registar classificação na tabela JOGO
				//concluido S
				//class_final...

			    $alterar = "UPDATE JOGO
 			    SET concluido = 'S', class_final = ".$acumulador_class."

 			    Where cod_teste = ".$cod_teste."

			    ";

    			$result = mysqli_query($ligax, $alterar);

    			if($result ==0) echo '<p>Não alterado</p></BR>';


				  echo"</br>";
				  echo "<p style='color: orange;'>CORREÇÃO</p>";


// Apresentar aqui a correção das respostas erradas
//consultar o n total de perguntas existentes
	$consulta = "select * from JOGO Where cod_teste = ".$cod_teste."";
	$result = mysqli_query($ligax, $consulta);

	$nregistos = mysqli_num_rows($result);
	//echo"</br>";
	//echo 'N de testes encontrados:'.$nregistos;
	
		$registo = mysqli_fetch_assoc($result);
		
			//guardar dados do registo
			$cod_teste = $registo['cod_teste'];
			$dat_real_teste = $registo['dat_real_teste'];
			$hrs_real_teste = $registo['hrs_real_teste'];
			$cod_ut = $registo['cod_ut'];
			$cod_perg1=$registo['cod_perg1'];
			$cod_perg2=$registo['cod_perg2'];
			$cod_perg3=$registo['cod_perg3'];
			$cod_perg4=$registo['cod_perg4'];
			$cod_perg5=$registo['cod_perg5'];
			$cod_perg6=$registo['cod_perg6'];
			$cod_perg7=$registo['cod_perg7'];
			$cod_perg8=$registo['cod_perg8'];
			$cod_perg9=$registo['cod_perg9'];
			$cod_perg10=$registo['cod_perg10'];
			$class_perg1=$registo['class_perg1'];
			$class_perg2=$registo['class_perg2'];
			$class_perg3=$registo['class_perg3'];
			$class_perg4=$registo['class_perg4'];
			$class_perg5=$registo['class_perg5'];
			$class_perg6=$registo['class_perg6'];
			$class_perg7=$registo['class_perg7'];
			$class_perg8=$registo['class_perg8'];
			$class_perg9=$registo['class_perg9'];
			$class_perg10=$registo['class_perg10'];
/*
			echo"</br>";
			echo 'class_pergX:'.$class_perg1; echo"</br>";
			echo 'class_pergX:'.$class_perg2; echo"</br>";
			echo 'class_pergX:'.$class_perg3; echo"</br>";
			echo 'class_pergX:'.$class_perg4; echo"</br>";
			echo 'class_pergX:'.$class_perg5; echo"</br>";
			echo 'class_pergX:'.$class_perg6; echo"</br>";
			echo 'class_pergX:'.$class_perg7; echo"</br>";
			echo 'class_pergX:'.$class_perg8; echo"</br>";
			echo 'class_pergX:'.$class_perg9; echo"</br>";
			echo 'class_pergX:'.$class_perg10; echo"</br>";
*/

// criar arrays para guardar codigos de perguntas e classificações de respostas
			$A_P = ARRAY(0,0,0,0,0,0,0,0,0,0,0);
			$A_R = ARRAY('--','--','--','--','--','--','--','--','--','--','--');

			$A_P[1] = $cod_perg1;
			$A_P[2] = $cod_perg2;
			$A_P[3] = $cod_perg3;
			$A_P[4] = $cod_perg4;
			$A_P[5] = $cod_perg5;
			$A_P[6] = $cod_perg6;
			$A_P[7] = $cod_perg7;
			$A_P[8] = $cod_perg8;
			$A_P[9] = $cod_perg9;
			$A_P[10] = $cod_perg10;

			$A_R[1] = $class_perg1;
			$A_R[2] = $class_perg2;
			$A_R[3] = $class_perg3;
			$A_R[4] = $class_perg4;
			$A_R[5] = $class_perg5;
			$A_R[6] = $class_perg6;
			$A_R[7] = $class_perg7;
			$A_R[8] = $class_perg8;
			$A_R[9] = $class_perg9;
			$A_R[10] = $class_perg10;
			




echo"</br>";

//echo $A_RESPOSTAS[1][1]; echo "-";
//echo $A_RESPOSTAS[1][2]; echo "-";
//echo $A_RESPOSTAS[1][3];

			for($i=1;$i<=10;$i++)
			{

				if($A_R[$i] == 'F')
				{

				//echo 'cod_perg:'.$A_P[$i]; echo"</br>";
				//echo 'class_perg:'.$A_R[$i]; echo"</br>";
			$consulta_pergunta = "select * from PERGUNTAS WHERE cod_perg='".$A_P[$i]."'";
			$result_consulta_pergunta = mysqli_query($ligax, $consulta_pergunta);

			$nregistos_consulta_pergunta = mysqli_num_rows($result_consulta_pergunta);
			//echo 'N de respostas encontradas:'.$nregistos_consulta_pergunta;

			$registo_consulta_pergunta = mysqli_fetch_assoc($result_consulta_pergunta);

			$perg = $registo_consulta_pergunta['perg'];


			echo"<center>";


			echo"<table border= '1' style='width: 60%;'> ";

			echo"<tr>";
			echo "<td style='color: yellow;'>PERGUNTA</td>";		
			//echo "<td style='color: yellow; text-align: center;'>login</td>";
			//echo "<td style='color: yellow; text-align: center;'>desc_oper</td>";
			echo"</tr>";

			echo"<tr>";
			//echo "<td><a href="."forum_respostas_adm.php?cod_top=".$cod_top.">$msg_top</td>";
			echo '<td>'.$perg.'</td>';
			echo"</tr>";

			echo"</table>";

			echo"</center>";

			//Agora consultar e apresentar a resposta correta
			$consulta = "select * from RESPOSTAS WHERE cod_perg='".$A_P[$i]."'
			AND class_resp = 'V' ";

			$result = mysqli_query($ligax, $consulta);

			$nregistos = mysqli_num_rows($result);
			//echo 'N de respostas encontradas:'.$nregistos;
			$registo = mysqli_fetch_assoc($result);

			$resposta = $registo['resposta'];



			echo"<center>";


			echo"<table border= '1' style='width: 60%;'> ";

			echo"<tr>";
			echo "<td style='color: yellow;'>RESPOSTA CORRETA</td>";	
			//echo "<td style='color: yellow; text-align: center;'>desc_oper</td>";
			echo"</tr>";

			echo"<tr>";
			echo '<td>'.$resposta.'</td>';
			echo"</tr>";
		
  			echo"</table>";

  			echo"</center>";

			echo"</br>";echo"</br>";


				} 
				// fim de apresentar resposta correta para pergunta

			}
			// fim de ciclo de procurar perguntas falhadas







  				  echo"</br>";echo"</br>";
  				  echo"<table>";
				  echo"<tr>";
				  echo"<td colspan='3' align='center'>";
  				  echo "<a href='zona_jogo.php'>Voltar</a>";
  				  echo"</td>";
				  echo"</tr>";
  				  echo"</table>";

				}
  				// fim de resultados apresentados
  			}
  			else
  			{
  				//JOGAR - APRESENTAR PERGUNTA POR RESPONDER
  				//guardar o nº da pergunta para mais tarde concatenar e registar resposta
  				$numero_pergunta=$k;
  				echo"<h2>PERGUNTA ".$k."</h2>";
  				//echo"</br>";echo"</br>";
  				//Apresentar a primeira questão não respondida que encontrar
  				//echo "pergunta ".$k." código ".$A_cod_perg[$k];
  	
  	//Apresentar a pergunta antes das respostas possíveis
	$consulta_pergunta = "select * from PERGUNTAS WHERE cod_perg='".$A_cod_perg[$k]."'";
	$result_consulta_pergunta = mysqli_query($ligax, $consulta_pergunta);

	$nregistos_consulta_pergunta = mysqli_num_rows($result_consulta_pergunta);
	//echo 'N de respostas encontradas:'.$nregistos_consulta_pergunta;

		$registo_consulta_pergunta = mysqli_fetch_assoc($result_consulta_pergunta);

		$perg = $registo_consulta_pergunta['perg'];

//registar resposta como errada para evitar refresh

$campo="class_perg".$numero_pergunta;
//echo "CAMPO: ".$campo; echo "-";


    $alterar = "UPDATE JOGO
    SET class_perg".$numero_pergunta." = 'F'

    Where cod_teste = ".$cod_teste."

    ";

    $result = mysqli_query($ligax, $alterar);

    if($result ==0) echo '<p>Não alterado</p></BR>';






	echo"<center>";


	echo"<table border= '1' style='width: 60%;'> ";

		echo"<tr>";
		echo "<td style='color: yellow;'>PERGUNTA</td>";		
		//echo "<td style='color: yellow; text-align: center;'>login</td>";
		//echo "<td style='color: yellow; text-align: center;'>desc_oper</td>";
		echo"</tr>";

		echo"<tr>";
		//echo "<td><a href="."forum_respostas_adm.php?cod_top=".$cod_top.">$msg_top</td>";
		echo '<td>'.$perg.'</td>';
		echo"</tr>";

	echo"</table>";

	echo"</center>";

//	echo"</br>";echo"</br>";


	//Apresentar a primeira questão não respondida que encontrar
	$consulta = "select * from RESPOSTAS WHERE cod_perg='".$A_cod_perg[$k]."'";
	$result = mysqli_query($ligax, $consulta);

	$nregistos = mysqli_num_rows($result);
	//echo 'N de respostas encontradas:'.$nregistos;


//guardar as informações dos registos em 2 arrays: respostas e classificações de respostas
$A_RESPOSTAS = ARRAY(
ARRAY( 0, 0, '--', '-'),
ARRAY( 0, 0, '--', '-'),
ARRAY( 0, 0, '--', '-'),
ARRAY( 0, 0, '--', '-'),
ARRAY( 0, 0, '--', '-'),

  );

//echo"</br>";echo"</br>";

//echo $A_RESPOSTAS[1][1]; echo "-";
//echo $A_RESPOSTAS[1][2]; echo "-";
//echo $A_RESPOSTAS[1][3];


//echo"</br>";echo"</br>";


//Sortear respostas
	for($i=1;$i<=4;$i++)
	{
		$sorteado= rand(1,4);
		//echo $sorteado;
		//echo " - ";
		// verificar se o nº já saiu anteriormente
		for($j=1;$j<=4;$j++)
		{
			if($A_RESPOSTAS[$j][1]==$sorteado)
			{
				// n repetido
				$j=5;
				$i--;
			}
			elseif($A_RESPOSTAS[$j][1]==0)
			{
				$A_RESPOSTAS[$j][1]= $sorteado;
				$j=5;
				
			}

		}


	}


//mostrar as posições de apresentação sorteadas

/*
echo"</br>";echo"</br>";

echo $A_RESPOSTAS[1][1]; echo "-";
echo $A_RESPOSTAS[2][1]; echo "-";
echo $A_RESPOSTAS[3][1]; echo "-";
echo $A_RESPOSTAS[4][1]; echo "-";


echo"</br>";echo"</br>";
*/


//retirar dados da consulta com fetch		

	for($i=1; $i <=$nregistos; $i++) 
	{
		$registo = mysqli_fetch_assoc($result);

		$cod_resp = $registo['cod_resp'];
		$resposta = $registo['resposta'];
		$class_resp = $registo['class_resp'];
		
		//ciclo para encontrar possição no array correspondente à posição
		for($m=1;$m<=4;$m++)
		{
			if($A_RESPOSTAS[$m][1]==$i)
			{
				//Guardar cod_resp e class_resp no ARRAY
				$A_RESPOSTAS[$m][0]= $cod_resp;
				$A_RESPOSTAS[$m][2]= $resposta;
				$A_RESPOSTAS[$m][3]= $class_resp;

			}


		}

	
  	}



/*

echo"</br>";echo"</br>";

echo $A_RESPOSTAS[1][0]; echo "-";
echo $A_RESPOSTAS[1][1]; echo "-";
echo $A_RESPOSTAS[1][2]; echo "-";
echo $A_RESPOSTAS[1][3]; echo "-";echo"</br>";echo"</br>";

echo $A_RESPOSTAS[2][0]; echo "-";
echo $A_RESPOSTAS[2][1]; echo "-";
echo $A_RESPOSTAS[2][2]; echo "-";
echo $A_RESPOSTAS[2][3]; echo "-";echo"</br>";echo"</br>";

echo $A_RESPOSTAS[3][0]; echo "-";
echo $A_RESPOSTAS[3][1]; echo "-";
echo $A_RESPOSTAS[3][2]; echo "-";
echo $A_RESPOSTAS[3][3]; echo "-";echo"</br>";echo"</br>";

echo $A_RESPOSTAS[4][0]; echo "-";
echo $A_RESPOSTAS[4][1]; echo "-";
echo $A_RESPOSTAS[4][2]; echo "-";
echo $A_RESPOSTAS[4][3]; echo "-";


echo"</br>";echo"</br>";

*/



//mostrar as 4 respostas

	echo"<center>";


	echo"<table border= '1' style='width: 60%;'> ";

		echo"<tr>";
		echo "<td style='color: yellow;'>RESPOSTAS</td>";
		echo "<td style='color: yellow;'>SELECIONAR</td>"; 		
		//echo "<td style='color: yellow; text-align: center;'>login</td>";
		//echo "<td style='color: yellow; text-align: center;'>desc_oper</td>";
		echo"</tr>";

		echo"<tr>";
		//echo "<td><a href="."forum_respostas_adm.php?cod_top=".$cod_top.">$msg_top</td>";
		echo '<td>'.$A_RESPOSTAS[1][2].'</td>';
		if($A_RESPOSTAS[1][3]=='V')
		{ 
		  echo"<form name='form1' action='zona_jogo_registar_resposta.php' method='post'>";
		  echo"<input type='hidden' id='cod_teste' name='cod_teste' value='".$cod_teste."'>";
		  echo"<input type='hidden' id='numero_pergunta' name='numero_pergunta' value='".$numero_pergunta."'>";
		  echo"<input type='hidden' id='resposta' name='resposta' value='V'>";
		  echo "<td style='vertical-align: middle'><input type='submit' value='Opção1' class='button primary'></td>";
		  echo"</form>";
		}
		else
		{
		  echo"<form name='form2' action='zona_jogo_registar_resposta.php' method='post'>";
		  echo"<input type='hidden' id='cod_teste' name='cod_teste' value='".$cod_teste."'>";
		  echo"<input type='hidden' id='numero_pergunta' name='numero_pergunta' value='".$numero_pergunta."'>";
		  echo"<input type='hidden' id='resposta' name='resposta' value='F'>";
		  echo "<td style='vertical-align: middle'><input type='submit' value='Opção1' class='button primary'></td>";
		  echo"</form>";
		}
		//echo"<td>".$cod_teste."</td>";
		//echo"<td>-".$numero_pergunta."</td>";
		echo"</tr>";
		


		echo"<tr>";
		//echo "<td><a href="."forum_respostas_adm.php?cod_top=".$cod_top.">$msg_top</td>";
		echo '<td>'.$A_RESPOSTAS[2][2].'</td>';
		if($A_RESPOSTAS[2][3]=='V')
		{
		  echo"<form name='form3' action='zona_jogo_registar_resposta.php' method='post'>";
		  echo"<input type='hidden' id='cod_teste' name='cod_teste' value='".$cod_teste."'>";
		  echo"<input type='hidden' id='numero_pergunta' name='numero_pergunta' value='".$numero_pergunta."'>";
		  echo"<input type='hidden' id='resposta' name='resposta' value='V'>";				  
		  echo "<td style='vertical-align: middle'><input type='submit' value='Opção2' class='button primary'></td>";
		  echo"</form>";
		}
		else
		{	
		  echo"<form name='form4' action='zona_jogo_registar_resposta.php' method='post'>";
		  echo"<input type='hidden' id='cod_teste' name='cod_teste' value='".$cod_teste."'>";
		  echo"<input type='hidden' id='numero_pergunta' name='numero_pergunta' value='".$numero_pergunta."'>";
		  echo"<input type='hidden' id='resposta' name='resposta' value='F'>";
		  echo "<td style='vertical-align: middle'><input type='submit' value='Opção2' class='button primary'></td>";
		  echo"</form>";
		}
		//echo"<td>".$cod_teste."</td>";
		//echo"<td>-".$numero_pergunta."</td>";
		echo"</tr>";
		


		
		echo"<tr>";
		//echo "<td><a href="."forum_respostas_adm.php?cod_top=".$cod_top.">$msg_top</td>";
		echo '<td>'.$A_RESPOSTAS[3][2].'</td>';
		if($A_RESPOSTAS[3][3]=='V') 
		{ 
		  echo"<form name='form5' action='zona_jogo_registar_resposta.php' method='post'>";
		  echo"<input type='hidden' id='cod_teste' name='cod_teste' value='".$cod_teste."'>";
		  echo"<input type='hidden' id='numero_pergunta' name='numero_pergunta' value='".$numero_pergunta."'>";
		  echo"<input type='hidden' id='resposta' name='resposta' value='V'>";
		  echo "<td style='vertical-align: middle'><input type='submit' value='Opção3' class='button primary'></td>";
		  echo"</form>";
		}
		else
		{  
		  echo"<form name='form6' action='zona_jogo_registar_resposta.php' method='post'>";
		  echo"<input type='hidden' id='cod_teste' name='cod_teste' value='".$cod_teste."'>";
		  echo"<input type='hidden' id='numero_pergunta' name='numero_pergunta' value='".$numero_pergunta."'>";
		  echo"<input type='hidden' id='resposta' name='resposta' value='F'>";
		  echo "<td style='vertical-align: middle'><input type='submit' value='Opção3' class='button primary'></td>";
		  echo"</form>";
		}
		//echo"<td>".$cod_teste."</td>";
		//echo"<td>-".$numero_pergunta."</td>";		
		echo"</tr>";
		


		echo"<tr>";
		//echo "<td><a href="."forum_respostas_adm.php?cod_top=".$cod_top.">$msg_top</td>";
		echo '<td>'.$A_RESPOSTAS[4][2].'</td>';
		if($A_RESPOSTAS[4][3]=='V') 
		{ 
		  echo"<form name='form7' action='zona_jogo_registar_resposta.php' method='post'>";
		  echo"<input type='hidden' id='cod_teste' name='cod_teste' value='".$cod_teste."'>";
		  echo"<input type='hidden' id='numero_pergunta' name='numero_pergunta' value='".$numero_pergunta."'>";
		  echo"<input type='hidden' id='resposta' name='resposta' value='V'>";
		  echo "<td style='vertical-align: middle'><input type='submit' value='Opção4' class='button primary'></td>";
		  echo"</form>";
		}
		else
		{  
		  echo"<form name='form8' action='zona_jogo_registar_resposta.php' method='post'>";
		  echo"<input type='hidden' id='cod_teste' name='cod_teste' value='".$cod_teste."'>";
		  echo"<input type='hidden' id='numero_pergunta' name='numero_pergunta' value='".$numero_pergunta."'>";
		  echo"<input type='hidden' id='resposta' name='resposta' value='F'>";
		  echo "<td style='vertical-align: middle'><input type='submit' value='Opção4' class='button primary'></td>";
		  echo"</form>";
		}
		//echo"<td>".$cod_teste."</td>";
		//echo"<td>-".$numero_pergunta."</td>";		
		echo"</tr>";
		
	
		

  	echo"</table>";



  	echo"</center>";


?>
<FONT face=verdana size=10><B>
<DIV id=numberCountdown align=center style="color: yellow;"></DIV></FONT>


<?php


















echo"</br>";echo"</br>";

echo "</BR>";


				//provocar saida do ciclo ou reencaminhar para outro
				//ficheiro ou refresh
  				$k=11;

  			}
  			//fim else linha 282 (situação de questão não respondida)
		}
		//fim de verificação se todas as perguntas foram respondidas










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