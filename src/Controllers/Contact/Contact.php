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

		//echo var_dump($request->session->getSession('valid_user'));
		//echo $_SESSION['valid_user'];
		/*
        if ($request->session->getSession('valid_user') != true) {
				$template = $this->container->get('TemplateTwig');
				return new Response($template->render('Contact/noLoged.build.tpl'));
		}

		if ($request->session->getSession('valid_user') == true){
			echo 'estas dentro';
		}*/
		
		$database = new PdoDatabase();
        $resultQuery = $database->selectFromTable('SELECT id, task FROM tasks3');
        
        $template = $this->container->get('TemplateTwig');
        
		var_dump($resultQuery);
        $array = array( 'contacts' => $resultQuery);
        return new Response($template->render('Contact/ContactList.build.tpl', $array));
    }
	
	public function add(Request $request){
		
		$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
			$user = $request->post->getParam('nombre');
			$done = 0;
            $queryInsert = $database->insertInTable('INSERT INTO tasks3 SET task = :user, done = :done', array('user' => $user, 'done' => $done));
			
			$template = $this->container->get('TemplateTwig');
            return new Response($template->render('Contact/addedSuccess.build.tpl'));
        }
  
        $template = $this->container->get('TemplateTwig');
        return new Response($template->render('Contact/Add.build.tpl'));
    }
	
	public function detail(Request $request){
		
		$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
			$id = $request->post->getParam('id');
			$query = 'SELECT task FROM tasks3 WHERE id =' . $id;
			$resultQuery = $database->selectFromTable($query);
        
			$template = $this->container->get('TemplateTwig');
        
			var_dump($resultQuery);
			$array = array( 'contacts' => $resultQuery);
			return new Response($template->render('Contact/Detail.build.tpl', $array));
        }
  
        //$this->build($request);
    }
	
	public function edit(Request $request){
		
		$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
			$id = $request->post->getParam('id');
			$query = 'SELECT task, id FROM tasks3 WHERE id =' . $id;
			$resultQuery = $database->selectFromTable($query);
        
			$template = $this->container->get('TemplateTwig');
        
			var_dump($resultQuery);
			$array = array( 'contacts' => $resultQuery);
			return new Response($template->render('Contact/Edit.build.tpl', $array));
        }
  
        //$this->build($request);
    }
	
	public function update(Request $request){
		
		$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
			$id = $request->post->getParam('id');
			$newData = $request->post->getParam('data_updated');
			$resultQuery = $database->updateTable('UPDATE tasks3 SET task = :task WHERE id = :id', array('task' => $newData, 'id' => $id));
        
			$template = $this->container->get('TemplateTwig');
        
			var_dump($resultQuery);
			return new Response($template->render('Contact/Update.build.tpl'));
        }
  
        //$this->build($request);
    }
	
	public function erase(Request $request){
		
		$FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
			$id = $request->post->getParam('id');
			$resultQuery = $database->deleteFromTable('tasks3', $id);
        
			$template = $this->container->get('TemplateTwig');
        
			var_dump($resultQuery);
			return new Response($template->render('Contact/Delete.build.tpl'));
        }
  
        //$this->build($request);
    }
}