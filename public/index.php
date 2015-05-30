<?php

use Mpwarfwk\Component\Bootstrap;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Session;

require_once("../vendor/autoload.php");

$request = new Request(new Session());
$bootstrap = new Bootstrap('PROD', false);
$response = $bootstrap->execute($request);
$response->send();
