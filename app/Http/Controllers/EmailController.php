<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;



class EmailController extends Controller
{

    public function sendEmail(Request $request)
    {

        $mensagem = "<p>Nome: <strong>" . $request->nome . "</strong></p>" .
            "<p>Email: <strong>" . $request->email . "</strong></p>" .
            "<p>Telefone/WhatsApp: <strong>" . $request->telefone . "</strong></p>" .
            "<p>Mensagem: <strong>" . $request->mensagem . "</strong></p>";

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("daniel.araujo@stylorit.com.br", "Contato Stylorit");
        $email->setSubject("Email de contato");
        $email->addTo("stylorit@hotmail.com", "Stylorit");
        // $email->addTo("roda-vitor2@outlook.com", "Stylorit");
        $email->addContent("text/html", $mensagem);
        $sendgrid = new \SendGrid('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');
        try {
            $response = $sendgrid->send($email);
            return $response->statusCode();
        } catch (Exception $e) {
            echo $e;
        }
    }
}
