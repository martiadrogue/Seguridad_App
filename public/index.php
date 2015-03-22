<?php 

use Mpwarfwk\Component\Bootstrap;
use Mpwarfwk\Http\Request;
use Mpwarfwk\Http\Session;

require_once("../vendor/autoload.php");

echo "<h1> Entorno de produccion, con errores y barra debug desactivados </h1>";

$request = new Request(new Session());
$bootstrap = new Bootstrap('PROD', false);
$response = $bootstrap->execute($request);
$response->send();
