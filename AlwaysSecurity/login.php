<?php
//obtem os valores digitador
$login = $_POST["login"];
$senha = $_POST["senha"];
//acessa a base de dados
$cn = mysqli_connect("localhost", "root", "");
mysqli_select_db($cn,"asecurity_bd");

$resultado = mysqli_query($cn,"select * from UTILIZADORES where login = '$login'");
$linhas = mysqli_num_rows($resultado);
if ($linhas ==0)//testa se a consulta retornou algum registro
{
echo "Utilizador n&atilde;o encontrado";
echo "<a href=login.html> voltar atrás!</a>";
} else {

    $registo = mysqli_fetch_assoc($resultado);
$cod_ut = $registo['cod_ut'];

    if ($senha != $registo['senha'])//confere a senha
    {
       echo "<p>Senha inválida</p>";
       echo "<a href=login.html> voltar atrás!</a>"; 
    }else{//utilizador correto.. vamos criar os cookies com sessions...
    session_start();//nunca esqueça de por isso antes de usar session
    $_SESSION["login"] = $login;
    $_SESSION["senha"] = $senha;
    
    // redireciona par a pagina principal

    $ligar=mysqli_connect ('localhost','root','');

    if(!$ligar)
        {echo  '<p>Erro: Falha na ligação.</p>';exit;}

    mysqli_select_db($ligar,'asecurity_bd');

    //Testar se o utilizador já existe

    $ano=date("y");
    $mes=date("m");
    $dia=date("d");
    $data=$ano."-".$mes."-".$dia;
    echo$data;

    $hora=date("H");
    $min=date("i");
    $seg=date("s");
    $hora=$hora.":".$min.":".$seg;
    echo$hora;

    $alterar = "UPDATE utilizadores
    SET dat_ult_login = '".$data."', hrs_ult_login = '".$hora."'

    Where login = '".$_SESSION["login"]."'

    ";

    $result = mysqli_query($ligar, $alterar);

    if($result ==0) echo '<p>Não alterado</p></BR>';


// registar login em LOGS
  $inserir="INSERT into LOGS values
  ('',$cod_ut,'".$data."','".$hora."','".$data."','".$hora."',6)";

  $result=mysqli_query($ligar,$inserir);

  if($result!=1) echo '<p>Erro no registo! Tente novamente!</p></br>';
  //else 
  //echo"<p>Log Registado com sucesso!</p></br>";




    header("Location: pagina_principal.php");
    }
}
mysqli_close($cn);
?>