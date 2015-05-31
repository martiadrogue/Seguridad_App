<?php

namespace Controllers\Login;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;

class Login extends BaseController{


    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){

        $FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');
        $template = $this->container->get('TemplateTwig');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
			$user = $request->cleanData($request->post->getParam('nombre'));
			$password = $request->cleanData($request->post->getParam('contraseña'));
            $querySelect = $database->selectFromTable('SELECT id, password, active FROM users WHERE user = :user', array('user' => $user));
			if (count($querySelect) == 1 && password_verify($password, $querySelect[0]['password']) && $querySelect[0]['active'] == 1){

				$request->session->setSession('valid_user', true);
                $request->session->setSession('user_ref', $querySelect[0]['id']);
                $request->session->setSession('wakeup', 0);
                $request->session->setSession('attempt', 0);
				header("Location: http://www.seguridad.dev/contact");
			} else {
                return new Response($template->render('Login/LoginIncorrecto.build.tpl'));

            }
        }

        $wakeup = $request->cleanData($request->session->getSession('wakeup'));
        $attempt = $request->cleanData($request->session->getSession('attempt'));
        $wakeup = $wakeup ? $wakeup : 0;
        $attempt = $attempt ? $attempt : 0;
        if ($attempt === md5(3)) {
            $request->session->setSession('wakeup', time() + (20 * 60));

            return new Response($template->render('Login/SoManyAttempts.build.tpl'));
        }
        if (time() < $wakeup) {
            return new Response($template->render('Login/SoManyAttempts.build.tpl'));
        }
        $request->session->setSession('attempt', md5($attempt + 1));

        return new Response($template->render('Login/Login.build.tpl'));
    }
}
