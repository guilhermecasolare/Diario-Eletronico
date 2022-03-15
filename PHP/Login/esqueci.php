<?php

$cod = uniqid(rand());
$email = $_POST['email'];

//Importar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer-6.6.0/src/PHPmailer.php';
require 'PHPMailer-6.6.0/src/SMTP.php';
require 'PHPMailer-6.6.0/src/Exception.php';

//Conecta no banco de dados

$mysql = mysqli_connect('localhost','root','');
mysqli_select_db($mysql,'diario');

//Recebe dados

$sql = "SELECT `usuario`, `email`, `ativo` FROM `login` WHERE (`email` = '".$email."') AND (`ativo` = 1)";
$query = mysqli_query($mysql,$sql);
$dados = mysqli_fetch_assoc($query);

//Verifica se o Email existe

if(mysqli_num_rows($query)==1){

//Insere dados
$inserir = "INSERT INTO `troca_de_senha` (`email`, `codigo`, `data`) VALUES ('$email', '$cod', current_timestamp());";
$queryinserir = mysqli_query($mysql,$inserir);

//Cria nova instancia

$mail = new PHPMailer;

//Definir caracteres látinos

$mail->CharSet = 'UTF-8';

//Usar SMTP (Simple Mail Transfer Protocol)

$mail->isSMTP();

$mail->Host = 'smtp.gmail.com';

//Número da porta SMTP

$mail->Port = 587;

//Define o sistema de criptografia

$mail->SMTPSecure = 'tls';

//autenticação SMTP

$mail->SMTPAuth = true;

//Email que vai enviar

$mail->Username //= "mousessmails@gmail.com";

//Senha do Email

$mail->Password //= "senha";

//Remetente

$mail->setFrom('mousessmails@gmail.com', 'MouseSS');

//Destinatário

$mail->addAddress($dados['email'], $dados['nome']);

//Assunto

$mail->Subject = 'Recuperação de senha - Diário Eletrônico';

//Anexar imagem

//$mail->addAttachment('');

//Corpo do Email

$mail->Body = 'Olá, '.$dados['usuario'].'

Você solicitou alteração de sua senha.

Clique no link abaixo para alterá-la. Caso não tenha realizado tal solicitação, por favor, desconsidere esse e-mail.

26.89.240.80/login/recuperarform.php?cod='.$cod.'

Atenciosamente,

Equipe MouseSS';

//Enviar e verificar se há errors

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Email enviado com sucesso! <br> Verifique a caixa de spam.";
}


}else{
    echo "Este Email não está registrado!";
}
