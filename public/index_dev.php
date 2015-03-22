<?php 
error_reporting(-1);
ini_set("display_errors",1);

use Mpwarfwk\Component\Bootstrap;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Session;

require_once("../vendor/autoload.php");

echo "<h1> Entorno de desarrollo, con errores y barra debug activados </h1>";

$request = new Request(new Session());
$bootstrap = new Bootstrap('DEV', true);
$response = $bootstrap->execute($request);
$response->send();
