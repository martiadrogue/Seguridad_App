<?php 

namespace Controllers\ChangePassword;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;

class ChangePassword extends BaseController{
    

    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){

        $FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

			$password = $request->cleanData($request->post->getParam('password'));
			$passwordRepeat = $request->cleanData($request->post->getParam('password2'));
			
			if ($password != $passwordRepeat){
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Register/PasswordRepeatNotMatch.build.tpl'));
			}
			
			if(!preg_match("/^.*(?=.{8,})((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",$password) || strlen($password) > 16) { 
					$template = $this->container->get('TemplateTwig');
					return new Response($template->render('ChangePassword/NoValidPassword.build.tpl'));
				}
			
			$database = new PdoDatabase();
			$temporalHash = $request->post->getParam('hash');
            $querySelect = $database->selectFromTable('SELECT id FROM users WHERE temporalhash = :temporalhash', array('temporalhash' => $temporalHash));
			
			if (count($querySelect) == 1){
			
				$password = password_hash($password, PASSWORD_DEFAULT);
				
				$queryUpdate = $database->updateTable('UPDATE users SET password = :password, temporalhash = :temporalhash WHERE id = :id', array('password' => $password, 'temporalhash' => NULL, 'id' => $querySelect[0]['id']));
				
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('ChangePassword/PasswordChanged.build.tpl'));
			
			}
        }
  
        $template = $this->container->get('TemplateTwig');
		$array = array( 'hash' => $request->url->returnParam('1'));
        return new Response($template->render('ChangePassword/ChangeEmailForm.build.tpl', $array));
    }
}