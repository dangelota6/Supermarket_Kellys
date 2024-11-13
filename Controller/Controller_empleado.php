<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../Model/Empleado.php';

class Controller_empleado{
    
    private $empleadoModel;
    public $listaEmpleados;    
    
    public function __construct(){
        $this->empleadoModel = new Empleado();
    }
    
    public function Login(){
        session_start();
        if(isset($_POST['username']) && isset($_POST['password'])){
            $usuario = $_POST['username']; 
            $password = $_POST['password'];
            $resultado = $this->empleadoModel->Validar_Login($usuario, $password);
            if($resultado && isset($resultado['id_emp'])){
                $_SESSION['empleado'] = [
                    'id' => $resultado['id_emp'],
                    'nombres' => $resultado['nombre'],
                    'apellidos' => $resultado['apellido'],
                    'dni' => $resultado['dni_emp'],
                    'correo' => $resultado['correo'],
                    'direccion' => $resultado['direc_emp'],
                    'telefono' => $resultado['tel_emp'],
                    'imagen' => $resultado['img_usu'],
                    'nivel' => $resultado['name_nivel'],
                ];
                switch($resultado['name_nivel']){
                    case 'Administrador':
                        $this->listaEmpleados = $this->empleadoModel->ListarEmpleados();
                        $_SESSION['lista_empleados'] = $this->listaEmpleados;
                        header('Location: ../View/Admin/Panel_principal.php');
                        break;
                    case 'Supervisor':
                        echo "Super";
                        break;
                    case 'Empleado':
                        header('Location: ../View/Empleado/Panel_principal.php');
                        break;
                }
                exit();
            }else{
                $_SESSION['error_log'] = "Credenciales incorrectas.";
                header('Location: ../');
                exit();
            }
        }
    }
    
    public function ListEmpId(){
        session_start();
        if(isset($_POST['id_emp'])){
            $id_emp = $_POST['id_emp'];
            $resultado = $this->empleadoModel->ObtenerEmpId($id_emp);
            if($resultado){
                echo json_encode($resultado);
            } else {
                echo json_encode(['error' => 'Empleado no encontrado.']);
            }
        }else {
            echo json_encode(['error' => 'ID de empleado no proporcionado.']);
        }
    }
    
    public function UpdateEmp($data){
        session_start();
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['error' => 'Error al decodificar JSON']);
                return;
            }

            $resultado = $this->empleadoModel->ActualizarEmp($data);
            if($resultado){
                echo json_encode(['success' => true]);
            }else{
                echo json_encode(['error' => 'No se pudo actualizar el empleado']);
            }            
        }else{
            echo json_encode(['error' => 'Método no permitido']);
        }              
    }
    
    public function ListarEmp(){
        session_start();
        header('Content-Type: application/json');
        $resultado = $this->empleadoModel->ListarEmpleados();
        echo json_encode($resultado);
    }
}
    
    
    




