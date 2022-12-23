<?php

require_once('Models/DB.php');

class Agregar
{

    static public function obtenerDatos() #Todos
    {
        try {
            $sql = DB::connect();

            $query = $sql->prepare("SELECT * FROM detalles");

            // Ejecutar consulta
            $query->execute();

            // Obtener datos
            return $query->fetchAll(PDO::FETCH_CLASS);
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'message' => $th,
                'code' => 500
            ];
        }
    }

    static public function guardarDatos($fecha, $cantidad)
    {

        try {
            $sql = DB::connect();

            $query = $sql->prepare("INSERT INTO detalles (fecha, cantidad) VALUES (:fecha, :cantidad)");

            // Enlazar variables ocultas
            $query->bindParam(':fecha', $fecha);
            $query->bindParam(':cantidad', $cantidad);

            // ejecutar consulta
            $query->execute();

            // Obtener datos
            return [
                'status' => 'success',
                'message' => 'Datos guardados correctamente',
                'code' => 200
            ];

        } catch (\Throwable $th) {
            //throw $th;
            return [
                'status' => 'error',
                'message' => $th,
                'code' => 500
            ];
        }
    }

    static public function obtenerDatosFecha($fecha) #Ejem: '23-12-2022'
    {
        try {
            $sql = DB::connect();

            $query = $sql->prepare("SELECT * FROM detalles WHERE fecha = :fecha");

            // Enlazar variables ocultas
            $query->bindParam(':fecha', $fecha);

            // Ejecutar consulta
            $query->execute();

            // Obtener datos
            return $query->fetchAll(PDO::FETCH_CLASS);
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'message' => $th,
                'code' => 500
            ];
        }
    }
}
