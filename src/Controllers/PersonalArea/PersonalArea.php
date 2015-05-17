<?php 

namespace Controllers\PersonalArea;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;

class PersonalArea extends BaseController{
    

    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){
		
        if ($request->session->getSession('valid_user') != true) {
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Contact/noLoged.build.tpl'));
		}

		if ($request->session->getSession('valid_user') == true){
		
			$database = new PdoDatabase();
			$query = 'SELECT id, user FROM users WHERE id = ' . $request->session->getSession('user_ref');
			$resultQuery = $database->selectFromTable($query);
			
			$template = $this->container->get('TemplateTwig');
			
			var_dump($resultQuery);
			$array = array( 'personalarea' => $resultQuery[0]);
			return new Response($template->render('PersonalArea/PersonalArea.build.tpl', $array));
		}
	}
	
	public function changeUser(Request $request){
	
		if ($request->session->getSession('valid_user') != true) {
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Contact/noLoged.build.tpl'));
		}
		
		if ($request->session->getSession('valid_user') == true){
		
			$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

			if($FORM_SUBMITTED_BY_METHOD == 'POST'){

				$database = new PdoDatabase();
				$id = $request->post->getParam('id');
				$query = 'SELECT id, user FROM users WHERE id =' . $id;
				$resultQuery = $database->selectFromTable($query);
			
				$template = $this->container->get('TemplateTwig');
			
				var_dump($resultQuery);
				$array = array( 'personalarea' => $resultQuery[0]);
				return new Response($template->render('PersonalArea/ChangeUser.build.tpl', $array));
			}
			//$this->build($request);
		}
    }
	
	public function changePassword(Request $request){
	
		if ($request->session->getSession('valid_user') != true) {
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Contact/noLoged.build.tpl'));
		}
		
		if ($request->session->getSession('valid_user') == true){
		
			$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

			if($FORM_SUBMITTED_BY_METHOD == 'POST'){

				echo 'pendiente implementar sistema para cambiar pwd via link-email';
			}
			//$this->build($request);
		}
    }
	
	public function update(Request $request){
	
		if ($request->session->getSession('valid_user') != true) {
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Contact/noLoged.build.tpl'));
		}
		
		if ($request->session->getSession('valid_user') == true){
		
			$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

			if($FORM_SUBMITTED_BY_METHOD == 'POST'){

				$database = new PdoDatabase();
				$id = $request->post->getParam('id');
				$newUser = $request->post->getParam('data_updated');
				$resultQuery = $database->updateTable('UPDATE users SET user = :user WHERE id = :id', array('user' => $newUser, 'id' => $id));
			
				$template = $this->container->get('TemplateTwig');
			
				var_dump($resultQuery);
				return new Response($template->render('PersonalArea/UpdateUser.build.tpl'));
			}
			//$this->build($request);
		}
    }
	
}