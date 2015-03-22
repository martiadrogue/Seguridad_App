<?php 

namespace Controllers\Home;
use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Response;
use Mpwarfwk\Container\Container;

class Home extends BaseController{
    

    public function __construct() {
        
        $this->newContainer(); 
    }

    public function build(Request $request){
        
        $template = $this->container->get('TemplateSmarty');
        
        $justForTestingArray = array( 'name' => 'george smith', 'address' => 'mi casa 32 1-4 BCN');
    	$template->assignVars($justForTestingArray);

        return new Response($template->render("../src/Templates/Home/Home.build.tpl"));
    }
}