<?php

namespace Common;

class MailSender
{
    public function sendMailRegisterVerification($para, $hash)
    {
        $titulo    = 'Activacion cuenta usuario en seguridad.dev';
        $mensaje   = 'Hola, ya casi hemos terminado, para activar tu cuenta en Seguridad.dev sólo debes hacer click en el siguiente enlace. Ten en cuenta que si no lo haces no podrás entrar en tu cuenta  http://www.seguridad.dev/accountverification/' . $hash;
        $cabeceras = 'From: webmaster@example.com' . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
        mail($para, $titulo, $mensaje, $cabeceras);
    }

    public function sendMailPasswordRecovery($para, $hash)
    {
        $titulo    = 'Recuperación contraseña en seguridad.dev';
        $mensaje   = 'Hola, ya casi hemos terminado, para cambiar tu password en Seguridad.dev sólo debes hacer click en el siguiente enlace.  http://www.seguridad.dev/changepassword/' . $hash;
        $cabeceras = 'From: webmaster@example.com' . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
        mail($para, $titulo, $mensaje, $cabeceras);
    }
}
