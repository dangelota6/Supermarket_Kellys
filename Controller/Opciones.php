<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'Controller_empleado.php';
require_once 'Controller_asistencia.php';

$empleadoController = new Controller_empleado();
$asistenciaController = new Controller_asistencia();

$opcion = $_GET['opcion'];

switch ($opcion) {
    case 1:
        $empleadoController->Login();
        break;
        
    case 2:
        $asistenciaController->Registrar_asistencia($dni = $_POST['dni'], $hora = $_POST['hora'], $fecha = $_POST['fecha'], $tipo = $_POST['tipo']);
        break;
    
    case 3:
        session_start();
        session_destroy();
        header('Location: ../');
        exit();
        break;
    
    case 4:
        $empleadoController->ListEmpId();
        break;
    
    case 5:
        $data = json_decode(file_get_contents('php://input'), true);
        $empleadoController->UpdateEmp($data);
        break;
    
    case 6:
        $empleadoController->ListarEmp();
        break;
}

