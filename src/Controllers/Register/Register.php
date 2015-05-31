<?php

namespace Controllers\Register;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;
use Common\ImageHandler;
use Common\MailSender;

class Register extends BaseController{

    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){

        $FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');
        $template = $this->container->get('TemplateTwig');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
			$user = $request->cleanData($request->post->getParam('nombre'));
			$email = $request->cleanData($request->post->getParam('email'));
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
			$password = $request->cleanData($request->post->getParam('contraseña'));
			$passwordRepeat = $request->cleanData($request->post->getParam('contraseña2'));

			if ($password != $passwordRepeat){
				return new Response($template->render('Register/PasswordRepeatNotMatch.build.tpl'));
			}

			$querySelectUser = $database->selectFromTable('SELECT id FROM users WHERE user = :user', array('user' => $user));

			if (count($querySelectUser) > 0){
				return new Response($template->render('Register/UserAlreadyExists.build.tpl'));
			}

				if(!preg_match("/^[a-z\d_]{4,15}$/i",$user)) {
					return new Response($template->render('Register/NoValidUser.build.tpl'));
				}

				if($email == false) {
					return new Response($template->render('Register/NoValidEmail.build.tpl'));
				}

				$querySelectEmail = $database->selectFromTable('SELECT id FROM users WHERE email = :email', array('email' => $email));

			if (count($querySelectEmail) > 0){
				return new Response($template->render('Register/EmailAlreadyExists.build.tpl'));
			}

				if(!preg_match("/^.*(?=.{8,})((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$password) || strlen($password) > 16) {
					return new Response($template->render('Register/NoValidPassword.build.tpl'));
				}

            $file = $request->files->getParam('retrato');
            $imageHandler = new ImageHandler($file);
            $publicImage = $imageHandler->sanitizeImageName();
            if ($imageHandler->sanitizeImage()){
                return new Response($template->render('Register/FileNotPermitted.build.tpl'));
            }
            $realImage = $imageHandler->moveImage($publicImage, $user);

			$password = password_hash($password, PASSWORD_DEFAULT);
			$temporalHash = password_hash($user, PASSWORD_DEFAULT);
            $dataToErase = [".", "/", "$", "%", "#", "<", ">", "|", ";", "&"];
			$temporalHash = str_replace($dataToErase, "", $temporalHash);
            $database->insertInTable(
                'INSERT INTO users SET user = :user, email = :email, password = :password, temporalhash = :temporalhash, public_image = :public_image, real_image = :real_image',
                array(
                    'user' => $user,
                    'email' => $email,
                    'password' => $password,
                    'temporalhash' => $temporalHash,
                    'public_image' => $publicImage,
                    'real_image' => $realImage,
                )
            );

            $mailtoSender = new MailSender();
            $mailtoSender->sendMailRegisterVerification($email, $temporalHash);

            return new Response($template->render('Register/MailSent.build.tpl'));
        }

        return new Response($template->render('Register/Register.build.tpl'));
    }
}
