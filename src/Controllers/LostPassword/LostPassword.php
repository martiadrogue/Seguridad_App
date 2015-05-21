<?php 

namespace Controllers\LostPassword;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;

class LostPassword extends BaseController{
    

    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){

        $FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
			$email = $request->cleanData($request->post->getParam('email'));
            $querySelect = $database->selectFromTable('SELECT user FROM users WHERE email = :email', array('email' => $email));
			
			if (count($querySelect) == 1){
				
				$temporalHash = password_hash($email, PASSWORD_DEFAULT);
				$temporalHash = str_replace("/", "", $temporalHash);
				$queryUpdate = $database->updateTable('UPDATE users SET temporalhash = :temporalhash WHERE email = :email', array('email' => $email, 'temporalhash' => $temporalHash));

				$para      = $email;
				$titulo    = 'Recuperación contraseña en seguridad.dev';
				$mensaje   = 'Hola, ya casi hemos terminado, para cambiar tu password en Seguridad.dev sólo debes hacer click en el siguiente enlace.  http://www.seguridad.dev/changepassword/' . $temporalHash;
				$cabeceras = 'From: webmaster@example.com' . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

				mail($para, $titulo, $mensaje, $cabeceras);
				
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('LostPassword/MailSent.build.tpl'));
			
			}
			else {
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('LostPassword/NoEmail.build.tpl'));
			
			}
        }
  
        $template = $this->container->get('TemplateTwig');
        return new Response($template->render('LostPassword/LostPasswordForm.build.tpl'));
    }
}