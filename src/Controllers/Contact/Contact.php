<?php 

namespace Controllers\Contact;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;

class Contact extends BaseController{
    

    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){
		
		//session_start();
		//echo var_dump($request->session->getSession('valid_user'));
		//echo $_SESSION['valid_user'];
		
        if ($request->session->getSession('valid_user') != true) {
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Contact/noLoged.build.tpl'));
		}

		if ($request->session->getSession('valid_user') == true){
		
			$database = new PdoDatabase();
			$query = 'SELECT id, contact FROM user_contact WHERE id_user = ' . $request->session->getSession('user_ref');
			$resultQuery = $database->selectFromTable($query);
			
			$template = $this->container->get('TemplateTwig');
			
			var_dump($resultQuery);
			$array = array( 'contacts' => $resultQuery);
			return new Response($template->render('Contact/ContactList.build.tpl', $array));
		}
	}
	
	public function add(Request $request){
		
		if ($request->session->getSession('valid_user') != true) {
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Contact/noLoged.build.tpl'));
		}
		
		if ($request->session->getSession('valid_user') == true){
		
			$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

			if($FORM_SUBMITTED_BY_METHOD == 'POST'){

				$database = new PdoDatabase();
				$contact = $request->post->getParam('nombre');
				$id_user = $request->session->getSession('user_ref');
				$query = 'INSERT INTO user_contact SET id_user = :id_user, contact = :contact';
				$queryInsert = $database->insertInTable($query, array('id_user' => $id_user, 'contact' => $contact));
				
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Contact/addedSuccess.build.tpl'));
			}
	  
			$template = $this->container->get('TemplateTwig');
			return new Response($template->render('Contact/Add.build.tpl'));
		}
    }
	
	public function detail(Request $request){
		
		if ($request->session->getSession('valid_user') != true) {
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Contact/noLoged.build.tpl'));
		}
		
		if ($request->session->getSession('valid_user') == true){
		
			$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

			if($FORM_SUBMITTED_BY_METHOD == 'POST'){

				$database = new PdoDatabase();
				$id = $request->post->getParam('id');
				$query = 'SELECT contact FROM user_contact WHERE id =' . $id;
				$resultQuery = $database->selectFromTable($query);
			
				$template = $this->container->get('TemplateTwig');
			
				var_dump($resultQuery);
				$array = array( 'contacts' => $resultQuery);
				return new Response($template->render('Contact/Detail.build.tpl', $array));
			}
			//$this->build($request);
		}
    }
	
	public function edit(Request $request){
	
		if ($request->session->getSession('valid_user') != true) {
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Contact/noLoged.build.tpl'));
		}
		
		if ($request->session->getSession('valid_user') == true){
		
			$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

			if($FORM_SUBMITTED_BY_METHOD == 'POST'){

				$database = new PdoDatabase();
				$id = $request->post->getParam('id');
				$query = 'SELECT id, contact FROM user_contact WHERE id =' . $id;
				$resultQuery = $database->selectFromTable($query);
			
				$template = $this->container->get('TemplateTwig');
			
				var_dump($resultQuery);
				$array = array( 'contacts' => $resultQuery);
				return new Response($template->render('Contact/Edit.build.tpl', $array));
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
				$newData = $request->post->getParam('data_updated');
				$resultQuery = $database->updateTable('UPDATE user_contact SET contact = :contact WHERE id = :id', array('contact' => $newData, 'id' => $id));
			
				$template = $this->container->get('TemplateTwig');
			
				var_dump($resultQuery);
				return new Response($template->render('Contact/Update.build.tpl'));
			}
			//$this->build($request);
		}
    }
	
	public function erase(Request $request){
	
		if ($request->session->getSession('valid_user') != true) {
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Contact/noLoged.build.tpl'));
		}
		
		if ($request->session->getSession('valid_user') == true){
		
			$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

			if($FORM_SUBMITTED_BY_METHOD == 'POST'){

				$database = new PdoDatabase();
				$id = $request->post->getParam('id');
				$resultQuery = $database->deleteFromTable('user_contact', $id);
			
				$template = $this->container->get('TemplateTwig');
			
				var_dump($resultQuery);
				return new Response($template->render('Contact/Delete.build.tpl'));
			}
			//$this->build($request);
		}
    }
}