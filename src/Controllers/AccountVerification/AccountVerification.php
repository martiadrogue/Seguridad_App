<?php 

namespace Controllers\AccountVerification;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;

class AccountVerification extends BaseController{
    

    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){

        $hash = $request->url->returnParam('1');
		echo $hash;
		
		$database = new PdoDatabase();
		$query = "SELECT id, active FROM users WHERE temporalhash = '" . $hash . "'";
		$resultQuery = $database->selectFromTable($query);
		
		if (count($resultQuery) == 1 && $resultQuery[0]['active'] == 0){
		
			$updateQuery = $database->updateTable('UPDATE users SET temporalhash = :temporalhash, active = :active  WHERE id = :id', array('temporalhash' => NULL, 'id' => $resultQuery[0]['id'], 'active' => 1));
			
			$template = $this->container->get('TemplateTwig');
			
			var_dump($resultQuery);
			$array = array( 'contacts' => $resultQuery);
			return new Response($template->render('AccountVerification/EmailRegisterSuccess.build.tpl', $array));
		}
    }
}