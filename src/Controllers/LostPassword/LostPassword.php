<?php

namespace Controllers\LostPassword;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;
use Common\MailSender;

class LostPassword extends BaseController{


    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){

        $FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');
        $template = $this->container->get('TemplateTwig');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
			$email = $request->cleanData($request->post->getParam('email'));
            $querySelect = $database->selectFromTable('SELECT user FROM users WHERE email = :email', array('email' => $email));

			if (count($querySelect) == 1){

				$temporalHash = password_hash($email, PASSWORD_DEFAULT);
                $dataToErase = [".", "/", "$", "%", "#", "<", ">", "|", ";", "&"];
				$temporalHash = str_replace($dataToErase, "", $temporalHash);
				$queryUpdate = $database->updateTable('UPDATE users SET temporalhash = :temporalhash WHERE email = :email', array('email' => $email, 'temporalhash' => $temporalHash));

                $mailtoSender = new MailSender();
                $mailtoSender->sendMailRegisterVerification($email, $temporalHash);

				return new Response($template->render('LostPassword/MailSent.build.tpl'));

			} else {
				return new Response($template->render('LostPassword/NoEmail.build.tpl'));
			}
        }

        return new Response($template->render('LostPassword/LostPasswordForm.build.tpl'));
    }
}
