<?php
session_start();
if (isset($_SESSION["login"]) AND isset($_SESSION["senha"])) {
    $login = $_SESSION["login"];
    $senha = $_SESSION["senha"];
}else{
echo "Não efetuou o login.";
exit();/*caso nao tinha session.. quer dizer.. ele nao entra*/
} /*aqui primeiro ele checa para ver se exite essas Sessoes, e depois ele coloca o valor das sessoes nessas variaveis... para fazermos os testes!*/

if(!(empty($login) OR empty($senha)))
{
//acede ao banco de dados
$cn = mysqli_connect("localhost", "root", "");
mysqli_select_db($cn,"asecurity_bd");
$resultado = mysqli_query($cn,"select * from utilizadores where login = '$login'");
if (mysqli_num_rows($resultado) == 1)/*caso exista esse login.. vamos testar a senha entao*/
{
   $registo = mysqli_fetch_assoc($resultado);
   if ($senha != $registo['senha'])
   {
       unset ($_SESSION["login"]);/*apaga a session que existia mas era errada..*/
       unset ($_SESSION["senha"]);
       echo "Não efetuou o login.";
       exit();
   } 
}else {
       unset ($_SESSION["login"]);
       unset ($_SESSION["senha"]);
       echo "Não efetuou o login.";
       exit();
}

}else{
echo "Não efetuou o login.";
exit();/*caso das sessions estarem vazias*/
}
mysqli_close($cn);
?>