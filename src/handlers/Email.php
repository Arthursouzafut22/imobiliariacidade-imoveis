<?php

namespace src\handlers;

use \src\handlers\Exception;
use \src\handlers\PHPMailer;
use \src\handlers\SMTP;
use \src\Config;
use src\models\LogEmailEnviado;

class Email
{
    public function __contruct()
    {
    }

    function enviarEmailSmtp($dados)
    {
        $mail = new PHPMailer(true);

        try {

            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->CharSet = "UTF-8";
            $mail->Port = $dados['email_remetente_porta_configuracao'];
            $mail->Host = $dados['email_remetente_smtp_configuracao'];
            $mail->Username = $dados['email_remetente_configuracao'];
            $mail->Password = $dados['email_remetente_senha_configuracao'];
            $mail->SetFrom($dados['email_remetente_configuracao'], $dados['assunto']);
            // $mail->addReplyTo($dados['emailresposta'], 'Não Responder');
            $mail->AddAddress($dados['destinatario'], $dados['assunto']);
            // (isset($dados['emailCopiaOculta']) ? $mail->AddBCC($dados['emailCopiaOculta'], $dados['assunto']) : '');

            if (!empty($dados['arquivo'])) {
                $mail->addAttachment($dados['arquivo']['tmp_name'], $dados['arquivo']['name']);
            }

            $mail->Subject = $dados['assunto'] . ' - ' . date('d/m/Y H:i:s');
            //$mail->SMTPSecure = $this->criptografia;
            $mail->MsgHTML($dados['mensagem']);

            if ($mail->Send()) {

                $reponse['mensagem'] = "E-mail enviao com sucesso!";
                $reponse['status'] = true;
                return $reponse;

            } else {

                $reponse['mensagem'] = "Erro ao enviar o e-mail";
                $reponse['status'] = false;
                return $reponse;
            }
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function enviarEmailPHPmail($dados)
    {
        // Gerar um identificador único para o limite do MIME
        $boundary = md5(uniqid(time()));

        // Cabeçalhos para definir o formato do e-mail e o remetente
        $headers = "From: " . $dados['email_remetente_configuracao'] . "\r\n" .
            // "Reply-To: " . $dados['emailresposta'] . "\r\n" .
            "MIME-Version: 1.0" . "\r\n" .
            "Content-Type: multipart/mixed; boundary=\"{$boundary}\"";

        // Corpo do e-mail em partes MIME
        $mensagem = "--{$boundary}\r\n";
        $mensagem .= "Content-Type: text/html; charset=UTF-8\r\n";
        $mensagem .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $mensagem .= $dados['mensagem'] . "\r\n";

        // Processar o anexo, se houver
        if (isset($dados['arquivo']) && !empty($dados['arquivo']) && $dados['arquivo'] && $dados['arquivo']['error'] === 0 && file_exists($dados['arquivo']['tmp_name'])) {
            // Ler o conteúdo do arquivo temporário
            $arquivoConteudo = file_get_contents($dados['arquivo']['tmp_name']);
            $arquivoConteudo = chunk_split(base64_encode($arquivoConteudo));

            // Nome do arquivo
            $nomeArquivo = $dados['arquivo']['name'];

            // Anexar o arquivo ao corpo do e-mail
            $mensagem .= "--{$boundary}\r\n";
            $mensagem .= "Content-Type: " . $dados['arquivo']['type'] . "; name=\"{$nomeArquivo}\"\r\n";
            $mensagem .= "Content-Transfer-Encoding: base64\r\n";
            $mensagem .= "Content-Disposition: attachment; filename=\"{$nomeArquivo}\"\r\n\r\n";
            $mensagem .= $arquivoConteudo . "\r\n";
        }

        // Finalizar o limite
        $mensagem .= "--{$boundary}--";

        // Usando a função mail() para enviar o e-mail
        if (mail($dados['destinatario'], $dados['assunto'] . ' - ' . date('d/m/Y'), $mensagem, $headers)) {
            return [
                'mensagem' => "E-mail enviao com sucesso!",
                'status' => true
            ];
        } else {
            return [
                'mensagem' => "E-mail enviao com sucesso!",
                'status' => false
            ];
        }
    }

}
