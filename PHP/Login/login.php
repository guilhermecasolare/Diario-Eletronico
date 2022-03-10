<?php

//Recebe dados do formulário

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

//Conecta no banco de dados

mysql_connect('localhost','root','');
mysql_select_db('diario');

//Recebe dados

$sql = "SELECT `senha`, `nome`, `nivel`, `ativo` FROM `login` WHERE (`usuario` = '".$usuario."') AND (`senha` = '".$senha."') AND (`ativo` = 1)";
$query = mysql_query($sql);
$dados = mysql_fetch_assoc($query);

//Verifica se é professor ou admin

if($dados['nivel'] == 2){
    $nivel = "Admin";
}else{
    $nivel = "Professor";
}

//Saída

if(mysql_num_rows($query)==1){
    echo "Bem-vindo, ".$nivel." ".$dados['nome'];
}else{
    echo "USUÁRIO OU SENHA INVALIDO";
}
?>