<?php

namespace Controllers\ValidUser;

use Mpwarfwk\Controller\BaseController;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\JsonResponse;
use Mpwarfwk\Container\Container;
use Mpwarfwk\Database\PdoDatabase;

class ValidUser extends BaseController{

    public function __construct()
    {
        $this->newContainer();
    }

    public function build(Request $request)
    {
        $database = new PdoDatabase();
        $user = $request->cleanData($request->post->getParam('nombre'));
        $data = $database->selectFromTable('SELECT user FROM users WHERE user = :user', array('user' => $user));

        return new JsonResponse($data);
    }
}
