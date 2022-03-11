<?php


//Importar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer-master/src/PHPmailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

//Receber dado por POST

$email = $_POST['email'];

//Conecta no banco de dados

$mysql = mysqli_connect('localhost','root','');
mysqli_select_db($mysql,'diario');

//Recebe dados

$sql = "SELECT `nome`, `email`, `ativo` FROM `login` WHERE (`email` = '".$email."') AND (`ativo` = 1)";
$query = mysqli_query($mysql,$sql);
$dados = mysqli_fetch_assoc($query);

//Verifica se o Email existe

if(mysqli_num_rows($query)==1){


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

$mail->Username /* = "email"*/;

//Senha do Email

$mail->Password /* = "senha"*/;

//Remetente

$mail->setFrom('mousessmails@gmail.com', 'MouseSS');

//Destinatário

$mail->addAddress($dados['email'], 'Rafael de Oliveira Sigolo');

//Assunto

$mail->Subject = 'Recuperação de senha - Diário Eletrônico';

//Anexar imagem

//$mail->addAttachment('');

//Corpo do Email

$mail->Body = 'Olá, '.$dados['nome'].'

Você solicitou alteração de sua senha.

Clique no link abaixo para alterá-la. Caso não tenha realizado tal solicitação, por favor, desconsidere esse e-mail.

LINK

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
