<?php 

namespace Controllers\Test;
use \Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Container\Container;

class Test extends BaseController{

    public function __construct() {
        $this->newContainer(); 
    }

    public function build(Request $request){

        $template = $this->container->get('TemplateTwig');

        $arrayJustForTesting = array( 'a_variable' => 'george smith');
        return new Response($template->render('Test/Test.build.tpl', $arrayJustForTesting));
    }
}