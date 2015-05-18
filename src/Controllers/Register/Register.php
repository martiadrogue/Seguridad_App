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

        $FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
			$user = $request->cleanData($request->post->getParam('nombre'));
			$password = $request->cleanData($request->post->getParam('contraseña'));
			$password = password_hash($password, PASSWORD_DEFAULT);
            $queryInsert = $database->insertInTable('INSERT INTO users SET user = :user, password = :password', array('user' => $user, 'password' => $password));
			
			$template = $this->container->get('TemplateTwig');
            return new Response($template->render('Success/Success2.tpl'));
        }
  
        $template = $this->container->get('TemplateTwig');
        return new Response($template->render('Register/Register.build.tpl'));
    }
}