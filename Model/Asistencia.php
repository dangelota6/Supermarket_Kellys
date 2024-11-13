<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'Conexion.php';

class Asistencia{
    private $id_asis;
    private $id_emp;
    private $hora_ingreso;
    private $hora_salida;
    private $fecha;
    private $id_estado;
    
    public function getId_asis() {
        return $this->id_asis;
    }

    public function getId_emp() {
        return $this->id_emp;
    }

    public function getHora_ingreso() {
        return $this->hora_ingreso;
    }

    public function getHora_salida() {
        return $this->hora_salida;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getId_estado() {
        return $this->id_estado;
    }

    public function setId_asis($id_asis) {
        $this->id_asis = $id_asis;
    }

    public function setId_emp($id_emp) {
        $this->id_emp = $id_emp;
    }

    public function setHora_ingreso($hora_ingreso) {
        $this->hora_ingreso = $hora_ingreso;
    }

    public function setHora_salida($hora_salida) {
        $this->hora_salida = $hora_salida;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setId_estado($id_estado) {
        $this->id_estado = $id_estado;
    }
    
    function Validar_dni($dni){
        $conectar = abrirConexion();
        
        $consulta = $conectar->prepare("EXEC spValidarDNI :dni_emp_val");
        $consulta->bindParam(':dni_emp_val', $dni, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        
        cerrarConexion($conectar);
        return $resultado;
    }
    
    function Guardar_ingreso($hora){
        $conectar = abrirConexion();
        
        $this->setHora_ingreso($hora);  
        $consulta = $conectar->prepare("EXEC spRegistrarIngreso :id_emp, :hora_ingreso, :fecha");
        $consulta->bindParam(':id_emp', $this->id_emp);
        $consulta->bindParam(':hora_ingreso', $this->hora_ingreso);
        $consulta->bindParam(':fecha', $this->fecha);
        $consulta->execute();
        
        cerrarConexion($conectar);
    }
    
    function Guardar_salida($hora){
        $conectar = abrirConexion();
        
        $this->setHora_salida($hora);
        $consulta = $conectar->prepare("EXEC spRegistrarSalida :id_emp, :hora_salida");
        $consulta->bindParam(':id_emp', $this->id_emp);
        $consulta->bindParam(':hora_salida', $this->hora_salida);
        $consulta->execute();
        
        cerrarConexion($conectar);
    }
    
    function Verificar_Ingreso($fecha){
        $conectar = abrirConexion();
        
        $this->setFecha($fecha);
        $consulta = $conectar->prepare("EXEC spVerificarIngreso :id_emp, :fecha");
        $consulta->bindParam(':id_emp', $this->id_emp);
        $consulta->bindParam(':fecha', $this->fecha);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC)['count'];
        
        cerrarConexion($conectar);
        return $resultado;
    }
}

