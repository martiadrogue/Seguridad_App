<?php

namespace Common;

use PHPMailer;

class MailSender
{
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer;

        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'mpwar.seguretat@gmail.com';
        $this->mail->Password = 'seguretat';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;
        $this->mail->From = 'mpwar.seguretat@gmail.com';
        $this->mail->FromName = 'Seguretat Admin';
    }

    public function sendMailRegisterVerification($para, $hash)
    {
        $this->mail->addAddress($para);
        $this->mail->isHTML(true);
        $this->mail->Subject = 'Activacion cuenta usuario en seguridad.dev';
        $this->mail->Body = 'Hola, ya casi hemos terminado, para activar tu cuenta en Seguridad.dev sólo debes hacer click en el siguiente enlace. Ten en cuenta que si no lo haces no podrás entrar en tu cuenta  http://www.seguridad.dev/accountverification/' . $hash;
        $this->mail->AltBody = 'Hola, ya casi hemos terminado, para activar tu cuenta en Seguridad.dev sólo debes hacer click en el siguiente enlace. Ten en cuenta que si no lo haces no podrás entrar en tu cuenta  http://www.seguridad.dev/accountverification/' . $hash;

        $this->mail->send();
    }

    public function sendMailPasswordRecovery($para, $hash)
    {
        $this->mail->addAddress($para);
        $this->mail->isHTML(true);
        $this->mail->Subject = 'Recuperación contraseña en seguridad.dev';
        $this->mail->Body    = 'Hola, ya casi hemos terminado, para cambiar tu password en Seguridad.dev sólo debes hacer click en el siguiente enlace.  http://www.seguridad.dev/changepassword/' . $hash;
        $this->mail->AltBody    = 'Hola, ya casi hemos terminado, para cambiar tu password en Seguridad.dev sólo debes hacer click en el siguiente enlace.  http://www.seguridad.dev/changepassword/' . $hash;

        $this->mail->send();
    }
}
