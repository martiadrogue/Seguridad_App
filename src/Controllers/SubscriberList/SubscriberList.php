<?php 

namespace Controllers\SubscriberList;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;

class SubscriberList extends BaseController{

    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){
 
        $database = new PdoDatabase();
        $resultQuery = $database->selectFromTable('SELECT email FROM subscribers');
        
        $template = $this->container->get('TemplateTwig');
        
        $array = array( 'emails' => $resultQuery);
        return new Response($template->render('SubscriberList/SubscriberList.build.tpl', $array));
    }
}