<?php 

namespace Controllers\Register;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;

class Register extends BaseController{
    

    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){
	
		//echo $request->server->getParam('HTTP_HOST');
		

        $FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
			$user = $request->cleanData($request->post->getParam('nombre'));
			$email = $request->cleanData($request->post->getParam('email'));
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
			$password = $request->cleanData($request->post->getParam('contraseña'));
			
				if(!preg_match("/^[a-z\d_]{4,15}$/i",$user)) { 
					$template = $this->container->get('TemplateTwig');
					return new Response($template->render('Register/NoValidUser.build.tpl'));
				}
			
				if($email == false) { 
					$template = $this->container->get('TemplateTwig');
					return new Response($template->render('Register/NoValidEmail.build.tpl'));
				}
				echo 'count->' . count($password);
				if(!preg_match("/^.*(?=.{8,})((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$password) || strlen($password) > 16) { 
					$template = $this->container->get('TemplateTwig');
					return new Response($template->render('Register/NoValidPassword.build.tpl'));
				}
			$password = password_hash($password, PASSWORD_DEFAULT);
			$temporalHash = password_hash($user, PASSWORD_DEFAULT);
			$temporalHash = str_replace("/", "", $temporalHash);
            $queryInsert = $database->insertInTable('INSERT INTO users SET user = :user, email = :email, password = :password, temporalhash = :temporalhash', array('user' => $user, 'email' => $email, 'password' => $password, 'temporalhash' => $temporalHash));
			
			$para      = $email;
			$titulo    = 'Activacion cuenta usuario en seguridad.dev';
			$mensaje   = 'Hola, ya casi hemos terminado, para activar tu cuenta en Seguridad.dev sólo debes hacer click en el siguiente enlace. Ten en cuenta que si no lo haces no podrás entrar en tu cuenta  http://www.seguridad.dev/accountverification/' . $temporalHash;
			$cabeceras = 'From: webmaster@example.com' . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

			mail($para, $titulo, $mensaje, $cabeceras);
			
			$template = $this->container->get('TemplateTwig');
            return new Response($template->render('Register/MailSent.build.tpl'));
        }
  
        $template = $this->container->get('TemplateTwig');
        return new Response($template->render('Register/Register.build.tpl'));
    }
}