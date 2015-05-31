<?php

namespace Controllers\Logout;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;

class Logout extends BaseController{


    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){

        $request->session->setSession('valid_user', null);
        $request->session->setSession('user_ref', null);
        $request->session = null;
		session_destroy();
		setcookie( "remember", '', time() - 1 );  /* set time in the past */

		$template = $this->container->get('TemplateTwig');
        return new Response($template->render('Logout/Logout.build.tpl'));
    }
}
