<?php

// Inicializar los controladores
$agregarController = new AgregarController;

// Obtener la uri
$url = $_SERVER['REQUEST_URI'];

$consultas = $url = explode('?', $url);

if ($url != $consultas[0]) {
    $url = $consultas[0];
}

//Ruta vacia
if ($url == '' || $url == '/') {
    return die('No se ha especificado una ruta');
}

// Ruta agregar index
if ($url == '/agregar') {
    $agregarController->index();
    return;
}

// Ruta agregar store
if ($url == '/agregar/store') {

    // Validar que el metodo sea POST
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        die('El metodo GET no esta permitido');
    }

    // Validar que se manden los parametros
    if (!isset($_POST['fecha']) || !isset($_POST['cantidad'])) {
        die('No se han enviado los parametros');
    }


    $request = (object) [
        'fecha' => $_POST['fecha'],
        'cantidad' => $_POST['cantidad'],
    ];

    $agregarController->store($request);

    return;

}

// Consultar la cantidad de registros de un dia
if ($url == '/total') {

    // Asignar una fecha si no se manda
    if (!isset($_GET['fecha'])) {
        $_GET['fecha'] = date('d-m-Y');
    }

    $fecha = $_GET['fecha'];

    $agregarController->getTotal($fecha);

    return;

}

die('No se ha encontrado la ruta especificada');