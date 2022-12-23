<?php
// Cambiar la zona horaria a mexico
date_default_timezone_set('America/Mexico_City');

//Establecer los headers de las peticiones
// header('Access-Control-Allow-Origin: *'); //permitir el acceso cruzado
// header('Access-Control-Allow-Header: Origin, X-Request-With, Content-Type, Accept');
// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset-utf-8');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');


include_once("Controllers/AgregarController.php");
include_once("Models/Agregar.php");

include_once("Router.php");
