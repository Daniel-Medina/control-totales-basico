<?php

class AgregarController {

    public function index()
    {
        $response = Agregar::obtenerDatos();

        echo json_encode($response, http_response_code(200));
    }

    public function store($request)
    {
        // validar campos
        if (empty($request->fecha) || empty($request->cantidad)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Los campos no pueden estar vacios',
                'code' => 500
            ], http_response_code(500));
            return;
        }

        // Validar que cantidad sea numerico
        if (!is_numeric($request->cantidad)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'La cantidad debe ser numerica',
                'code' => 500
            ], http_response_code(500));
            return;
        }

        // Acomodar la fecha en formato #De 1/1/2023 a 1/01/2023
        $fecha = explode('-', $request->fecha);
        $fechaFormateadaDia = $fecha[0] < 10 ? '0' . $fecha[0] : $fecha[0];
        $fechaFormateadaMes = $fecha[1] < 10 ? '0' . $fecha[1] : $fecha[1];
        // Fecha correcta a almacenar
        $fecha = $fechaFormateadaDia . '-' . $fechaFormateadaMes . '-' . $fecha[2];

       $sql = Agregar::guardarDatos($fecha, $request->cantidad);

        echo json_encode($sql, $sql['code']);

    }

    public function getTotal($fecha)
    {
        $response = Agregar::obtenerDatosFecha($fecha);
        $saldo = 0;
        $fechaConsulta = $fecha;
        
        foreach ($response as $value) {
            $saldo += $value->cantidad;
        }

        $responseApi = (object) [
            'fecha' => $fechaConsulta,
            'saldo' => round($saldo, 2),
            'cantidad' => count($response),
        ];

        echo json_encode($responseApi, http_response_code(200));

    }
}