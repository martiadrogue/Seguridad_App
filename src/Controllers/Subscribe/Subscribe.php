<?php 

namespace Controllers\Subscribe;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Database\PdoDatabase;
use Mpwarfwk\Container\Container;

class Subscribe extends BaseController{
    

    public function __construct() {
        $this->newContainer();
    }

    public function build(Request $request){

        $FORM_SUBMITTED_BY_METHOD = $request->server->getParam('REQUEST_METHOD');

        if($FORM_SUBMITTED_BY_METHOD == 'POST'){

            $database = new PdoDatabase();
            $dataToInsert = $request->post->getParam('email');
            $queryInsert = $database->insertInTable('INSERT INTO subscribers SET email = :email', array('email' => $dataToInsert));
            $template = $this->container->get('TemplateTwig');
            return new Response($template->render('Success/Success.tpl'));
        }
  
        $template = $this->container->get('TemplateTwig');
        return new Response($template->render('Subscribe/Subscribe.build.tpl'));
    }
}