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
	<body class="landing is-preload">
	<iframe src="imagens/silence.mp3" allow="autoplay" id="audio" style="display: none"></iframe>

	<audio  autoplay="autoplay" loop preload="preload">
		<source src="imagens/musica.wav" type="audio/wav">
	</audio>
		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1>Always Security</h1>
						<p align="center" style="color:Yellow; font-weight: bolder;"><?php echo "Olá ".$login."!"; ?></p>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="adm_pagina_principal.php">Área Administradora</a></li>
											<li><a href="definicaosi_adm.php">O que é Segurança na Internet</a></li>
											<li><a href="sredeswifi_adm.php">Segurança Redes Wi-Fi</a></li>
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

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<h2>Always Security</h2>
							<p><img src="imagens/logotipopap.jpg" width="300px" height="200px"></p>
							<p><b><u>One for all and all for one</u></b></p>
							<p>Done by: <a href="https://instagram.com/maddiie_2311?igshid=6ly2p0yxyaq2">Sofia Silva</a></p>
							<p><b>Canal Youtube:</b><br /><a href="https://www.youtube.com/channel/UCDoF9llATdrvYd0LiTs1Nxg"><img src="imagens/youtube.png" width="80px" height="80px"></a></p><br />
						<a href="#one" class="more scrolly">Mais Informações</a>
						</div>
					</section>

				<!-- One -->
					<section id="one" class="wrapper style1 special">
						<div class="inner">
							<header class="major">
								<h2 style="color:Yellow;">Quem sou?</h2>
								<p>O meu nome é <a href="https://instagram.com/maddiie_2311?igshid=6ly2p0yxyaq2">Sofia Silva</a> e sou estudante na Escola Secundária de Barcelos no Curso Técnico Profissional de Gestão de Equipamentos Informáticos, no 12º ano. Esta finalidade foi criada através de um projeto PAP com intuito que demonstrar o meu conhecimento informático. Pretendo com este website ajudar os utilizadores de internet que não adquirem o conhecimento sobre segurança na internet. Este website oferece:
								<ul align="left">
                                <li><b>Informação escrita sobre segurança na internet</b></li>
                                <li><b>Fórum de comunicação para todos os utilizadores</b></li>
                                <li><b>Jogo de perguntas e respostas para avaliar o conhecimento do utilziador sobre segurança na internet</b></li>
                                <li><b>Vídeos informativos sobre segurança na internet (através do canal de youtube)</b></li>
                            	</ul>
                            	</p>
							</header>
							<ul class="actions special" align="center">
								<li><a href="forum_topicos_adm.php" class="button primary">Fórum de Comunicação</a></li>
								<li><a href="adm_area_jogo.php" class="button primary">Administração Jogo</a></li>
								<li><a href="https://www.youtube.com/channel/UCDoF9llATdrvYd0LiTs1Nxg" class="button primary">Ver vídeos</a></li>
							</ul>
						</div>
					</section>

				<!-- Two -->
					<section id="two" class="wrapper alt style2">
						<section class="spotlight">
							<div class="image"><img src="imagens/logotipopap.jpg" width="100px" height="600px" alt="" /></div><div class="content">
								<h2 align="center" style="color:Yellow;">Porquê Segurança na Internet?</h2>
								<p align="center">"Esta área da informática sempre me atraiu desde que frequento o curso ligado à informática pois obtive informação mais abrangente sobre a informática e também por gostar de ajudar as pessoas. Pretendo também seguir estudos nesta área da segurança informática para que um dia possa viver a trabalhar numa área que me fascina. Penso também que as pessoas nos dias de hoje deveriam conhecer mais sobre segurança na internet por a internet ser muito utilizada nos dias de hoje para diversos recursos e também por concluir que a internet cada vez mais irá servir para o nosso quotidiano. Assim sendo, é importante que este assunto seja tratado de um modo mais dinâmico e repentinamente para que todas as pessoas consigam obter conhecimento de uma maneira mais facilitada e divertida."</p>
								<h5 align="right"><p><b>Sofia Silva</b></p></h5>
							</div>
						</section>
						<section class="spotlight">
							<div class="image"><img src="imagens/security.jpg" height="600px" alt="" /></div><div class="content">
								<h2 align="center" style="color:Yellow;">Importância da Segurança na Internet</h2>
								<p align="center">O tema da segurança na internet é um tema importante no presente quotidiano e será ainda mais importante no futuro pois a internet é utilizada por todas as faxas etárias para diversos recursos, quer seja por trabalho, lazer ou até por vida pessoal e diversas atividades feitas pelo homem estaram em desuso daqui a uns anos. Por exemplo, a maioria das pessoas nos dias de hoje utilizam sites/aplicações online para fazer as suas transferências de dinheiro e, no caso de não existir a devida segurança, as pessoas poderão ter problemas nas suas contas bancárias. Infelizmente, nem todas as pessoas tem a possibilidade de conhecer os diversos problemas da internet e, por vezes, poderão correr riscos graves.</p> 
							</div>
						</section>
						<section class="spotlight">
							<div class="image"><img src="imagens/histinternet.jpg" height="600px" alt="" /></div><div class="content">
								<h2 align="center" style="color:Yellow;">Histórias Verídicas</h2>
								<p align="center">Este website contêm uma página de experiências verídicas sendo que é importante os utilizadores perceberem que este tema de facto é importante pois os problemas por falta de segurança na internet infelizmente acontecem e é uma forma de alertar para que a informação "não entre por um ouvido e saia pelo outro".</p>
								<p align="center">Aceda a esta página de modo mais rápido clicando no botão apresentado a baixo.</p>
								<ul class="actions special" align="center">
								<li><a href="expveridicas_log.php" class="button primary">Experiências Verídicas</a></li>
								</ul>
							</div>
						</section>
						<section class="spotlight">
							<div class="image"><img src="imagens/estuestac.jpg" height="600px" alt="" /></div><div class="content">
								<h2 align="center" style="color:Yellow;">Estatísticas</h2>
								<p align="center">Este website contêm uma página de estatísticas de um estudo feito a jovens entre os 12 e os 15 anos sobre o seu conhecimento de segurança na internet pois é um modo explícito do conhecimento dos jovens destas idades, na maioria, nos dias de hoje.</p>  
								<p align="center">Aceda a esta página de modo mais rápido clicando no botão apresentado a baixo.</p>
								<ul class="actions special" align="center">
								<li><a href="stuestac_.php" class="button primary">Estatísticas</a></li>
								</ul>
							</div>
						</section>
					</section>

					<section>
						<br />
					<h3 align="center" style="color:Yellow;">Filmes e Séries</h3>
					<p align="center"> Está representado nas tabelas abaixo filmes e séries existentes relacionadas com o tema da segurança da internet, quanto á sua importância para a informática e para os utilizadores de internet, como também demmonstra a quantidade de "crimes" que um hacker pode cometer com a mínima falta de segurança na internet.</p>
					<p align="center">(Carrega nas imagens para assistires ao trailer)</p>   
									<div class="table-wrapper">
										<table class="alt" align="center">
											<thead>
												<tr>
													<td align="center"><span style="color:Yellow; font-weight: bolder;">Filme</
														span></td>
													<td align="center"><span style="color:Yellow; font-weight: bolder;">Descrição</span></td>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td align="center"><b>Trust (2010)<a href="https://www.youtube.com/watch?v=RlXj9VGHDaM"><img src="imagens/trust.jpg" width="100"></b></td>
													<td align="center">Os pais da jovem Anne resolvem presenteá-la com um computador em seu aniversário. Ao entrar em uma sala de bate-papo, conhece um rapaz chamado Charlie e rapidamente envolve-se virtualmente com ele. No entanto, a amizade repentina da filha irá mudar a vida de toda a família. É considerado um filme de <b>Thriller</b> e <b>Drama</b>. <p style="color:Red; font-weight: bolder;"><u>O próximo parágrafo contém spoiler!</u></p><p>Este filme representa três crimes contudo, o que realça mais é o <b>grooming</b> pois existe conversas online entre uma adolescente de 14 anos e um homem de 35 anos. Podemos observar também neste filme <b>cyberbullying</b> e <b>sexting</b> visto que algumas imagens da menina filmada acabam por aparecer na internet. Por último, podemos verificar também a falta de proteção dos pais sendo que a menina é menor de idade.</p></td>
												</tr>
												<tr>
													<td align="center"><b>Unfriended (2014)<br/><a href="https://www.youtube.com/watch?v=Q72LWqCx3pc"><img src="imagens/unfriended.jpg" width="100"></b></td>
													<td align="center">Blaire, Mitch, Jess, Adam, Ken e Val estão em uma sala de bate-papo quando são surpreendidos pela chegada de um utilizador conhecido apenas como "Billie227". Achando que se trata somente de um problema técnico, os amigos continuam a conversar, até que Blaire começa a receber mensagens de alguém que se diz ser Laura Barns, uma colega de turma que se suicidou há um ano. Enquanto Blaire tenta descobrir a identidade de Billie, seus amigos são forçados a confrontar seus segredos mais obscuros.  É considerado um filme de <b>Thriller</b> e <b>Terror</b>.<p style="color:Red; font-weight: bolder;"><u>Os próximos parágrafos contêm spoiler!</u></p><p>Este filme demonstra diversos crimes como:</p><ul><li align="left"><u>Cyberbullying</u> - Demonstra um vídeo polémico na internet de uma rapariga que acaba por cometer suicídio;</li><li align="left"><u>Ransomware</u> - o hacker teve capacidade de colocar trojans nos computadores do grupo de amigos;</li><li align="left"><u>Spyware</u> - o hacker teve a capacidade de monitorar os computadores do grupo de amigos a ponto de os próprios amigos pensarem que poderia ser algum deles a fazer aquilo;</li><li align="left"><u>Vírus</u> - o hacker teve a capacidade de retirar funções habituais nas aplicações demonstradas (Skype, Facebook e Gmail) utilizando algum vírus provando assim que a internet e essas aplicações não possuiam a devida segurança que deviriam possuir;</li><li align="left"><u>Sexting</u> - numa altura do filme é mostrada o vazamento de um vídeo "porno" na internet sem o consentimento dos amigos Adam e Blaire.</li></td>
												</tr>
												<tr>
													<td align="center"><b>Hacker (2016)<a href="https://www.youtube.com/watch?v=C7QaZe8DloY"><img src="imagens/hacker.jpg" width="100"></b></td>
													<td align="center">Alex Danyliuk passa a ter problemas financeiros em sua família e procura no crime uma solução para a situação. Com a ajuda de Sye, um bandido que atua na internet, ele passa a roubar a identidade das pessoas e a realizar pequenos desvios de dinheiro. Suas ações logo chamam a atenção de Z, uma figura mascarada e ameaçadora, líder de uma organização conhecida como "Anonymous", um dos criminosos virtuais mais procurados pelo FBI. É considerado um filme de <b>Thriller</b> e <b>Crime</b>.<p style="color:Red; font-weight: bolder;"><u>Os próximos parágrafos contêm spoiler!</u></p><p>Neste filme podemos observar os seguintes crimes:</p><ul><li align="left"><u>Key Logger</u> - demonstra a facilidade com que os hacker conseguiam obter informação bancária e roubar dinheiro através de um software que fornecia esses dados;</li><li align="left"><u>Vírus</u> - os hackers tinham grande facilidade em colocar vírus em bancos;</li><li align="left"><u>Ransomware</u> - demonstra no filme quando Alex se quer vingar de um banco por terem despedido a sua mãe ele a conseguir invadir a segurança do banco por falta de segurança onde o mesmo menciona as <b>firewalls</b> serem fáceis de encriptar.</li></ul><p>Ao longo do filme observamos também a insegurança existente nos bancos (por exemplo nas transferências bancárias), como também na internet em geral sendo que as pessoas por trás da <b>DeepWeb</b> conseguiam dominar tudo o que quisessem.</p></td>
												</tr>
												<tr>
													<td align="center"><b>Ferrugem (2018)<a href="https://www.youtube.com/watch?v=4rU9qLuzYmU"><img src="imagens/ferrugem.jpg" width="100"></b></td>
													<td align="center">A adolescente Tati adora compartilhar sua vida nas redes sociais. Mas ela precisa amadurecer e lidar com as consequências, depois de algo que ela não queria que se tornasse público é divulgado no grupo do WhatsApp de sua turma de colégio. É considerado um filme de <b>Drama</b>.<p style="color:Red; font-weight: bolder;"><u>Os próximos parágrafos contêm spoiler!</u></p><p> Este filme relata dois crimes que infelizmente aconteçem imenso quando se fala em adolescentes pois estes não sabem os perigos que poderão correr fazendo-as. O primeiro crime relatado é o <b>sexting</b> pois é vazado nas redes sociais e num website de porno um vídeo de uma menina conjuntamente com seu ex-namorado. É demonstrado também <b>cyberbullying</b> pois as pessoas que frequentam a escola gozam apenas com a menina a ponto de esta se suicidar. Por último, sobresalta também neste filme o facto de a menina postar tudo da vida dela nas redes sociais sem noção dos perigos que corria.</p><p>Este filme é bom para que as pessoas do sexo feminino tenham noção que devem ter mais cuidados que os rapazes pois infelizmente a sociedade não olha com os mesmos olhos para ambos os sexos. Como foi visto no filme, o vídeo que foi vazado continha um rapaz e uma menina e o rapaz foi visto como o maior e a menina foi vista como uma p*ta, sendo que estavam os dois a fazer o mesmo em vídeo.</p></td>
												</tr>
												<tr>
													<td align="center"><b>The Social Dilemma (2020)<a href="https://www.youtube.com/watch?v=uaaC57tcci0"><img src="imagens/thesocialdilemma.jpg" width="100"></b></td>
													<td align="center">Esta longa-metragem mostra como os "magos" da tecnologia possuem o controle sobre a maneira em que pensamos, agimos e vivemos. Frequentadores do Vale do Silício revelam como as plataformas de redes sociais estão reprogramando a sociedade e sua forma de ver a vida. Este filme é um <b>Documentário</b>.<p style="color:Red; font-weight: bolder;"><u>O próximo parágrafo contém spoiler!</u></p><p>Este documentário para além de tratar da insegurança das redes sociais, retrata também na influência das mesmas na vida dos seres humanos, principalmente nos adolescentes. Para além deste assunto fugir um pouco ao objetivo da segurança na internet, é importante também relatar pois infelizmente o vício das redes sociais consegue colocar as pessoas depressivas e a comunicarem menos com as suas famílias e amigos no dia à dia.</p></td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"></td>
												</tr>
											</tfoot>
										</table>
										<table class="alt" align="center">
											<thead>
												<tr>
													<td align="center"><span style="color:Yellow; font-weight: bolder;">Série</span></td>
													<td align="center"><span style="color:Yellow; font-weight: bolder;">Descrição</span></td>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td align="center"><b>Scorpion (2014)<a href="https://www.youtube.com/watch?v=l4QFpheS_JQ"><img src="imagens/scorpion.jpg" width="100"></b></td>
													<td align="center">Gênio e excêntrico, Walter O'Brien comanda um grupo de mentes brilhantes, porém socialmente desajustadas, que compõem a equipe Scorpion, criada para defender o país de ameaças tecnológicas e digitais. É uma série de <b>Drama</b>.<p style="color:Red; font-weight: bolder;"><u>O próximo parágrafo contém spoiler!</u></p><p>Esta série demonstra o funcionamento em geral da tecnologia, internet, entre outros com objetivo de alertar o poder das mesmas na sociedade e a importância destas deverem ser seguras, sendo que a facilidade de harckear é imensa, como demonstrado ao longo da série. Durante a visualização da série, verificamos também que são abordados temas de ameaças na internet/tecnologia como o <b>Ransomware</b>, <b>Malware</b>, <b>Firewalls</b>, <b>Credenciais</b>, entre outros.</td>
												</tr>
												<tr>
													<td align="center"><b>Dark Net (2016)<a href="https://www.youtube.com/watch?v=SO11jKFMN9Q"><img src="imagens/darknet.jpg" width="100"></b></td>
													<td align="center">É uma série criada por Mati Kochavi que explora a dark web e a tecnologia, além de temas como biohacking, cyber-sequestro, guerra digital, cultos on-line, dependência de pornografia e strippers de webcam. Esta série é um <b>Documentário</b>.<p style="color:Red; font-weight: bolder;"><u>Os próximos parágrafos contêm spoiler!</u></p><p>Esta série refere a segurança e os problemas existentes na tecnologia e na internet, referindo também as suas vantagens e desvantagens. Esta alerta também sobre aplicações (a maioria) que guardam a nossa localização, senhas, etc., sobre os dados armazenados em bases de dados de tudo que fazemos na tecnologia e sobre a <b>Deep Web</b> (hackers). Por fim, esta série retrata também sobre ameaças maiores existentes no uso da internet como <b>Sexting</b>, <b>Grooming</b>, <b>Ransomware</b>, <b>Stalking</b> e <b>Spyware</b>.</p><p>É uma série educativa para todas as idades (que utilizam tecnologia e internet) pois após a visualização da mesma perceberão que sempre utilizaram mal a tecnologia e a internet, sem segurança alguma. Por ser uma série documentária, esta apenas retrata situações verídicas.</p></td>
												</tr>
												<tr>
													<td align="center"><b>Don't F**k With Cats (2019)<a href="https://www.youtube.com/watch?v=x41SMm-9-i4"><img src="imagens/dontfuckwithcats.jpg" width="100"></b></td>
													<td align="center">É uma série de crimes reais do ano de 2019 sobre uma caçada humana online. Esta série é um <b>Documentário</b>.<p style="color:Red; font-weight: bolder;"><u>O próximo parágrafo contém spoiler!</u></p><p>Nesta série podemos observar de um modo geral perigos existentes nas redes sociais (para além dos crimes por vídeo que o serial killer postava na internet) como a possibilidade de falsa identidade, ou seja, a possibilidade de fazer-nos passar por outras pessoas e também do facto de conseguirmos descobrir qualquer informação sobre alguém na internet, como por exemplo a sua idade, onde mora, onde se localiza naquele momento, etc..</p></td>
												</tr>
												<tr>
													<td align="center"><b>Control Z (2020)<a href="https://www.youtube.com/watch?v=3GU_SDZ_wJs"><img src="imagens/controlz.jpg" width="100"></b></td>
													<td align="center">Nesta série trata de um hacker que divulga um segredo íntimo de uma das alunas, levando a uma mudanca completa na ordem social típica do ensino médio. Sofia Herrera (Ana Valeria Becerril), uma adolescente introvertida e nada popular, resolve descobrir a identidade do misterioso transgressor antes que mais vazamentos aconteçam. Ninguém está a salvo de suspeita. É uma série de <b>Drama</b>. <p style="color:Red; font-weight: bolder;"><u>Os próximos parágrafos contêm spoiler!</u></p><p>Nesta série podemos observar os seguintes crimes:</p><ul><li align="left"><u>Vishing</u> - o hacker contacta com as suas vítimas ameaçando-as para que lhe dê informações de seu interesse;</li><li align="left"><u>Cyberbullying</u> - as pessoas que tiveram os seus segredos revelados foram gozadas pelas pessoas que frequentavam a escola;</li><li align="left"><u>Sexting</u> - quando revelam o segredo de Pablo, é demonstrado imagens eróticas do mesmo sem o consentimento do mesmo.</li></ul><p>A série representa também a insegurança existente no router da escola pois mostra a facilidade com que o hacker harqueou o mesmo.</p></td>
												</tr>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="2"></td>
												</tr>
											</tfoot>
										</table>
									</div>
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