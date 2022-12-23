<?php 

class DB {

    public static function connect()
    {
        //iniciar conexion con my sql
        try {
            $sql = new PDO('mysql:host=localhost;dbname=detalles', 'root', '');

            $sql->exec('set names utf8');

            return $sql;

        } catch (\Throwable $th) {
            die('Error al conectar con la base de datos');
        }
    }

}