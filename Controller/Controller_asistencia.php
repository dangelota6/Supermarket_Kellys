<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

require_once '../Model/Asistencia.php';

class Controller_asistencia {
    
    private $asistenciaModel;
    
    public function __construct(){
        $this->asistenciaModel = new Asistencia();
    }
    
    public function Registrar_asistencia($dni, $hora, $fecha, $tipo){
        $resultado = $this->asistenciaModel->Validar_dni($dni);
        if($resultado && $resultado['id_emp'] != -1){
            $id_emp = $resultado['id_emp'];
            $this->asistenciaModel->setId_emp($id_emp);
            $this->asistenciaModel->setFecha($fecha);
            if($tipo === 'Ingreso'){
                $repetir = $this->asistenciaModel->Verificar_Ingreso($fecha);
                if($repetir > 0){
                    echo json_encode(['success' => false, 'message' => 'Ya registro su ingreso el día de hoy!']);
                }else{
                    $this->asistenciaModel->Guardar_ingreso($hora);
                    echo json_encode(['success' => true, 'message' => 'Asistencia registrada con éxito.']);
                }                
            }else{
                $this->asistenciaModel->Guardar_salida($hora);
                echo json_encode(['success' => true, 'message' => 'Salida registrada con éxito.']);
            }
        }else{
            echo json_encode(['success' => false, 'message' => 'DNI incorrecto o no existe, pongase en contacto con el administrador']);
        }
    }
    
}
