<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function connectionSql(){
    $servername = "DANGE\SQLEXPRESS";
    $database = "Supermarket_Kellys";
    $username = "sa";
    $password = "123456";   
    
    $cadena = "sqlsrv:Server=$servername;Database=$database";
    
    return array($cadena, $username, $password);
}

function abrirConexion(){
    list($cadena, $username, $password) = connectionSql();
    
    try{
        $conectar = new PDO($cadena, $username, $password);
        $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /*echo "Conexión exitosa a SQL Server.<br>";*/
        return $conectar;
    } catch (PDOException $ex) {
        die("Error de conexion: " . $ex->getMessage());
    }
}

function cerrarConexion(&$conectar){
    $conectar = null;
    /*echo "Conexión cerrada correctamente.<br>";*/
}

function probarConexion(){
    $conectar = abrirConexion();
    
    if($conectar){
        /*echo "La conexión está abierta y lista para usar.<br>";*/
        cerrarConexion($conectar);
    }
}
